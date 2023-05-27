<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashCount;
use App\Models\Giver;
use App\Models\Fund;

class FinanceController extends Controller
{
    public function index()
    {
        $dates = Giver::distinct('date')->pluck('date')->toArray();
        $funds = [];

        foreach ($dates as $date) {
            $fund = Fund::where('date', $date)->first();

            if ($fund) {
                $funds[$date] = $fund; // Store the fund in the $funds array with the date as the key
            }
        }

        return view('finance.accounting.index', compact('dates', 'funds'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Request $date)
    {

        $givers = Giver::select('date')
            ->selectRaw('SUM(tithe) as total_tithe, SUM(offering) as total_offering, SUM(mission) as total_mission, SUM(sanctuary) as total_sanctuary, SUM(love_gift) as total_love_gift, SUM(dance_ministry) as total_dance_ministry')
            ->where('date', $date)
            ->groupBy('date')
            ->get();

        $cashcount = CashCount::where('date', $date)->get();

        return view('finance.accounting.show', compact('givers', 'cashcount'));
    }
}