<?php

namespace App\Http\Controllers;

use App\Models\ClientDetails;
use App\Models\GisQuotations;
use App\Models\GisQuotationsItems;


use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Illuminate\Support\Facades\Storage;

// Controller for generating PDF invoices
class QuotationPdfController extends Controller
{
    // Class properties for configuration and PDF generation
    public $baseUrl = "";
    public $verifySslCertificate = false;

    // Column size properties for PDF layout
    public $column_one_size = 90;
    public $column_size_145 = 145;
    public $column_size_150 = 150;
    public $column_size_40 = 40;
    public $column_size_45 = 45;
    public $column_size_60 = 60;
    public $column_size_70 = 70;
    public $column_size_20 = 20;
    public $column_size_30 = 30;
    public $column_size_10 = 10;
    public $column_two_size = 50;
    public $column_size_50 = 50;



    public $column_size_55 = 55;
    public $column_size_100 = 100;



    // Row height properties for PDF layout
    public $row_h_4 = 4;
    public $row_h_5 = 5;
    public $row_h_7 = 7;
    public $row_h_14 = 14;
    public $row_h_21 = 21;

    // FPDF instance and error message property
    protected $fpdf;
    private $errorMessage;

    // Constructor to initialize FPDF
    public function __construct()
    {
        $this->fpdf = new Fpdf('P', 'mm', 'A4'); // Create new FPDF instance in portrait mode, millimeters, A4 size
    }

