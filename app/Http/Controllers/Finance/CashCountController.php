<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Church;
use App\Models\CashCount;
use App\Models\Giver;

class CashCountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $givers = Giver::select('giver_name', 'date')
            ->selectRaw('tithe + offering + mission + sanctuary + love_gift + dance_ministry AS total')
            ->paginate(10);

        return view('finance.cashcount.index', compact('givers'))->with('i', (request()->input('page', 1) - 1) * 5);

    }


    /**
     * Create a new resource.
     */
    public function create(Request $request)
    {

        $dates = Giver::distinct('date')->pluck('date')->toArray();

        return view('finance.cashcount.create', compact('dates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
        ]);

        CashCount::create($request->all());

        return redirect()->route('giver.index')->with('success','Record Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashCount $cashcount)
    {
        return view('finance.cashcount.show',compact('giver'));
    }

    /**
     * Edit the specified resource.
     */
    public function edit(CashCount $giver)
    {
        $dates = Giver::distinct('date')->pluck('date')->toArray();

        return view('finance.cashcount.edit', compact('giver', 'dates'));
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
