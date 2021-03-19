@extends('layouts.app')
   
@section('content')
    <div class="row my-3">
        <div class="col-lg-12">
                <a class="btn btn-light btn-sm" href="{{ route('categories.index') }}">BACK</a>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <p><strong>Whoops!</strong> There were some problems with your input.</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-light btn-sm">SAVE</button>
            </div>
        </div>
   
    </form>
@endsection