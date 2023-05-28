<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giver;
use App\Models\Fund;
use App\Models\ChurchInfo;
use DataTables;
use Illuminate\Support\Facades\DB;

class GiverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $givers = Giver::latest()
            ->groupBy('givers.date', 'givers.id', 'givers.giver_name', 'givers.tithe', 'givers.offering', 'givers.mission', 'givers.sanctuary', 'givers.love_gift', 'givers.dance_ministry')
            ->paginate(10);


        return view('finance.giver.index', compact('givers'))->with('i', (request()->input('page', 1) - 1) * 5);

    }


    /**
     * Create a new resource.
     */
    public function create(Request $request)
    {
        return view('finance.giver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
        ]);

        // Aggregate the fields
        $total = $request->tithe + $request->offering + $request->mission + $request->sanctuary + $request->love_gift + $request->dance_ministry;

        $giver = new Giver;
        $giver->giver_name = $request->giver_name;
        $giver->date = $request->date;
        $giver->tithe = $request->tithe;
        $giver->offering = $request->offering;
        $giver->mission = $request->mission;
        $giver->sanctuary = $request->sanctuary;
        $giver->love_gift = $request->love_gift;
        $giver->dance_ministry = $request->dance_ministry;
        $giver->total = $total;
        $giver->save();

        // Check if the date already exists in the funds table
        $existingFund = Fund::where('date', $request->date)->first();
        $church = ChurchInfo::first();

        $church->givers_funds += $total;
        $church->overall_funds += $total;
        $church->save();

        if ($existingFund) {
            // Update the existing fund total
            $existingFund->fund += $total;
            $existingFund->save();
        } else {
            // Create a new fund record
            Fund::create([
                'date' => $request->date,
                'fund' => $total,
            ]);
        }

        return redirect()->route('giver.index')->with('success','Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Giver $giver)
    {
        return view('finance.giver.show',compact('giver'));
    }

    /**
     * Edit the specified resource.
     */
    public function edit(Giver $giver)
    {
        return view('finance.giver.edit', compact('giver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Giver $giver)
    {
        
        $request->validate([
            'date' => 'required',   
        ]);

        // Aggregate the fields
        $newTotal = $request->tithe + $request->offering + $request->mission + $request->sanctuary + $request->love_gift + $request->dance_ministry;

        $oldTotal = $giver->total;

        $giver->giver_name = $request->giver_name;
        $giver->date = $request->date;
        $giver->tithe = $request->tithe;
        $giver->offering = $request->offering;
        $giver->mission = $request->mission;
        $giver->sanctuary = $request->sanctuary;
        $giver->love_gift = $request->love_gift;
        $giver->dance_ministry = $request->dance_ministry;
        $giver->total = $newTotal;
        $giver->update();

        // Update the fund balance
        $existingFund = Fund::where('date', $request->date)->first();
        $church = ChurchInfo::first();

        $church->givers_funds -= $oldTotal;
        $church->givers_funds += $newTotal;
        $church->overall_funds -= $oldTotal;
        $church->overall_funds += $newTotal;
        $church->save();

        if ($existingFund) {
            // Deduct the old total and add the new total to the fund balance
            $existingFund->fund -= $oldTotal;
            $existingFund->fund += $newTotal;
            $existingFund->save();
        }

        return redirect()->route('giver.index')->with('success','Giver Record Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Giver $giver)
    {
        // Check if the date already exists in the funds table
        $existingFund = Fund::where('date', $giver->date)->first();
        $church = ChurchInfo::first();

        $church->givers_funds -= $giver->total;
        $church->overall_funds -= $giver->total;
        $church->save();

        if ($existingFund) {
            // Update the existing fund total
            $existingFund->fund -= $giver->total;
            
            $existingFund->save();
        }

        $giver->delete();

        return redirect()->route('giver.index')->with('success', 'Record Deleted Succesfully');
    }
}
