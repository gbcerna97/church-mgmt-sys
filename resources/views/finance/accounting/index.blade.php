@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Giver Management') }}</h2>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('giver.create') }}"> Add Giver Record</a>
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
                            <td>{{ $giver->date }}</td>
                            <td>Php {{ $giver->sum }}</td>
                            <td>
                                <form action="{{ route('giver.destroy',$giver->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('giver.show',$giver->id) }}">Show</a>
                    
                                    <a class="btn btn-primary" href="{{ route('giver.edit',$giver->id) }}">Edit</a>
                
                                    @csrf
                                    @method('DELETE')
                    
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                
                    {!! $givers->links() !!}
                </div>        
            </div>
        </div>
    </div>
</div>

@endsection
@push('index')

@endpush
