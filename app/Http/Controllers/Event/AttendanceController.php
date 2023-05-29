<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Event;
use App\Models\Member;


class AttendanceController extends Controller
{
    public function index()
    {
        $events=Event::all();
        $members=Member::all();

        return view('attendance.index', compact('events', 'members'));
    }

    public function store(Request $request)
{

    $request->validate([
        'event_id' => 'required',
        
    ]);
    
    $event_id = $request->input('event_id');
    $members = $request->input('member_id', []);
    $presentStatus = $request->input('present', []);

    // Retrieve the event object
    $event = Event::find($event_id);

    // Check if the event exists
    if ($event) {
        // Update the 'done' property of the event
        $event->done = 1;
        $event->save();

        // Save attendance for each member
        foreach ($members as $index => $memberId) {
            $present = isset($presentStatus[$index]);

            $attendanceData = [
                'event_id' => $event_id,
                'member_id' => $memberId,
                'present' => $present,
            ];

            Attendance::create($attendanceData);
        }

        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }

    return redirect()->back()->with('error', 'Event not found.');
}



    public function viewAttendance()
    {
        $attendances = Attendance::join('events', 'events.id', '=', 'attendance.event_id')
            ->join('members', 'members.id', '=', 'attendance.member_id')
            ->orderBy('attendance.id', 'desc') // Order by the creation date in descending order
            ->groupBy('events.title', 'attendance.present')
            ->get(['events.title', Attendance::raw('GROUP_CONCAT(CONCAT(members.member_name, " - ", IF(attendance.present = 0, "absent", "present")) SEPARATOR "\n") as member_info')]);


        return view('attendance.view', compact('attendances'));
    }

}