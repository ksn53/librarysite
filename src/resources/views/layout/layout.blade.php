@include('layout.header')
  <div class="nav-scroller py-1 mb-2">
    @include('layout.nav')
  </div>

<main role="main" class="container">
    <div class="row m-1">

    </div>
    @include('layout.flash_message')
    <div class="row">

    <div class="col-md-8 blog-main">

        @yield('content')
        @yield('paginator')

    </div>
    @section('sidebar')
        @include('layout.sidebar')
    @show
  </div>
@include('layout.popupMessage')
</main>
    @include('layout.footer')
    <script src="{{ mix("/js/app.js") }}"></script>
</body>
</html>
