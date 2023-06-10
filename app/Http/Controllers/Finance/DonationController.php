<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Models\Donation;
use App\Models\ChurchInfo;
use App\Helpers\LogActivity;

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
            'amount' => 'required_if:donation_type,monetary', // Validation rule for amount if donation_type is monetary
        ]);

        $donation = Donation::create($request->all());

        LogActivity::addToLog('Added new donation record for "' . $request->donor_name . '". Donated on ' . $request->date . '.');

        // Check if donation type is monetary and set donations_funds value accordingly
        if ($donation->amount) {
            $church = ChurchInfo::first();
            $church->donations_funds += $donation->amount;
            $church->overall_funds += $donation->amount;
            $church->save();

            LogActivity::addToLog('Updated donation fund.');
        }

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
    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'donor_name' => 'required',
            'date' => 'required',
            'donation_type' => 'required',
            'amount' => 'required_if:donation_type,monetary', // Validation rule for amount if donation_type is monetary
        ]);

        $oldAmount = $donation->amount;
        $newAmount = $request->amount;

        // Check if donation type is monetary and update donations_funds value accordingly
        if ($donation->amount) {
            $church = ChurchInfo::first();
            $church->donations_funds -= $oldAmount;
            $church->donations_funds += $newAmount;
            $church->overall_funds -= $oldAmount;
            $church->overall_funds += $newAmount;
            $church->save();

            LogActivity::addToLog('Updated donation fund.');
        }

        $donation->update($request->all());

        LogActivity::addToLog('Modified donation record for "' . $request->donor_name . '". Donated on ' . $request->date . '.');

        return redirect()->route('donation.index')->with('success','Record Updated Successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        // Check if donation type is monetary and subtract donation amount from donations_funds
        if ($donation->amount) {
            $church = ChurchInfo::first();
            $church->donations_funds -= $donation->amount;
            $church->overall_funds -= $donation->amount;
            $church->save();

            LogActivity::addToLog('Updated donation fund.');
        }
        
        LogActivity::addToLog('Deleted donation record for "' . $donation->donor_name . '".');

        $donation->delete();

        

        return redirect()->route('donation.index')->with('success', 'Record Deleted Successfully');
    }

}
