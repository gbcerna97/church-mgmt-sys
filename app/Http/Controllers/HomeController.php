<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Donation;
use App\Models\ChurchInfo;
use App\Models\Fund;

class HomeController extends Controller
{
    public function dashboard()
    {
        // Get the current user logged in
        $user = auth()->user();

        // Retrieve those events that are not yet done
        $events = Event::where('done', 0)->get();
        $events_counter = $events->count();

        $attendees_counter = Attendance::where('present', 1)->count();
        $church_info = ChurchInfo::first();

        $givers_fund = Fund::all();
        $monthly_fund = Donation::sum('amount');

        return view('dashboard', compact('user', 'events', 'events_counter', 'attendees_counter', 'church_info', 'givers_fund', 'monthly_fund'));
    }
}

