@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid p-4">
  <div class="card shadow">
    <div class="card-body">
      <h1 class="mb-4">Welcome back, {{ $user->name }}</h1>
      
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Upcoming events</h6>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Events count:</h4>
                <h4 class="text-primary">{{ $events_counter }}</h4>
              </div>
              @foreach($events as $event)
                @if(!$event->done)
                  <div class="d-flex align-items-center mb-3">
                    <svg class="bi me-3" width="24" height="24" fill="currentColor">
                      <use xlink:href="bootstrap-icons.svg#calendar3"/>
                    </svg>
                    <div>
                      <h5 class="mb-0">{{ $event->title }}</h5>
                      <h6 class="mb-0">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</h6>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <svg class="bi mb-3" width="60" height="60" fill="currentColor">
                <use xlink:href="bootstrap-icons.svg#people-fill"/>
              </svg>
              <h1 class="mb-0">{{ $attendees_counter }}</h1>
              <h4 class="mb-3">Attendees</h4>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h2>Monthly Funds: </h2>
              <h4>₱ {{ $monthly_fund }}</h4>
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
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@endpush
