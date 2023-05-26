@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Events Management') }}</h2>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('events.create') }}"> Add New Events Item</a>
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
                            <th>Title</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->date }}</td>
                            <td>{{ $event->venue }}</td>
                            <td>
                                <form action="{{ route('events.destroy',$event->id) }}" method="POST">
                
                                    <a class="btn btn-info" href="{{ route('events.show',$event->id) }}">Show</a>
                    
                                    <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>
                
                                    @csrf
                                    @method('DELETE')
                    
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                
                    {!! $events->links() !!}
                </div>        
            </div>
        </div>
    </div>
</div>

@endsection
@push('dashboard')

@endpush
