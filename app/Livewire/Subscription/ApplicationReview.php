<?php

namespace App\Livewire\Subscription;

use App\Models\Subscription\BankApplication;
use App\Models\Subscription\License;
use App\Models\Subscription\Subscription;
use App\Models\User;
use App\Models\VillageBanking\VillageBank;
use App\Mail\Subscription\ApplicationApproved;
use App\Mail\Subscription\ApplicationRejected;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class ApplicationReview extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $statusFilter = 'pending';
    public $perPage = 10;

    /* ── Review (inline in detail view) ── */
    public $showReviewModal = false;
    public $reviewAppId = null;
    public $adminRemarks = '';
    public $reviewAction = ''; // approve | reject

    /* ── Detail view ── */
    public $showDetailModal = false;
    public $detailAppId = null;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function viewDetail($id)
    {
        $this->detailAppId = $id;
        $this->showDetailModal = true;
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->detailAppId = null;
        $this->reviewAction = '';
        $this->adminRemarks = '';
        $this->reviewAppId = null;
    }

    public function startReview($action)
    {
        $this->reviewAction = $action;
        $this->reviewAppId = $this->detailAppId;
        $this->adminRemarks = '';
    }

    public function cancelReviewAction()
    {
        $this->reviewAction = '';
        $this->adminRemarks = '';
        $this->reviewAppId = null;
    }

    public function submitReview()
    {
        $this->validate([
            'adminRemarks' => $this->reviewAction === 'reject' ? 'required|string|max:500' : 'nullable|string|max:500',
        ], [
            'adminRemarks.required' => 'Please provide a reason for rejection.',
        ]);

        $application = BankApplication::findOrFail($this->reviewAppId);

        if ($application->status !== 'pending') {
            session()->flash('error', 'This application has already been reviewed.');
            $this->closeDetailModal();
            return;
        }

        if ($this->reviewAction === 'approve') {
            $this->approveApplication($application);
        } else {
            $this->rejectApplication($application);
        }

        $this->closeDetailModal();
    }

    private function approveApplication(BankApplication $application)
    {
        DB::transaction(function () use ($application) {
            // 1. Create the Village Bank
            $villageBank = VillageBank::create([
                'name'        => $application->bank_name,
                'code'        => $application->bank_code ?: Str::upper(Str::random(6)),
                'description' => $application->bank_description,
                'address'     => $application->bank_address,
                'phone'       => $application->bank_phone,
                'email'       => $application->bank_email,
                'status'      => 'active',
                'created_by'  => Auth::id(),
            ]);

            // 2. Create user account for the contact person (if not exists)
            $staffNo = $application->contact_staff_no ?: ('VB' . str_pad($villageBank->id, 4, '0', STR_PAD_LEFT));
            $user = User::where('username', $staffNo)->first();

            if (!$user) {
                $user = User::create([
                    'name'             => $application->contact_name,
                    'username'         => $staffNo,
                    'email'            => $application->contact_email,
                    'mobile_no'        => $application->contact_phone,
                    'password'         => Hash::make('password123'),
                    'password_changed' => false,
                    'status'           => 'active',
                    'uuid'             => Str::uuid(),
                ]);
            }

            // 3. Add user as admin of the village bank
            $villageBank->members()->syncWithoutDetaching([
                $user->id => ['role' => 'admin', 'joined_at' => now()],
            ]);

            // 4. Create subscription
            $plan = $application->plan;
            $subscription = Subscription::create([
                'village_bank_id'      => $villageBank->id,
                'subscription_plan_id' => $plan->id,
                'status'               => 'active',
                'starts_at'            => now(),
                'ends_at'              => now()->addDays($plan->duration_days),
                'auto_renew'           => false,
            ]);

            // 5. Generate license
            $license = License::create([
                'village_bank_id'  => $villageBank->id,
                'subscription_id'  => $subscription->id,
                'license_key'      => License::generateKey(),
                'status'           => 'active',
                'issued_at'        => now(),
                'expires_at'       => now()->addDays($plan->duration_days),
            ]);

            // 6. Update application
            $application->update([
                'status'          => 'approved',
                'admin_remarks'   => $this->adminRemarks ?: 'Application approved.',
                'reviewed_by'     => Auth::id(),
                'reviewed_at'     => now(),
                'village_bank_id' => $villageBank->id,
            ]);

            // 7. Send approval email to contact person and CC bank email
            try {
                $mail = Mail::to($application->contact_email);
                if ($application->bank_email && $application->bank_email !== $application->contact_email) {
                    $mail->cc($application->bank_email);
                }
                $mail->send(new ApplicationApproved($application, $license->license_key, $staffNo));
            } catch (\Exception $e) {
                // Log but don't block the approval
                \Log::warning('Failed to send approval email: ' . $e->getMessage());
            }
        });

        session()->flash('success', 'Application approved! Village bank, user account, subscription and license created.');
    }

    private function rejectApplication(BankApplication $application)
    {
        $application->update([
            'status'        => 'rejected',
            'admin_remarks' => $this->adminRemarks,
            'reviewed_by'   => Auth::id(),
            'reviewed_at'   => now(),
        ]);

        // Send rejection email to contact person and CC bank email
        try {
            $mail = Mail::to($application->contact_email);
            if ($application->bank_email && $application->bank_email !== $application->contact_email) {
                $mail->cc($application->bank_email);
            }
            $mail->send(new ApplicationRejected($application));
        } catch (\Exception $e) {
            \Log::warning('Failed to send rejection email: ' . $e->getMessage());
        }

        session()->flash('success', 'Application rejected.');
    }

    public function render()
    {
        $applications = BankApplication::with('plan', 'reviewer')
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('bank_name', 'like', '%' . $this->search . '%')
                       ->orWhere('contact_name', 'like', '%' . $this->search . '%')
                       ->orWhere('contact_email', 'like', '%' . $this->search . '%')
                       ->orWhere('payment_reference', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        // Load detail app fresh each render (avoid storing Eloquent model as public property)
        $detailApp = null;
        if ($this->showDetailModal && $this->detailAppId) {
            $detailApp = BankApplication::with('plan', 'reviewer')->find($this->detailAppId);
            if (!$detailApp) {
                $this->showDetailModal = false;
                $this->detailAppId = null;
            }
        }

        return view('livewire.subscription.application-review', compact('applications', 'detailApp'));
    }
}
