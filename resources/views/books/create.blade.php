@extends('layouts.app')
  
@section('content')
<div class="row my-3">
    <div class="col-lg-12">
            <a class="btn btn-light btn-sm" href="{{ route('books.index') }}">BACK</a>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        </p><strong>Whoops!</strong> There were some problems with your input.</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Author:</strong>
                <textarea class="form-control" style="height:150px" name="author" placeholder="Author"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                        <label>Select Category</label>
                        <select class="form-control" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <label>Cover</label>
                    <input type="file" name="cover">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                    <label>PDF</label>
                    <input type="file" name="pdf">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-light btn-sm">SAVE</button>
        </div>
    </div>
   
</form>
@endsection