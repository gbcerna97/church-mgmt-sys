<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Giver;
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
        ->select('givers.id', 'givers.giver_name') // Include the giver_name column
        ->selectRaw('SUM(tithe) + SUM(offering) + SUM(mission) + SUM(sanctuary) + SUM(love_gift) + SUM(dance_ministry) AS sum')
        ->groupBy('givers.id', 'givers.giver_name') // Include giver_name in the GROUP BY clause
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
            'giver_name' => 'required',
            'date' => 'required',
        ]);

        Giver::create($request->all());

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
    public function update(Request $request, string $id)
    {
        
        $giver = Giver::findorFail($id);
        $giver->update($giver);

        return $giver;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Giver $giver)
    {
        $giver->delete();

        return redirect()->route('giver.index')->with('success', 'Record Deleted Succesfully');
    }
}
