@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Giver Record Information') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('giver.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Giver name:</strong>
                                <input type="text" class="form-control" value="{{ $giver->giver_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Date:</strong>
                                <input type="text" class="form-control" value="{{ date('F d, Y', strtotime($giver->date)) }}" readonly>
                            </div>
                        </div>
                        @if ($giver->tithe)
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Tithe:</strong>
                                <input type="text" class="form-control" value="Php {{ $giver->tithe }}" readonly>
                            </div>
                        </div>
                        @endif
                        @if ($giver->offering)
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Offering:</strong>
                                <input type="text" class="form-control" value="Php {{ $giver->offering }}" readonly>
                            </div>
                        </div>
                        @endif
                        @if ($giver->mission)
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Mission:</strong>
                                <input type="text" class="form-control" value="Php {{ $giver->mission }}" readonly>
                            </div>
                        </div>
                        @endif
                        @if ($giver->sanctuary)
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Sanctuary:</strong>
                                <input type="text" class="form-control" value="Php {{ $giver->sanctuary }}" readonly>
                            </div>
                        </div>
                        @endif
                        @if ($giver->love_gift)
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Love Gift:</strong>
                                <input type="text" class="form-control" value="Php {{ $giver->love_gift }}" readonly>
                            </div>
                        </div>
                        @endif
                        @if ($giver->dance_ministry)
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Dance Ministry:</strong>
                                <input type="text" class="form-control" value="Php {{ $giver->dance_ministry }}" readonly>
                            </div>
                        </div>  
                        @endif                      
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection
@push('dashboard')

@endpush
