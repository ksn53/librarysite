@extends('layout.layout')
@section('title', 'Add book')
@section('content')
    @include('layout.validationError')
    <form id="editDataForm" method="post" action="{{ route('books.store') }}" class="mb-3"
          enctype="multipart/form-data">
        @csrf
        @include('bookForm', ['book' => new App\Models\Book()])
        <button type="submit" class="btn btn-primary" id="editButton">Submit</button>
    </form>
@endsection
