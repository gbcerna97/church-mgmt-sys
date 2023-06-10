<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\WeeklyAllowance;
use App\Models\Inventory;
use App\Models\Event;
use App\Models\Disbursement;
use App\Models\DisbursementRequest;
use App\Models\Donation;
use App\Models\Giver;
use App\Models\Attendance;

class HomeController extends Controller
{
    public function dashboard()
    {
        $sex = DB::table('Members')->select(DB::raw('COUNT(CASE WHEN sex = "male" THEN 1 END) AS male'), DB::raw('COUNT(CASE WHEN sex = "female" THEN 1 END) AS female'))->first();
        $maleWorkersCount = $sex->male;
        $femaleWorkersCount = $sex->female;
        $totalWorkersCount = $maleWorkersCount + $femaleWorkersCount;



       // $maleAttendeesCount = DB::table('attendees')->where('gender', 'male')->count();
     //   $femaleAttendeesCount = DB::table('attendees')->where('gender', 'female')->count();
     //   $totalAttendeesCount = $maleAttendeesCount + $femaleAttendeesCount;

     $totalWCount = WeeklyAllowance::count();        
        $totalItemsCount = Inventory::count();
        $totalEventsCount = Event::count();
        

      //  $totalAttendancePerMonth = Attendance::whereMonth('created_at', '=', date('m'))->count();

     //   $attendanceGraphData = Attendance::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
      //      ->groupBy('date')
     //       ->get();

        $totalGivingPerMonth = // Retrieve the total giving per month from your database

        $totalDisbursementPerMonth = // Retrieve the total disbursement per month from your database

        $totalBalancePerMonth = // Retrieve the total balance per month from your database

        $disID = DisbursementRequest::count('id');
        $allowance = WeeklyAllowance::sum('allowance');
        $disTotal = Disbursement::sum('unit_price');
        $AllDIs = ($allowance * $disID )+  $disTotal ;

        $attendances = Attendance::join('events', 'events.id', '=', 'attendance.event_id')
            ->join('members', 'members.id', '=', 'attendance.member_id')
            ->groupBy('events.title', 'attendance.present')
            ->get(['events.title', Attendance::raw('GROUP_CONCAT(CONCAT(members.member_name, " - ", IF(attendance.present = 0, "absent", "present")) SEPARATOR "\n") as member_info')]);

        $inventory = Inventory::latest()->paginate(10);
        $donation = Donation::where('donation_type', 'Non-monetary')
            ->latest()
            ->paginate(10);

        $events = Event::latest()->paginate(10);

        $totalGiving = Giver::sum('total');


        return view('dashboard', compact(
            'maleWorkersCount',
            'totalWCount',
            'totalGiving',
            'femaleWorkersCount',
            'totalWorkersCount',
          //  'maleAttendeesCount',
          //  'femaleAttendeesCount',
         //   'totalAttendeesCount',
            'totalItemsCount',
            'totalEventsCount',
      //      'totalAttendancePerMonth',
        //    'attendanceGraphData',
        //    'totalGivingPerMonth',
            'totalDisbursementPerMonth',
            'totalBalancePerMonth',
            'AllDIs',
            'attendances',
            'inventory',
            'donation',
            'events',

        ));
    }
}
