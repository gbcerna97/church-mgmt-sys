<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disbursement;
use App\Models\ChurchInfo;
use App\Models\DisbursementRequest;
use App\Models\Voucher;
use App\Helpers\LogActivity;

class DisbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $disbursements = Disbursement::all();
        return view('finance.disbursement.index', compact('disbursements'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Create a new resource.
     */
    public function create(Request $request)
    {

        $disbursementRequests = DisbursementRequest::all();

        return view('finance.disbursement.create', compact('disbursementRequests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'request_id' => 'required',
        ]);

        
        $year = date('Y');
        $lastDisbursement = Voucher::where('voucher_number', 'like', 'CV#' . $year . '-%')
            ->orderBy('voucher_number', 'desc')
            ->first();

        $incrementNumber = 1;
        if ($lastDisbursement) {
            $lastCVNumber = $lastDisbursement->voucher_number;
            $lastIncrementNumber = intval(substr($lastCVNumber, -5));
            $incrementNumber = $lastIncrementNumber + 1;
        }

        $cvNumber = 'CV#' . $year . '-' . str_pad($incrementNumber, 5, '0', STR_PAD_LEFT);

        $church = ChurchInfo::first();
        if ($request->fund_source === 'GF') {
            $church->overall_funds -= $request->unit_price;
        }
        $church->save();

        LogActivity::addToLog('Updated overall fund, amount subtracted with  ' . $cvNumber);

        $voucher = new Voucher($request->all());
        $disbursement = new Disbursement($request->all());
        $disbursement->save();
        $voucher->voucher_number = $cvNumber;
        $voucher->dis_id = $disbursement -> id;
        $voucher->save();
       
        LogActivity::addToLog('Added new disbursement record with ' . $cvNumber);

        return redirect()->route('disbursement.index')->with('success', 'Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disbursement $disbursement)
    {
        return view('finance.disbursement.show',compact('disbursement'));
    }

    /**
     * Edit the specified resource.
     */
    public function edit(Disbursement $disbursement)
    {
        $disbursementRequests = DisbursementRequest::all();

        return view('finance.disbursement.edit', compact('disbursementRequests', 'disbursement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disbursement $disbursement)
    {

        $request->validate([
            'request_id' => 'required',
        ]);

        $oldUnitPrice = $disbursement->unit_price;
        $newUnitPrice = $request->unit_price;

        $church = ChurchInfo::first();
        if ($request->fund_source === 'GF') {
            $church->overall_funds += $oldUnitPrice;
            $church->overall_funds -= $newUnitPrice;
        }
        $church->save();

        LogActivity::addToLog('Updated overall fund, amount subrtracted with  ' . $disbursement->voucher_number);

        $disbursement->update($request->all());
        
        LogActivity::addToLog('Updated disbursement record with ' . $disbursement->voucher_number);

        return redirect()
            ->route('disbursement.index')
            ->with('success', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disbursement $disbursement)
    {
        $church = ChurchInfo::first();
        if ($disbursement->fund_source === 'GF') {
            $church->overall_funds += $disbursement->unit_price;
        }

        LogActivity::addToLog('Updated overall fund, amount subtracted with  ' . $disbursement->voucher_number);

        $disbursement->delete();

        LogActivity::addToLog('Updated disbursement record with ' . $disbursement->voucher_number);

        return redirect()->route('disbursement.index')->with('success', 'Record Deleted Succesfully');
    }

    public function viewDisbursement()
    {
        return view('finance.disbursement.view_disbursment');
    }
}
