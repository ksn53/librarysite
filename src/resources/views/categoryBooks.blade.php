@extends('layout.layout')
@section('title', 'MainPage')
@section('content')
    @foreach ($books as $book)
        @include('content.briefbook', ['book' => $book])
    @endforeach
@endsection
@section('paginator')

@endsection
