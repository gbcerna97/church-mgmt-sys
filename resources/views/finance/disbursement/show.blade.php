@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Disbursement Record Information') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('disbursement.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Request ID:</strong>
                                <input type="text" class="form-control" value="{{ $disbursement->request_id }}" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Account name:</strong>
                                <input type="text" class="form-control" value="{{ $disbursement->released_to}}" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Particulars:</strong>
                                <input type="text" class="form-control" value="{{ $disbursement->particulars }}" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Unit price:</strong>
                                @if ($disbursement->unit_price)
                                    <input type="text" class="form-control" value="Php {{ $disbursement->unit_price }}" readonly>
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
@push('dashboard')

@endpush
