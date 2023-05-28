<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory = Inventory::latest()->paginate(10);
        return view('inventory.index', compact('inventory'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inventName' => 'required',
            'ministryName' => 'required',
            'category' => 'required',
            'date_purchased' => 'required',
            'item_num' => 'required',
            'unit_cost' => 'required',
        ]);

        // Aggregate the fields
        $total_cost = $request->item_num * $request->unit_cost;

        $inventory = new Inventory;
        $inventory->inventName = $request->inventName;
        $inventory->inventName = $request->inventName;
        $inventory->category = $request->category;
        $inventory->date_purchased = $request->date_purchased;
        $inventory->item_num = $request->item_num;
        $inventory->total_cost = $total_cost;
        $inventory->save();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Product Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'inventName' => 'required',
            'ministryName' => 'required',
            'category' => 'required',
            'date_purchased' => 'required',
            'item_num' => 'required',
            'unit_cost' => 'required',
        ]);

        $total_cost = $request->item_num * $request->unit_cost;

        $inventory->inventName = $request->inventName;
        $inventory->inventName = $request->inventName;
        $inventory->category = $request->category;
        $inventory->date_purchased = $request->date_purchased;
        $inventory->item_num = $request->item_num;
        $inventory->total_cost = $total_cost;
        $inventory->update();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()
            ->route('inventory.index')
            ->with('success', 'Product Deleted Successfully');
    }
}
