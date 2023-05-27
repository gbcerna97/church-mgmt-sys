@extends('layouts.user_type.auth')
   
@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Edit Disbursement Request Information') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-primary" href="{{ route('request.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div>
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
                
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Request date:</strong>
                                    <input type="date" name="request_date" class="form-control" value="{{ $disbursementRequest->request_date }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Prepared by:</strong>
                                    <input type="text" name="prepared_by" class="form-control" placeholder="Prepared by" value="{{ $disbursementRequest->prepared_by }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Verified by:</strong>
                                    <input type="text" name="released_by" class="form-control" placeholder="Verified by" value="{{ $disbursementRequest->verified_by }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Released by:</strong>
                                    <input type="text" name="released_by" class="form-control" placeholder="Released by" value="{{ $disbursementRequest->released_by }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Approved by:</strong>
                                    <input type="text" name="approved_by" class="form-control" placeholder="Approved by" value="{{ $disbursementRequest->approved_by }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <strong>Approved date:</strong>
                                    <input type="date" name="date" class="form-control" value="{{ $disbursementRequest->approved_date }}">
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
@push('edit')

@endpush
