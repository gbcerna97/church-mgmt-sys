@extends('attendance.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Attendance View</h2>
        </div>
        <div class="pull-right">
                <a href="{{ route('attendance.index') }}">Back</a>
            </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Member Names</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>
                            @foreach($event->attendances as $attendance)
                                {{ $attendance['member_name'] }} - {{ $attendance['status'] }}<br>
                            @endforeach

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
