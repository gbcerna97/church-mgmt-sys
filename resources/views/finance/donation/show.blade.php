@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Donation Information') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('donation.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Donor Name:</strong>
                                {{ $donation->donor_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Date:</strong>
                                {{ $donation->date }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Donation type:</strong>
                                {{ $donation->donation_type }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Donation name:</strong>
                                {{ $donation->donation_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Amount:</strong>
                                @if ($donation->amount)
                                    Php {{ $donation->amount }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection
@push('finance.donation.show')

@endpush
