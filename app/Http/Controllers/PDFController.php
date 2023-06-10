<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\Controller;
use App\Models\DisbursementRequest;
use App\Models\Disbursement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\WeeklyAllowance;
use App\Models\Voucher;

class PDFController extends Controller
{
    public function exportPDF()
{
    // Get the view content
    
    $html = view('finance.request.PDF_Voucher')->render();

    // Initialize Dompdf
    $dompdf = new Dompdf();
    $dompdf->setPaper('A4', 'portrait');

    // Set the PDF options
    $options = $dompdf->getOptions();
    $options->set('isPhpEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('margin_top', 0);
    $options->set('margin_right', 3);
    $options->set('margin_bottom', 0);
    $options->set('margin_left', 0);

    // Load HTML content
    $dompdf->loadHtml($html);

    // Render the first page
    $dompdf->render();

    // Get the total number of pages
    $totalPages = $dompdf->getCanvas()->get_page_count();

    // Export each page as a separate PDF file
    for ($page = 1; $page <= $totalPages; $page++) {
        // Clone the Dompdf instance
        $pdf = clone $dompdf;

        if ($page !== 1) {
            // Split the HTML to a specific page
            $pdf->getCanvas()->reset();
            $pdf->getCanvas()->open_object();
            $pdf->getCanvas()->clip();
            $pdf->getCanvas()->start_page();

            $pdf->getCanvas()->raw_output($pdf->getCanvas()->page_text(10, 10, "Page $page of $totalPages", null, 10));

            $slicedHtml = $dompdf->splitHtml($html, $page - 1);
            $pdf->loadHtml($slicedHtml);
            $pdf->render();

            $pdf->getCanvas()->end_page();
            $pdf->getCanvas()->close_object();
            $pdf->getCanvas()->add_object($pdf->getCanvas()->get_object_id(), 'all');
        }

        // Generate the response
        $pdf->stream("wala_lang{$page}.pdf", ['Attachment' => false]);
    }
}

    
    public function previewPDF(string $id)
    {
        $data = [
            'pdfSize' => 'a4',
        ];

        $disbursementRequest = DisbursementRequest::findOrFail($id);
        $vouchers = Voucher::all();

        

        foreach ($vouchers as $voucher) {
            // Access the related WeeklyAllowance data
            $weeklyAllowance = $voucher->weeklyAllowance;
            if ($weeklyAllowance) {
                // Access the properties of the WeeklyAllowance model
                $allowanceName = $weeklyAllowance->name;
                // Do something with the WeeklyAllowance data
            }

            // Access the related Disbursement data
            $disbursement = $voucher->disbursement;
            if ($disbursement) {
                // Access the properties of the Disbursement model
                $disbursementAmount = $disbursement->amount;
                // Do something with the Disbursement data
            }
        }

        $weeklyAllowances = WeeklyAllowance::all();
        $disbursements = Disbursement::where('request_id', $disbursementRequest->id)->get();

        return view('finance.request.PDF_Voucher', ['data'=>$data],compact('data','disbursementRequest', 'vouchers', 'weeklyAllowances', 'disbursements'));

    }

}
