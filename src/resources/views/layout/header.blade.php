<!doctype html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ mix("/css/bootstrap.min.css") }}">
        <link href="{{ mix("/css/app.css") }}" rel="stylesheet">
        <link href="{{ mix("/css/blog.css") }}" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <div class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
              <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/">@yield('title')</a>
              </div>
              <div class="col-4 d-flex justify-content-end align-items-center">
                    @guest
                        @if (Route::has('login'))
                                <a class="btn mr-2 btn-sm btn-outline-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a id="navbarDropdown" class="btn btn-sm btn-outline-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user())
                              <div class="class="dropdown-item"><a class="dropdown-item" href="{{ route('adminpanel') }}">Control panel</a></div>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    @endguest
              </div>
            </div>
        </div>
