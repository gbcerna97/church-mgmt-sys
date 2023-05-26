@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-body pt-4 p-3">
              <div>
              <div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="m-4">
                <a class="btn btn-primary" href="{{ route('inventory.index') }}"> Back</a>
            </div>
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Show Product') }}</h2>
            </div>
            <div class="card-body pt-4 p-3">
              <div>
              <div class="row">
        <div class="col-lg-12 margin-tb">
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product Name:</strong>
                {{ $inventory->inventName }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Ministry Name:</strong>
                {{ $inventory->ministryName }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                {{ $inventory->category }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Purchase Date:</strong>
                {{ $inventory->date_purchased }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Number of Units:</strong>
                {{ $inventory->item_num }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Unit Cost:</strong>
                PHP {{ $inventory->unit_cost }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Grand Total:</strong>
                {{ $inventory->total_cost }}
            </div>
        </div>
    </div>
              </div>        
            </div>
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
