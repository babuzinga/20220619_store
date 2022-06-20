<!doctype html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/styles/bootstrap.min.css">
  <link rel="stylesheet" href="/styles/main.css">
  <title>@yield('title') :: Store</title>
</head>
<body class="d-flex flex-column h-100">

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">@yield('title')</h1>

    <br>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Index</a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
      </ol>
    </nav>
    <br>

    @yield('main')
  </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <a href="https://getbootstrap.com/docs/5.2/examples/" target="_blank">Examples · Bootstrap v5.2</a>
    @env('local')
    <span class="float-end text-muted">Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
    @endenv
  </div>
</footer>

<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>