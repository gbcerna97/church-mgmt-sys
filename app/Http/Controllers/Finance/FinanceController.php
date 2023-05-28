<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashCount;
use App\Models\Giver;
use App\Models\Fund;
use App\Models\ChurchInfo;

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

    public function show($date)
    {

        $date = $date;

        $givers = Giver::select('date')
            ->selectRaw('SUM(tithe) as total_tithe, SUM(offering) as total_offering, SUM(mission) as total_mission, SUM(sanctuary) as total_sanctuary, SUM(love_gift) as total_love_gift, SUM(dance_ministry) as total_dance_ministry')
            ->where('date', $date)
            ->groupBy('date')
            ->get();
        
        $fund = Fund::where('date', $date)->first();

        $church = ChurchInfo::first();

        $cashCount = CashCount::where('date', $date)->first();

        $cc_1000_t = $cashCount->cc_1000 * 1000;
        $cc_500_t = $cashCount->cc_500 * 500;
        $cc_200_t = $cashCount->cc_200 * 200;
        $cc_100_t = $cashCount->cc_100 * 100;
        $cc_50_t = $cashCount->cc_50 * 50;
        $cc_20_t = $cashCount->cc_20 * 20;
        $cc_10_t = $cashCount->cc_10 * 10;
        $cc_5_t = $cashCount->cc_5 * 5;
        $cc_1_t = $cashCount->cc_1 * 1;
        $cc_0_25_t = $cashCount->cc_0_25 * 0.25;
        $cc_0_1_t = $cashCount->cc_0_1 * 0.1;
        $cc_0_05_t = $cashCount->cc_0_05 * 0.05;
        $cc_0_01_t = $cashCount->cc_0_01 * 0.01;

        $total = $cc_1000_t +
            $cc_500_t +
            $cc_200_t +
            $cc_100_t +
            $cc_50_t +
            $cc_20_t +
            $cc_10_t +
            $cc_5_t +
            $cc_1_t +
            $cc_0_25_t +
            $cc_0_1_t +
            $cc_0_05_t +
            $cc_0_01_t;

        $cashCount->total = $total;
        $cashCount->save();

        return view('finance.accounting.show', compact('givers', 'fund', 'date', 'church', 'cashCount', 'cc_1000_t', 'cc_500_t', 'cc_200_t', 'cc_100_t', 'cc_50_t', 'cc_20_t', 'cc_10_t', 'cc_5_t', 'cc_1_t', 'cc_0_25_t', 'cc_0_1_t', 'cc_0_05_t', 'cc_0_01_t'));
    }
}