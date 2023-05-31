<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Donation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //get the current user logged in
        $user = User::find(auth()->user()->id);

        //retrieve those events that are not yet done

        $events = Event::all();
        $events_counter = Event::where('done', 0)->count();

        $attendees_counter = Attendance::where('present', 1)->count();

        $monthly_fund = Donation::sum('amount');

        return view(
            'dashboard',
            compact(
                'user',
                'events',
                'events_counter',
                'attendees_counter',
                'monthly_fund'
            )
        );
    }
}
