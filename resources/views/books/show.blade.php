@extends('layouts.app')
@section('content')
    <div class="row my-3">
        <div class="col-lg-12">
                <a class="btn btn-light btn-sm" href="{{ route('books.index') }}">BACK</a>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $book->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Author:</strong>
                {{ $book->author }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                {{ $book->category->name }}
            </div>
        </div>
    </div>
@endsection