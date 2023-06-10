<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisbursementRequest;
use App\Models\Disbursement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\WeeklyAllowance;
use App\Models\Voucher;

class VoucherController extends Controller
{
   
    public function index(string $id)
    {
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

        return view('finance.request.voucher', compact('disbursementRequest', 'vouchers', 'weeklyAllowances', 'disbursements'));
          


        
    }

    

   
}
