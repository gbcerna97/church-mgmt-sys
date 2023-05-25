@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Attendance Management') }}</h2>
            </div>
            <div class="card-body pt-4 p-3">
              <div>
              <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <button class='btn btn-success'><a href="{{ route('attendance.view') }}">View Attendance</a></button>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p class='text-light font-weight-bold'>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Events</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="event_name">Select Event:</label>
                            <select name="event_id" id="event_id" class="form-control">
                                @foreach($events as $event)
                                    @if($event->done == 0)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Present</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>
                                            {{ $member->member_name }}
                                            <input type="hidden" name="members[]" value="{{ $member->id }}">
                                            <input type="hidden" name="member_names[]" value="{{ $member->member_name }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" name="present[]" value="{{ $member->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Save Attendance</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
              </div>        
            </div>
        </div>
    </div>
</div>
@endsection
@push('dashboard')

@endpush
