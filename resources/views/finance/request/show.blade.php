@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Disbursement Request Information') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('request.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Request ID:</strong>
                                <input type="text" class="form-control" value="@if ($disbursementRequest->request_date){{ date('F d, Y', strtotime($disbursementRequest->request_date))}}@endif" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Account name:</strong>
                                <input type="text" class="form-control" value="{{ $disbursementRequest->prepared_by }}" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Particulars:</strong>
                                <input type="text" class="form-control" value="{{ $disbursementRequest->verified_by }}" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Approved date:</strong>
                                
                                <input type="text" class="form-control" value="@if ($disbursementRequest->approved_date){{ date('F d, Y', strtotime($disbursementRequest->approved_date))}}@endif" readonly>
                            </div>
                        </div> 
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Unit price:</strong>
                                <input type="text" class="form-control" value="{{ $disbursementRequest->approved_by }}" readonly>
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
