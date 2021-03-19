@extends('layouts.app')
 
@section('content')
    <div class="row my-3">
        <div class="col-lg-12">
                <a class="btn btn-light btn-sm" href="{{ route('categories.create') }}">ADD</a>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
   
                    <a class="btn btn-light btn-sm" href="{{ route('categories.show',$category->id) }}">Show</a>
    
                    <a class="btn btn-light btn-sm" href="{{ route('categories.edit',$category->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-light btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $categories->links() !!}
      
@endsection