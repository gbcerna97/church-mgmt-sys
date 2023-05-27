@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Disbursement Request Management') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('request.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Disbursement Request">Add New</a>
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
                            <th>Request Date</th>
                            <th>Prepared By</th>
                            <th>Verified By</th>
                            <th>Released By</th>
                            <th>Approved By</th>
                            <th>Approved Date</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($disbursementRequests as $key => $disbursementRequest)
                        <tr>
                            <td>{{ $disbursementRequests->firstItem() + $key }}</td>
                            <td>
                                @if ($disbursementRequest->request_date)
                                    {{ date('F d, Y', strtotime($disbursementRequest->request_date)) }}</td>
                                @endif
                            </td>
                            <td>{{ $disbursementRequest->prepared_by }}</td>
                            <td>@if ($disbursementRequest->verified_by) Php {{ $disbursementRequest->verified_by }} @endif</td>
                            <td>@if ($disbursementRequest->released_by) Php {{ $disbursementRequest->released_by }} @endif</td>
                            <td>@if ($disbursementRequest->approved_by) Php {{ $disbursementRequest->approved_by }} @endif</td>
                            <td>
                                @if ($disbursementRequest->approved_date)
                                    {{ date('F d, Y', strtotime($disbursementRequest->approved_date)) }}</td>
                                @endif
                            <td>
                                <form action="{{ route('request.destroy', $disbursementRequest->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('request.show', $disbursementRequest->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary" href="{{ route('request.edit', $disbursementRequest->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $disbursementRequests->links() }}
                </div>        
            </div>
        </div>
    </div>
</div>
@endsection
@push('index')

@endpush
