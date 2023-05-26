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
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->title }}</td>
                        <td>
                            {!! nl2br(e($attendance->member_info)) !!}
                        </td>
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