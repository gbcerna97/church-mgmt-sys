@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Welcome back') }} {{ $user->name }}</h2>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Upcoming events</h6>
                                    @foreach($events as $event)
                                        @if(!$event->done)
                                            <div class="d-flex align-items-center mb-3">
                                                <div>
                                                    <p class="mb-0">{{ $event->title }}</p>
                                                    <small class="mb-0">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}, {{ $event->venue  }}</small>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4" style="min-height:100">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Overall Fund</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <p class="mb-0">Php {{ $church_info->overall_funds }}</p>
                                        </div>
                                    </div>
                                    <h6 class="card-title">Donation Fund</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <p class="mb-0">Php {{ $church_info->givers_funds }}</p>
                                        </div>
                                    </div>
                                    <h6 class="card-title">Givers Fund</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <p class="mb-0">Php {{ $church_info->donations_funds }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Retrieve the fund data
        var fundData = [];
        @foreach($givers_fund as $fund)
            fundData.push({{ $fund->amount }});
        @endforeach

        // Create the line chart
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [], // Add labels if needed
                datasets: [{
                    label: 'Fund Data',
                    data: fundData,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            }
        });
    });
</script>
@endpush
