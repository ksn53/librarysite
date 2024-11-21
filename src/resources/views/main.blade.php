@extends('layout.layout')
@section('title', 'Main Page')
@section('content')
    @if (Auth::id())
        @if (isset($books) and $books->count() > 0)
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        @foreach ($books as $book)
                            @include('content.briefbook', ['post' => $book])
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <h2>Still where no books here. Please add it in user panel.</h2>
        @endif
    @else
        <h2>This is library system. Register new user or login.</h2>
    @endif
@endsection
@section('paginator')
    @if (isset($books))
        {{ $books->links() }}
    @endif
@endsection

