@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Giver Management') }}</h2>
                <div class="pull-left">
                    <a class="btn btn-success" href="{{ route('giver.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Giver Record">Add New</a>
                    <a class="btn btn-info" href="{{ route('cashcount.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Cash Count For Specific Date">Add Cash Count</a>
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
                            <th>Giver Name</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($givers as $giver)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $giver->giver_name }}</td>
                            <td>{{ date('F d, Y', strtotime($giver->date)) }}</td>
                            <td>Php {{ $giver->total }}</td>
                            <td>
                                <form action="{{ route('giver.destroy', $giver->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('giver.show',$giver->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fa fa-eye"></i></a>
                    
                                    <a class="btn btn-primary" href="{{ route('giver.edit',$giver->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                
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
