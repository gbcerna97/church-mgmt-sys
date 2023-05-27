@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Add Cash Count Record') }}</h2>
                <div class="pull-left mt-2">
                    <a class="btn btn-primary" href="{{ route('giver.index') }}"> Back</a>
                </div>
                
            </div>
            <div class="card-body pt-4 p-3">
                
                <small class="text-danger">Note: Please specifiy the count for each cash equivalent. If none, leave blank.</small>
                <div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form action="{{ route('cashcount.store') }}" method="POST">
                        @csrf
                    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Date:</strong>
                                    <select name="date" id="date" class="form-control">
                                        <option value="" disabled selected>Select date...</option>
                                        @foreach($dates as $date)
                                            <option value="{{ $date }}">{{ date('F d, Y', strtotime($date)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                                               
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 1,000:</strong>
                                    <input type="number" name="cc_1000" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 500:</strong>
                                    <input type="number" name="cc_500" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 200:</strong>
                                    <input type="number" name="cc_200" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 100:</strong>
                                    <input type="number" name="cc_100" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 50:</strong>
                                    <input type="number" name="cc_50" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 20:</strong>
                                    <input type="number" name="cc_20" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 10:</strong>
                                    <input type="number" name="cc_10" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 5:</strong>
                                    <input type="number" name="cc_5" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Php 1:</strong>
                                    <input type="number" name="cc_1" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>¢ 0.25:</strong>
                                    <input type="number" name="cc_0_25" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>¢ 0.10:</strong>
                                    <input type="number" name="cc_0_1" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>¢ 0.05:</strong>
                                    <input type="number" name="cc_0_05" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>¢ 0.01:</strong>
                                    <input type="number" name="cc_0_01" class="form-control" placeholder="0">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>

@endsection
@push('create')

@endpush
