<div class="form-group">
    <label for="titleInput">Title</label>
    <input name="title" type="text" class="form-control" id="titleInput" placeholder='enter book title' value="{{ old('title', $book->title) }}">
</div>
<div class="form-group">
    <label for="categoryInput">category</label>
    <input name="category" type="text" class="form-control" id="categoryInput" placeholder='enter category' value="{{ old('category', $book->category->name ?? '') }}">
</div>
<div class="form-group">
    <label for="categoryInput">year</label>
    <input name="year" type="text" class="form-control" id="yearInput" placeholder='enter year' value="{{ old('category', $book->year ?? '') }}">
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" id="image">
</div>


<div class="form-group">
    @if (old('content', $book->image))
        <img src="{{ old('content', $book->image) }}" class="card-img img-thumbnail w-25">
    @else
        <div class="d-flex justify-content-center align-items-center img-thumbnail w-25">
            No image
        </div>
    @endif
</div>
<div class="form-group">
    <label for="contentInput">Description</label>
    <textarea name="content" class="form-control" id="contentInput" placeholder='Description' rows="8">{{ old('content', $book->content) }}</textarea>
</div>
