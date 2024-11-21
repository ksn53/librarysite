<aside class="col-md-4 blog-sidebar">
  <div class="p-4">
      @if (Auth::id())
          <h4 class="font-italic">Categorys</h4>
          @include('content.categorys', ['categorys' => $categorysCloud])
      @endif
  </div>
</aside>
