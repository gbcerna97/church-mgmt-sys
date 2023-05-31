@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Monthly Report') }}</h2>
                <p>for month of {{ $month }}</p>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('accounting.report') }}"> Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Names</th>
                            <th>Date</th>
                            <th>Tithes</th>
                            <th>Offering</th>
                            <th>Others</th>
                            <th>Total</th>
                        </tr>
                        @foreach ($funds as $fund)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>JLYCC - Butuan City</td>
                            <td>{{ date('F d, Y', strtotime($fund->date)) }}</td>
                            <td>{{ $fund->tithe }}</td>
                            <td>{{ $fund->offering }}</td>
                            <td>{{ $fund->others }}</td>
                            <td>{{ $fund->fund }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection
@push('dashboard')

@endpush
