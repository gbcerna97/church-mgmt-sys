@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h2 class="mb-0">{{ __('Membership Management') }}</h2>
            </div>
            <div class="card-body pt-4 p-3">
              <div>
              <div class="row">
        <div class="col-lg-12 margin-tb">
            
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('members.create') }}"> Add New Member</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Address</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $member->member_name }}({{$member->nickname}})</td>
            <td>{{$member->sex}}</td>
            <td>{{ $member->address }}</td>
            <td>
                <form action="{{ route('members.destroy',$member->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('members.show',$member->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('members.edit',$member->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $members->links() !!}
              </div>        
            </div>
        </div>
    </div>
</div>
@endsection
@push('dashboard')

@endpush
