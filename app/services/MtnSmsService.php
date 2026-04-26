<?php

namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MtnSmsService
{
    protected string $baseUrl;
    protected string $tokenUrl;
    protected string $consumerKey;
    protected string $consumerSecret;
    protected string $senderAddress;
    protected string $serviceCode;
    protected string $countryCode;
    protected bool $requestDeliveryReceipt;

    public function __construct()
    {
        $cfg = config('services.mtn_sms');

        $this->baseUrl                = rtrim($cfg['base_url'], '/');
        $this->tokenUrl               = $cfg['token_url'];
        $this->consumerKey            = $cfg['consumer_key'];
        $this->consumerSecret         = $cfg['consumer_secret'];
        $this->senderAddress          = $cfg['sender_address'] ?? 'ZikoVB';
        $this->serviceCode            = $cfg['service_code'] ?? $this->senderAddress;
        $this->countryCode            = $cfg['country_code'] ?? '260';
        $this->requestDeliveryReceipt = (bool) ($cfg['delivery_receipt'] ?? false);
    }

    /* ──────────────────────────────────────────────
     *  OAuth 2.0 – Client Credentials
     * ────────────────────────────────────────────── */

    /**
     * Obtain (or retrieve from cache) a valid Bearer token.
     */
    public function getAccessToken(): string
    {
        return Cache::remember('mtn_sms_access_token', 3500, function () {
            $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
                ->asForm()
                ->post($this->tokenUrl, [
                    'grant_type' => 'client_credentials',
                    'scope'      => 'SEND-SMS',
                ]);

            if ($response->failed()) {
                Log::error('MTN SMS OAuth failed', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                throw new \RuntimeException('Failed to obtain MTN SMS access token: ' . $response->body());
            }

            $data = $response->json();

            return $data['access_token'] ?? $data['accessToken'] ?? '';
        });
    }

    /**
     * Force-refresh the cached access token.
     */
    public function refreshToken(): string
    {
        Cache::forget('mtn_sms_access_token');

        return $this->getAccessToken();
    }

    /* ──────────────────────────────────────────────
     *  Send SMS
     * ────────────────────────────────────────────── */

    /**
     * Send an SMS to one or more recipients.
     *
     * @param  string|array  $recipients   MSISDN(s) – local (0977…) or international (260977…)
     * @param  string        $message      Message body (max 160 chars for single-part)
     * @param  array         $options      Optional overrides (senderAddress, serviceCode, keyword, requestDeliveryReceipt)
     * @return array{success: bool, transactionId: string|null, statusCode: string|null, statusMessage: string|null, raw: array}
     */
    public function send(string|array $recipients, string $message, array $options = []): array
    {
        $recipients = is_array($recipients) ? $recipients : [$recipients];

        // Normalise all numbers to international format (E.164 without +)
        $normalised = array_map(fn ($n) => $this->normaliseNumber($n), $recipients);

        $correlationId = $options['clientCorrelatorId'] ?? (string) Str::uuid();
        $senderAddr    = $options['senderAddress'] ?? $this->senderAddress;
        $svcCode       = $options['serviceCode'] ?? $this->serviceCode ?: $senderAddr;

        $payload = [
            'senderAddress'          => $senderAddr,
            'receiverAddress'        => $normalised,
            'message'                => $message,
            'clientCorrelatorId'     => $correlationId,
            'serviceCode'            => $svcCode,
            'requestDeliveryReceipt' => $options['requestDeliveryReceipt'] ?? $this->requestDeliveryReceipt,
        ];

        if (isset($options['keyword'])) {
            $payload['keyword'] = $options['keyword'];
        }

        try {
            $token = $this->getAccessToken();

            $response = Http::withToken($token)
                ->acceptJson()
                ->timeout(30)
                ->post("{$this->baseUrl}/messages/sms/outbound", $payload);

            $body = $response->json() ?? [];

            // If 401, try refreshing the token once
            if ($response->status() === 401) {
                $token = $this->refreshToken();

                $response = Http::withToken($token)
                    ->acceptJson()
                    ->timeout(30)
                    ->post("{$this->baseUrl}/messages/sms/outbound", $payload);

                $body = $response->json() ?? [];
            }

            $success       = $response->successful() && ($body['statusCode'] ?? '') === '0000';
            $transactionId = $body['transactionId'] ?? null;
            $statusCode    = $body['statusCode'] ?? (string) $response->status();
            $statusMessage = $body['statusMessage'] ?? $response->body();

            // Log each recipient
            foreach ($normalised as $number) {
                SmsLog::create([
                    'recipient'      => $number,
                    'message'        => $message,
                    'sender_address' => $senderAddr,
                    'service_code'   => $svcCode,
                    'correlation_id' => $correlationId,
                    'transaction_id' => $transactionId,
                    'status_code'    => $statusCode,
                    'status_message' => $statusMessage,
                    'status'         => $success ? 'sent' : 'failed',
                    'sent_by'        => auth()->id(),
                    'sent_at'        => now(),
                ]);
            }

            if (!$success) {
                Log::warning('MTN SMS send failed', [
                    'recipients' => $normalised,
                    'status'     => $statusCode,
                    'message'    => $statusMessage,
                ]);
            }

            return [
                'success'        => $success,
                'transactionId'  => $transactionId,
                'statusCode'     => $statusCode,
                'statusMessage'  => $statusMessage,
                'raw'            => $body,
            ];
        } catch (\Throwable $e) {
            Log::error('MTN SMS exception', [
                'recipients' => $normalised ?? $recipients,
                'error'      => $e->getMessage(),
            ]);

            // Log failures
            foreach (($normalised ?? $recipients) as $number) {
                SmsLog::create([
                    'recipient'      => $number,
                    'message'        => $message,
                    'sender_address' => $senderAddr,
                    'service_code'   => $svcCode,
                    'correlation_id' => $correlationId,
                    'status_code'    => 'EXCEPTION',
                    'status_message' => Str::limit($e->getMessage(), 500),
                    'status'         => 'failed',
                    'sent_by'        => auth()->id(),
                    'sent_at'        => now(),
                ]);
            }

            return [
                'success'        => false,
                'transactionId'  => null,
                'statusCode'     => 'EXCEPTION',
                'statusMessage'  => $e->getMessage(),
                'raw'            => [],
            ];
        }
    }

    /**
     * Send a single SMS (convenience wrapper).
     */
    public function sendOne(string $recipient, string $message, array $options = []): array
    {
        return $this->send([$recipient], $message, $options);
    }

    /**
     * Send bulk SMS to many recipients with the same message.
     * Batches into groups of 25 to stay within optimal delivery.
     */
    public function sendBulk(array $recipients, string $message, array $options = []): array
    {
        $results = [];
        $chunks  = array_chunk($recipients, 25);

        foreach ($chunks as $chunk) {
            $results[] = $this->send($chunk, $message, $options);
        }

        $allSuccess = collect($results)->every(fn ($r) => $r['success']);

        return [
            'success'    => $allSuccess,
            'batches'    => count($chunks),
            'totalSent'  => count($recipients),
            'results'    => $results,
        ];
    }

    /* ──────────────────────────────────────────────
     *  Number normalisation
     * ────────────────────────────────────────────── */

    /**
     * Convert a local or partially-international number to full E.164 (without +).
     *
     * e.g. 0977123456 → 260977123456
     *      260977123456 → 260977123456
     *      +260977123456 → 260977123456
     */
    public function normaliseNumber(string $number): string
    {
        // Remove spaces, dashes, parentheses
        $number = preg_replace('/[\s\-\(\)\+]/', '', $number);

        // If it starts with "0", replace leading 0 with country code
        if (str_starts_with($number, '0')) {
            $number = $this->countryCode . substr($number, 1);
        }

        // If it doesn't start with the country code, prepend it
        if (!str_starts_with($number, $this->countryCode)) {
            $number = $this->countryCode . $number;
        }

        return $number;
    }

    /* ──────────────────────────────────────────────
     *  Subscription management (optional)
     * ────────────────────────────────────────────── */

    /**
     * Register a callback URL for MO / Delivery Receipts.
     */
    public function createSubscription(string $callbackUrl, string $serviceCode, ?string $deliveryReportUrl = null): array
    {
        $payload = [
            'callbackUrl'  => $callbackUrl,
            'targetSystem' => 'ZikoVillageBanks',
            'serviceCode'  => $serviceCode,
        ];

        if ($deliveryReportUrl) {
            $payload['deliveryReportUrl'] = $deliveryReportUrl;
        }

        $token    = $this->getAccessToken();
        $response = Http::withToken($token)
            ->acceptJson()
            ->post("{$this->baseUrl}/messages/sms/subscription", $payload);

        return $response->json() ?? [];
    }

    /**
     * Delete an existing subscription.
     */
    public function deleteSubscription(string $subscriptionId): array
    {
        $token    = $this->getAccessToken();
        $response = Http::withToken($token)
            ->acceptJson()
            ->delete("{$this->baseUrl}/messages/sms/subscription/{$subscriptionId}");

        return $response->json() ?? [];
    }
}
