<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisbursementRequest;
use App\Models\Disbursement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\WeeklyAllowance;
use App\Models\Voucher;
use App\Helpers\LogActivity;

class DisbursementRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $disbursement_requests = DisbursementRequest::latest()
            ->groupBy(DB::raw(implode(',', Schema::getColumnListing('disbursement_requests'))))
            ->paginate(10);
        return view('finance.request.index', compact('disbursement_requests'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('finance.request.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'request_date' => 'required',
        ]);

        DisbursementRequest::create($request->all());

        LogActivity::addToLog('Added new disbursement request record for ' . $request->request_date . '. Requested by ' . $request->prepared_by . '.');

        return redirect()->route('request.index')->with('success', 'Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */

     public function show(string $id)
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
        $weeklyAllowanceTotal = WeeklyAllowance::sum('allowance');
        $disbursementTotal = Disbursement::where('request_id', $disbursementRequest->id)->sum('unit_price');
        $Total =  $weeklyAllowanceTotal + $disbursementTotal;

        $weeklyAllowances = WeeklyAllowance::all();
        $disbursements = Disbursement::where('request_id', $disbursementRequest->id)->get();

        return view('finance.request.show', compact('disbursementRequest', 'vouchers', 'weeklyAllowances', 'disbursements', 'Total'));
            
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DisbursementRequest $request)
    {
        return view('finance.request.edit', compact('request'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DisbursementRequest $disbursement_request)
    {
        $request->validate([
            'request_date' => 'required',
        ]);

        $disbursement_request->update($request->all());

        LogActivity::addToLog('Modified disbursement request record for ' . $request->request_date . '. Requested by ' . $request->prepared_by . '.');

        return redirect()->route('request.index')->with('success', 'Record Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disbursement_request = DisbursementRequest::findorFail($id);
        $disbursement_request->delete();

        LogActivity::addToLog('Deleted request record for ' . $disbursement_request->request_date . '. Requested by: ' . $disbursement_request->prepared_by . '.');

        return redirect()->route('request.index')->with('success', 'Record Deleted Successfully.');
    }

    public function viewAll()
    {
        $donation = Donation::latest()->paginate(10);
        $inventory = Inventory::latest()->paginate(10);
        return view('inventory.all', compact('inventory', 'donation'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
}
