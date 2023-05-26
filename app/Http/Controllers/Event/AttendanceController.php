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
        $attendance = Attendance::with('events', 'member')->get();

        return view('attendance.index', compact('attendance'));
    }

    public function store(Request $request)
    {
        $event_id = $request->input('event_id');
        $members = $request->input('members', []);
        $memberNames = $request->input('member_names', []);
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
                $memberName = $memberNames[$index];
                $present = isset($presentStatus[$index]);

                $attendanceData = [
                    'event_id' => $event_id,
                    'member_name' => $memberName,
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
        $attendance = Attendance::all();
        $eventIds = $attendance->pluck('event_id')->unique();
        $events = Event::whereIn('id', $eventIds)->get();

        // Fetch member names and attendance status for each event
        foreach ($events as $event) {
            $eventAttendance = $attendance->where('event_id', $event->id);
            $event->attendances = $eventAttendance->map(function ($attendance) {
                return [
                    'member_name' => $attendance->member_name,
                    'status' => $attendance->present ? 'Present' : 'Absent',
                ];
            });
        }

        return view('attendance.view', compact('events'));
    }

}