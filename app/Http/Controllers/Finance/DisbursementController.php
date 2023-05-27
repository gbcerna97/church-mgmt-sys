<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disbursement;
use App\Models\DisbursementRequest;

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

        Disbursement::create($request->all());

        return redirect()->route('disbursement.index')->with('success','Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Disbursement $disbursement)
    {
        return view('finance.disbursement.show',compact('giver'));
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
        
        $disbursement->update($request->all());

        return redirect()
            ->route('disbursement.index')
            ->with('success', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disbursement $disbursement)
    {
        $disbursement->delete();

        return redirect()->route('disbursement.index')->with('success', 'Record Deleted Succesfully');
    }
}
