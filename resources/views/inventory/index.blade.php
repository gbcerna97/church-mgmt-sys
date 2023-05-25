@extends('inventory.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Inventory Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('inventory.create') }}"> Add New Purchased Item</a>
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
            <th>Product</th>
            <th>Category</th>
            <th>Date Purchased</th>
            <th>Total Cost</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($inventory as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->inventName }}</td>
            <td>{{ $product->category }}</td>
            <td>{{ $product->date_purchased }}</td>
            <td>PHP {{$product->total_cost}}</td>
            <td>
                <form action="{{ route('inventory.destroy',$product->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('inventory.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('inventory.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $inventory->links() !!}
      
@endsection