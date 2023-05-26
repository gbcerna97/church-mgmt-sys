@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Attendance View') }}</h2>
            </div>
            <div class="card-body pt-4 p-3">
              <div>
              <div class="row">
      
        <div class="pull-right">
                <button class='btn bg-gradient-info text-white'><a href="{{ route('attendance.index') }}">Back</a></button>
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
                @foreach($events_id as $attendance)
                    <tr>
                        <td>{{ $attendance->event_id }}</td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
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