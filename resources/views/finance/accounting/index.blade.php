@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Account Classification Management') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-success" href="" data-bs-toggle="tooltip" data-bs-placement="top" title="View General Balance">View Balance</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($dates as $date)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ date('F d, Y', strtotime($date)) }}</td>
                            <td>
                                @if (isset($funds[$date]))
                                    Php {{ $funds[$date]->fund }}
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('accounting.show', $date) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                
                </div>        
            </div>
        </div>
    </div>
</div>

@endsection
@push('index')

@endpush
