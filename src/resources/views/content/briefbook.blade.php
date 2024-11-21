<div class="card mb-3" style="max-width: 100%;">
    <div class="row no-gutters">
        <div class="col-md-4">
            @if (isset($book->image))
                <img src="{{ $book->image }}" class="card-img img-thumbnail">
            @else
                <div class="d-flex justify-content-center align-items-center">
                    No image
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text">Description: {{ $book->content}}</p>
                <p class="card-text"><small class="text-muted">Year: {{ $book->year }}</small></p>
            </div>
        </div>
    </div>
</div>