    // Main method to generate and display PDF invoice
    public function index($uuid)
    {
        // Retrieve invoice details by UUID
        $quotationDetals = GisQuotations::where('uuid', $uuid)->first();
        $quotationItems = GisQuotationsItems::where('quotation_id', $quotationDetals->id)->get();
        $client = ClientDetails::where('id', $quotationDetals->client_id)->first();


        // Get active energy details from the invoice

        // Supplier information
        $supplier = 'ZESCO LIMITED, Stand No. 6949 Great East Road, P.O Box 33304, Lusaka-Zambia';

        // Get latest TPIN (Taxpayer Identification Number)
        $latestTpin = $client->tpin;


        // Format dates
        $formatted_due_date = Carbon::parse($quotationDetals->quotation_date)->format('d-m-y');
        $transaction_date = Carbon::parse($quotationDetals->quotation_date)->format('d-m-Y');

        // Set currency information
        if ($quotationDetals->currency ?? 'ZMW') {
            $fraction_currency = 'Ngwee';
            $main_currency = 'Kwacha';
        } else if (($quotationDetals->currency ?? "ZMW") == 'USD') {
            $main_currency = 'Dollars';
            $fraction_currency = 'Cents';
        } else {
            $main_currency = ($quotationDetals->currency ?? "ZMW");
            $fraction_currency = '';
        }

        // Calculate total amount and convert to words
        $total_amount = round(abs(($quotationDetals->quotation_final ?? ($quotationDetals->quotation_final)) ?? 1), 4);
        $amount_in_words = self::convertNumberToWords($total_amount, $main_currency, $fraction_currency);

        // Path to logo image
        $filepath = public_path() . '/img/logo zesco.png';

        // Set PDF properties
        $this->fpdf->SetAuthor('ZESCO Bulk Billing Invoice');
        $watermarkPath = public_path() . '/img/zesco watermark.png';

        // Footer images configuration
        $maxFooterHeight = 20;
        $startX = 10;
        $spacing = 10;
        $footerImages = [
            public_path() . '/img/IDC .png',
        ];
        $lineImage = public_path() . '/img/line faded (1).png';

        // Set PDF title and page numbering
        $this->fpdf->SetTitle('Export');
        $this->fpdf->AliasNbPages('{pages}');
        $this->fpdf->SetAutoPageBreak(true, 15);
        $this->fpdf->AddPage();

        // Font size settings
        $label_size = '8';
        $text_size = '8';

        // Add logo to PDF
        if (file_exists($filepath)) {
            $this->fpdf->Image($filepath, 90, 0, 30);
            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->Ln(20);
        }

        // Add watermark to PDF
        if (file_exists($watermarkPath)) {
            $pageWidth = $this->fpdf->GetPageWidth();
            $pageHeight = $this->fpdf->GetPageHeight();
            list($imageWidth, $imageHeight) = getimagesize($watermarkPath);
            $scaleFactor = min($pageWidth / $imageWidth, $pageHeight / $imageHeight);
            $scaledWidth = $imageWidth * $scaleFactor;
            $scaledHeight = $imageHeight * $scaleFactor;
            $x = ($pageWidth - $scaledWidth) / 2;
            $y = ($pageHeight - $scaledHeight) / 2;
            $this->fpdf->Image($watermarkPath, $x, $y, $scaledWidth, $scaledHeight, 'PNG');
        }

        // Add footer images
        foreach ($footerImages as $footerImagePath) {
            if (file_exists($footerImagePath)) {
                list($footerWidth, $footerHeight) = getimagesize($footerImagePath);
                $footerScaleFactor = min($maxFooterHeight / $footerHeight, 1);
                $scaledFooterWidth = $footerWidth * $footerScaleFactor;
                $scaledFooterHeight = $footerHeight * $footerScaleFactor;
                $footerY = $pageHeight - $scaledFooterHeight - 25;
                $this->fpdf->Image($footerImagePath, $startX, $footerY, $scaledFooterWidth, $scaledFooterHeight);
                $startX += $scaledFooterWidth + $spacing;
            }
        }

        // Add line image to footer
        if (file_exists($lineImage)) {
            list($lineWidth, $lineHeight) = getimagesize($lineImage);
            $scaledLineWidth = $pageWidth * 0.9;
            $lineScaleFactor = $scaledLineWidth / $lineWidth;
            $scaledLineHeight = $lineHeight * $lineScaleFactor;
            $lineX = ($pageWidth - $scaledLineWidth) / 2;
            $lineY = $pageHeight - $scaledLineHeight - 8;
            $this->fpdf->Image($lineImage, $lineX, $lineY, $scaledLineWidth, $scaledLineHeight);
        }

        // Invoice details section
        $row_h_4 = 4;
        $this->fpdf->SetFont('Arial', 'B', $label_size);
        $this->fpdf->Cell(190, 15, 'QUOTATION', 0, 0, 'C');
        $this->fpdf->Ln();


        // Empty line spacer
        $this->fpdf->Cell(189, 5, '', 0, 1);


        //make a dummy empty cell as a vertical spacer
//-------------------------------------------------------------------------------------------------------
        $this->fpdf->Cell(189, 5, '', 0, 1);//end of line
//-------------------------------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------------------------------
        // ADD A NEW PAGE
        //-------------------------------------------------------------------------------------------------------


        //-------------------------------------------------------------------------------------------------------
        //SET THE IMAGES
        //-------------------------------------------------------------------------------------------------------

        if (file_exists($filepath)) {
            $this->fpdf->Image($filepath, 90, 0, 30);
            // Arial bold 15
            $this->fpdf->SetFont('Arial', 'B', 15);
            // Move to the right
            // $this->fpdf->Cell(80);
            // Line break
            $this->fpdf->Ln(20);
        }
        if (file_exists($watermarkPath)) {
            // Get page dimensions
            $pageWidth = $this->fpdf->GetPageWidth();
            $pageHeight = $this->fpdf->GetPageHeight();

            // Get image dimensions
            list($imageWidth, $imageHeight) = getimagesize($watermarkPath);

            // Calculate scaling factor to fit the image within the page
            $scaleFactor = min($pageWidth / $imageWidth, $pageHeight / $imageHeight);

            // Calculate dimensions of scaled image
            $scaledWidth = $imageWidth * $scaleFactor;
            $scaledHeight = $imageHeight * $scaleFactor;

            // Calculate coordinates to place the image in the center
            $x = ($pageWidth - $scaledWidth) / 2;
            $y = ($pageHeight - $scaledHeight) / 2;

            // Add the watermark image
            $this->fpdf->Image($watermarkPath, $x, $y, $scaledWidth, $scaledHeight, 'PNG');
        }

        $maxFooterHeight = 15; // Adjust as needed
        $startX = 10; // Starting X position
        $spacing = 2; // Spacing between images
        foreach ($footerImages as $footerImagePath) {
            if (file_exists($footerImagePath)) {
                // Get image dimensions
                list($footerWidth, $footerHeight) = getimagesize($footerImagePath);

                // Calculate scaling factor to fit the image within the footer
                $footerScaleFactor = min($maxFooterHeight / $footerHeight, 1);

                // Scale image dimensions
                $scaledFooterWidth = $footerWidth * $footerScaleFactor;
                $scaledFooterHeight = $footerHeight * $footerScaleFactor;

                // Calculate Y position (aligned to bottom)
                $footerY = $pageHeight - $scaledFooterHeight - 10;

                // Add the image
                $this->fpdf->Image($footerImagePath, $startX, $footerY, $scaledFooterWidth, $scaledFooterHeight);

                // Update X position for next image
                $startX += $scaledFooterWidth + $spacing;
            }
        }


        $this->fpdf->SetFont('Arial', 'B', $text_size);
        $this->fpdf->Cell($this->column_one_size, $this->row_h_7, 'Reference:' . $quotationDetals->quotation_no, 1, 0);
        $this->fpdf->SetFont('Arial', '', $text_size);
        $this->fpdf->Cell($this->column_two_size, $this->row_h_7, 'ZESCO TPIN', 1, 0, 'C');
        $this->fpdf->Cell($this->column_two_size, $this->row_h_7, '1001750872', 1, 0, 'C');
        $this->fpdf->Ln();

        $this->fpdf->Cell($this->column_size_45, $this->row_h_7, 'CUSTOMERS TPIN', 1, 0);
        $this->fpdf->Cell($this->column_size_45, $this->row_h_7, $client->tpin, 1, 0);

        $this->fpdf->Cell($this->column_two_size, $this->row_h_7, 'Quotation Date', 1, 0);
        $this->fpdf->Cell($this->column_two_size, $this->row_h_7, $quotationDetals->quotation_date, 1, 0, 'C');
        $this->fpdf->Ln();


        $this->fpdf->Cell($this->column_size_45, $this->row_h_7, 'From', 1, 0);
        $this->fpdf->Cell($this->column_size_145, $this->row_h_7, $supplier, 1, 0, 'C');
        $this->fpdf->Ln();
        $this->fpdf->Cell($this->column_size_45, $this->row_h_7, 'To', 1, 0);
        $this->fpdf->Cell($this->column_size_145, $this->row_h_7, $client->company_name ?? '', 1, 0, 'C');
        $this->fpdf->Ln();

        $this->fpdf->Cell($this->column_size_45, $this->row_h_21, 'Customer Full Address', 1, 0);
        $this->fpdf->MultiCell(
            $this->column_size_145,
            $this->row_h_7,

            (($client->address_line_1 ?? '') . "\n" ?? '') .
            ('P.O.BOX ' . ($client->postal_code ?? '')),
            1
        );


        $this->fpdf->Ln();

        //-------------------------------------------------------------------------------------------------------


        if (sizeOf($quotationItems) >= 1) {
            $this->fpdf->Ln();


            $this->fpdf->SetFont('Arial', 'B', $text_size);
            $this->fpdf->Cell($this->column_size_10, $this->row_h_7, 'SN', 1, 0);
            $this->fpdf->Cell($this->column_size_100, $this->row_h_7, 'DESCRIPTION', 1, 0);
            $this->fpdf->Cell($this->column_size_40, $this->row_h_7, 'QTY', 1, 0);
            $this->fpdf->Cell($this->column_size_40, $this->row_h_7, 'AMOUNT', 1, 0, 'C');



            foreach ($quotationItems as $item) {
                $id = 0;
                $this->fpdf->Ln();
                $this->fpdf->SetFont('Arial', '', $text_size);
                $this->fpdf->Cell($this->column_size_10, $this->row_h_7, ++$id, 1, 0);
                $this->fpdf->Cell($this->column_size_100, $this->row_h_7, $item->description, 1, 0);
                $this->fpdf->Cell($this->column_size_40, $this->row_h_7, $item->quantity, 1, 0, 'C');
                $this->fpdf->Cell($this->column_size_40, $this->row_h_7, $item->unit_price, 1, 0, 'C');

            }
        }
        $this->fpdf->Ln();

        $this->fpdf->Cell($this->column_size_150, $this->row_h_7, 'Total Amount Exclusive of VAT', 1, 0, 'R');
        $this->fpdf->Cell($this->column_size_40, $this->row_h_7, '', 1, 0, 'C');

        $this->fpdf->Ln();


        $this->fpdf->Cell($this->column_size_150, $this->row_h_7, 'VAT @ 16 %', 1, 0, 'R');
        $this->fpdf->Cell($this->column_size_40, $this->row_h_7, '', 1, 0, 'C');
        $this->fpdf->Ln();


        $this->fpdf->Cell($this->column_size_150, $this->row_h_7, 'Exchange Rate', 1, 0, 'R');
        $this->fpdf->Cell($this->column_size_40, $this->row_h_7, $quotationDetals->exchange_rate, 1, 0, 'C');
        $this->fpdf->Ln();


        $this->fpdf->Cell($this->column_size_150, $this->row_h_7, 'Total Amount, VAT Inclusive', 1, 0, 'R');
        $this->fpdf->Cell($this->column_size_40, $this->row_h_7, $quotationDetals->quotation_final, 1, 0, 'C');
        $this->fpdf->Ln();


        $this->fpdf->Cell($this->column_size_40, $this->row_h_14, 'Amount In Words', 1, 0, 'C');
        $this->fpdf->MultiCell(
            $this->column_size_150,
            $this->row_h_7,
            (strtoupper($amount_in_words))
            ,
            1,
        );

        $this->fpdf->Ln();

        // Define variables for the values
        $cell_height_bd = 4;
        $label_size_bd = 8;
        $line_height_bd = 0.2; // Define line height
        $zra_column_width = 90; // Width for ZRA details column
        $bank_column_width = 90; // Width for Bank details column
        $cell_height_bd = 5; // Height for cells

        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial', 'B', $label_size);
        $this->fpdf->Cell($this->column_one_size, 5, 'WITH HOLDING TAX @ 15% PAYABLE DIRECTLY TO ZRA', 0, 0);
        $this->fpdf->Ln();

        // Titles for ZRA and Bank Information
        $this->fpdf->SetFont('Arial', 'B', $text_size);
        $this->fpdf->Cell($bank_column_width, $cell_height_bd, "BANK INFORMATION", 0, 1, 'L');
        $this->fpdf->Ln($line_height_bd); // Add space after titles


        $this->fpdf->SetFont('Arial', 'B', $label_size_bd);
        $this->fpdf->Cell(30, $cell_height_bd, "Beneficiary: ", 0, 0, 'L');
        $this->fpdf->SetFont('Arial', '', $label_size_bd);
        $this->fpdf->Cell($bank_column_width - 30, $cell_height_bd, "ZESCO LIMITED", 0, 1, 'L');


        $this->fpdf->SetFont('Arial', 'B', $label_size_bd);
        $this->fpdf->Cell(30, $cell_height_bd, "Bank: ", 0, 0, 'L');
        $this->fpdf->SetFont('Arial', '', $label_size_bd);
        $this->fpdf->Cell($bank_column_width - 30, $cell_height_bd, 'r', 0, 1, 'L');


        $this->fpdf->SetFont('Arial', 'B', $label_size_bd);
        $this->fpdf->Cell(30, $cell_height_bd, "Branch Name: ", 0, 0, 'L');
        $this->fpdf->SetFont('Arial', '', $label_size_bd);
        $this->fpdf->Cell($bank_column_width - 30, $cell_height_bd, 'f', 0, 1, 'L');


        $this->fpdf->SetFont('Arial', 'B', $label_size_bd);
        $this->fpdf->Cell(30, $cell_height_bd, "Account No: ", 0, 0, 'L');
        $this->fpdf->SetFont('Arial', '', $label_size_bd);
        $this->fpdf->Cell($bank_column_width - 30, $cell_height_bd, 'f', 0, 1, 'L');


        $this->fpdf->SetFont('Arial', 'B', $label_size_bd);
        $this->fpdf->Cell(30, $cell_height_bd, "Branch Code: ", 0, 0, 'L');
        $this->fpdf->SetFont('Arial', '', $label_size_bd);
        $this->fpdf->Cell($bank_column_width - 30, $cell_height_bd, 'h', 0, 1, 'L');


        $this->fpdf->SetFont('Arial', 'B', $label_size_bd);
        $this->fpdf->Cell(30, $cell_height_bd, "Swift Code: ", 0, 0, 'L');
        $this->fpdf->SetFont('Arial', '', $label_size_bd);
        $this->fpdf->Cell($bank_column_width - 30, $cell_height_bd, 'g', 0, 1, 'L');


        $this->fpdf->Ln();


        $filename = $quotationDetals->quotation_no . "_" . $transaction_date . "_" . $client->customer_name . "_BPPBS.PDF";

        return response()->streamDownload(function () use ($filename) {
            echo $this->fpdf->Output($filename, 'D');
        }, $filename);
    }


