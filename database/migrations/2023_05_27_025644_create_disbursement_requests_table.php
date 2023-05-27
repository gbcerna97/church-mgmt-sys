<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisbursementRequest;

class DisbursementRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $disbursementRequests = DisbursementRequest::paginate(5);
        return view('finance.request.index', compact('disbursementRequests'));
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
    public function show(DisbursementRequest $disbursementRequest)
    {
        return view('finance.request.show', compact('disbursementRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DisbursementRequest $disbursementRequest)
    {
        return view('finance.request.edit', compact('disbursementRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DisbursementRequest $disbursementRequest)
    {
        $request->validate([
            'request_date' => 'required',
        ]);

        $disbursementRequest->update($request->all());

        return redirect()->route('request.index')->with('success', 'Record Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DisbursementRequest $disbursementRequest)
    {
        $disbursementRequest->delete();

        return redirect()->route('request.index')->with('success', 'Record Deleted Successfully.');
    }
}
