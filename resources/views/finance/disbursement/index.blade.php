@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Disbursement Management') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('disbursement.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Disbursement Record">Add New</a>
                    <a class="btn btn-info" href="{{ route('request.index') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View All Disbursement">View Disbursement Requests</a>
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
                            <th>Account Name</th>
                            <th>Particulars</th>
                            <th>Unit Price</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($disbursements as $disbursement)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $disbursement->account_name }}</td>
                            <td>{{ $disbursement->particulars }}</td>
                            <td>Php {{ $disbursement->unit_price }}</td>
                            <td>
                                <form action="{{ route('disbursement.destroy', $disbursement->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('disbursement.show',$disbursement->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa fa-eye"></i></a>
                    
                                    <a class="btn btn-primary" href="{{ route('disbursement.edit',$disbursement->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                
                                    @csrf
                                    @method('DELETE')
                    
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
                                </form>
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
