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
                                <strong>Giver Name:</strong>
                                {{ $giver->giver_name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Date:</strong>
                                {{ date('F d, Y', strtotime($giver->date)) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Tithe:</strong>
                                @if ($giver->tithe)
                                    Php{{ $giver->tithe }}
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Offering:</strong>
                                @if ($giver->offering)
                                    Php{{ $giver->offering }}
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Mission:</strong>
                                @if ($giver->mission)
                                    Php{{ $giver->mission }}
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Sanctuary:</strong>
                                @if ($giver->sanctuary)
                                    Php{{ $giver->sanctuary }}
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Love Gift:</strong>
                                @if ($giver->love_gift)
                                    Php{{ $giver->love_gift }}
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                            <div class="form-group">
                                <strong>Dance Ministry:</strong>
                                @if ($giver->dance_ministry)
                                    Php{{ $giver->dance_ministry }}
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
