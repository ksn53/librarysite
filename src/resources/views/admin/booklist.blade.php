@extends('admin.admin')
@section('content')
    @section('maintitle', 'List of books')
    <table class="table table-striped">
      <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Added to base</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td><a href="{{ route('books.edit', ['book' => $book->id]) }}">{{ $book->title }}</a></td>
            <td>{{ $book->created_at }}</td>
            <td>
                <form id="deleteDataForm" method="post" action="{{ route("books.destroy", ['book' => $book->id]) }}">
                    @csrf
                    @method("DELETE")
                    <input type="hidden" name="adminmode" value="1">
                    <button type="submit" class="btn btn-link" id="deleteButton">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
@endsection
@section('paginator')
    {{ $books->links() }}
@endsection
