<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Giver;

class GiverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Giver::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $giver = CarouselItem::create($giver);

        return $giver;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $giver = CarouselItem::where('id', $id)->firstorFail();

        return $giver;
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
    public function destroy(string $id)
    {
        $giver = Giver::findorFail($id);
        $giver->delete();
        return $giver;
    }
}
