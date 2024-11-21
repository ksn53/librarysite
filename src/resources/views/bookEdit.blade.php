@extends('layout.layout')
@section('title', 'Update book')
@section('content')
    @include('layout.validationError')
    <form id="editDataForm" method="post" action="{{ route("books.update", ['book' => $book->id]) }}" class="mb-3"
          enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        @include('bookForm', ['book' => $book])
        <button type="submit" class="btn btn-primary" id="editButton">Update</button>
    </form>
    <form id="deleteDataForm" method="post" action="{{ route("books.destroy", ['book' => $book->id]) }}" class="m-1">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-primary" id="deleteButton">Delete</button>
    </form>
@endsection
