<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisbursementRequest;
use App\Models\Disbursement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

        return redirect()->route('request.index')->with('success', 'Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $disbursement_request = DisbursementRequest::findorFail($id);
        $disbursements = Disbursement::where('request_id', $disbursement_request->id)->first()
            ->groupBy(DB::raw(implode(',', Schema::getColumnListing('disbursements'))))
            ->paginate(10);
    
        return view('finance.request.show',compact('disbursement_request', 'disbursements'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $disbursement_request = DisbursementRequest::findorFail($id);
        
        return view('finance.request.edit', compact('disbursement_request'));
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

        return redirect()->route('request.index')->with('success', 'Record Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $disbursement_request = DisbursementRequest::findorFail($id);
        $disbursement_request->delete();

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
