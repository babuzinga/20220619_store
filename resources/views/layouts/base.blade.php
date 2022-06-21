<!doctype html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/styles/bootstrap.min.css">
  <link rel="stylesheet" href="/styles/main.css">
  <title>@yield('title') :: {{ config('app.name', 'Laravel') }}</title>
</head>
<body class="d-flex flex-column h-100">

<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      jinimin.store
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="{{ route('product.index') }}" class="nav-link px-2 link-secondary">Home</a></li>
      <li><a href="https://getbootstrap.com/docs/5.2/examples/" target="_blank" class="nav-link px-2 link-dark">Examples · Bootstrap v5.2</a></li>
      <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
    </ul>

    <div class="col-md-3 text-end">
      <!-- Authentication Links -->
      @guest
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Reg</a>
      @endguest
      @auth
        <a href="{{ route('home.index') }}" class="btn btn-outline-primary me-2">{{ Auth::user()->name }}</a>
        <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @endauth
    </div>
  </header>
</div>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">@yield('title')</h1>

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
    Hello (> <) !!!
    @env('local')
    <span class="float-end text-muted">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
    @endenv
  </div>
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>