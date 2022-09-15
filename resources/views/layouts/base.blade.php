<!doctype html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/styles/bootstrap.min.css">
  <link rel="stylesheet" href="/fonts/rubik.css">
  <link rel="stylesheet" href="/styles/main.css">
  <title>@hasSection('title') @yield('title') - @endif{{ config('app.name', 'Laravel') }}</title>
</head>
<body class="d-flex flex-column h-100">

<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      jinimin.store
    </a>

    <div class="col-md-3 text-end">
      <!-- Authentication Links -->
      @guest
        <a href="{{ route('auth.login') }}" class="btn btn-outline-primary me-2">Login</a>
      @endguest
      @auth
        <a href="{{ route('home.index') }}" class="btn btn-outline-primary me-2">{{ Auth::user()->getName() }}</a>
        <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
        <form id="logout-form" action="{{ route('auth.signout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @endauth
    </div>
  </header>
</div>

<!-- Begin page content -->
<main class="flex-shrink-0 mb-5">
  <div class="container">
    @hasSection('title')
      <h1 class="mt-4">@yield('title')</h1>
    @endif

    {{--<br>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Index</a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
      </ol>
    </nav>
    <br>--}}

    @yield('content')
  </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    © 2022 {{ config('app.name', 'Laravel') }}

    @auth
      @if(Auth::user()->isAdmin())
      &ndash; <a href="{{ route('manage.stoke') }}">[ manage ]</a>
      @endif
    @endauth

    @env('local')
    <span class="float-end text-muted">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
    @endenv
  </div>
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app2.js') }}" defer></script>
<script src="https://unpkg.com/imask"></script>
</body>
</html>