    function convertNumberToWords($number, $main_currency, $fraction_currency)
    {
        // Instantiate the NumberFormatter
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

        // Convert the integer part to words
        $integerPart = floor($number);
        $integerPartInWords = ucfirst($formatter->format($integerPart));

        // Handle the fractional part (cents)
        $fractionalPart = round(($number - $integerPart) * 100);
        $fractionalPartInWords = $formatter->format($fractionalPart);

        // Return the formatted string
        return "$integerPartInWords $main_currency and $fractionalPartInWords $fraction_currency";
    }

    public function getStatements($service_no)
    {
        $client = new Client(['verify' => $this->verifySslCertificate]);
        $response = $client->request(
            "GET",
            config('endpoints.ZESCO_API') . "billing/" . $service_no . "/statement",
            [
                'headers' => [
                    'Authorization' => 'Bearer 43|F0IGzJVUISqq64LiddlMIheGcreiAmskkyDGASCl',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]
        );
        return json_decode($response->getBody(), true);

    }

    private function getCustomerDetails($servicenumber)
    {
        try {
            $client = new Client(['verify' => $this->verifySslCertificate]);
            $url = $this->baseUrl . config('endpoints.SERVICE_NUMBER_CUSTOMER_DETAILS') . $servicenumber;
            $request = new \GuzzleHttp\Psr7\Request('GET', $url, self::getRequestHeaders());
            $res = $client->sendAsync($request)->wait();
            if (http_response_code() == 200) {
                $responseBody = json_decode($res->getBody(), true);
                // set variable to show modal
                return $responseBody['data'];
            } else {
                $responseBody = $res->getBody();
                $this->errorMessage = $responseBody['data'];
                return;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->errorMessage = "We could not process your request right now. Please check your Service number and try again";
            return;
        }
    }

    public function getRequestHeaders(): array
    {
        return [
            'X-API-KEY' => '{{X-API-KEY}}',
            'X-TOKKEN' => '{{X-TOKKEN}}',
            'Authorization' => 'Bearer 43|F0IGzJVUISqq64LiddlMIheGcreiAmskkyDGASCl',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
    }
}
