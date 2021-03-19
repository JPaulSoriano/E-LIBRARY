@extends('layouts.app')
 
@section('content')

<h3>ADMIN SIDE</h3>
    <div class="row my-3">
        <div class="col-lg-12">
                <a class="btn btn-light btn-sm" href="{{ route('books.create') }}">ADD</a>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr class="thead-light">
            <th>No</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>PDF</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->category->name }}</td>
            <td><a class="btn btn-light btn-sm" href="{{asset('storage/'.$book->pdf_path)}}" target="_blank">View</a></td>
            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
   
                    <a class="btn btn-light btn-sm" href="{{ route('books.show',$book->id) }}">Show</a>
    
                    <a class="btn btn-light btn-sm" href="{{ route('books.edit',$book->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-light btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


<hr class="my-5">

<h3>USER SIDE</h3>
    <div class="row my-3">
        <div class="col-sm-2">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown">
                    Categories
                </button>
            
                <div class="dropdown-menu">
                    @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('categorize.books', $category) }}">{{ $category->name}}</a>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-sm-2"><a class="btn btn-danger" type="button" href="{{ route('books.index') }}">Show All</a></div>
        <div class="col-sm-8">
            <form action="{{ route('books.index') }}" method="GET" role="search">
            <div class="row">
                <div class="col-sm-4"><input type="text" class="form-control" name="term" placeholder="Search"></div>
                <div class="col-sm-2"><button class="btn btn-info" type="submit">Search</button></div>
            </div>
            </form>
        </div>
    </div>

        
            
       
                   


    
    <div class="row my-3">
    @foreach ($books as $book)
        <div class="col-sm-3 my-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="{{asset('storage/'.$book->cover_path)}}">
                <div class="card-body">
                    <p class="card-title font-weight-bold">{{ $book->title }}</p>
                    <p class="card-text">{{ $book->author }}</p>
                    <p class="card-text">{{ $book->category->name }}</p>
                </div>
                <div class="card-footer text-muted">
                    <a class="btn btn-primary btn-sm" href="{{asset('storage/'.$book->pdf_path)}}" target="_blank">Read</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>


    {!! $books->links() !!}
      
@endsection