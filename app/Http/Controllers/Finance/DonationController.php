<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $donations = Donation::all();
        return view('finance.donation.index', compact('donations'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Create a new resource.
     */
    public function create(Request $request)
    {
        return view('finance.donation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required',
            'date' => 'required',
            'donation_type' => 'required',
        ]);

        Donation::create($request->all());

        return redirect()->route('donation.index')->with('success','Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        return view('finance.donation.show',compact('donation'));
    }

    /**
     * Edit the specified resource.
     */
    public function edit(Donation $donation)
    {
        return view('finance.donation.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $giver = CashCount::findorFail($id);
        $giver->update($giver);

        return $giver;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashCount $giver)
    {
        $giver->delete();

        return redirect()->route('giver.index')->with('success', 'Record Deleted Succesfully');
    }
}
