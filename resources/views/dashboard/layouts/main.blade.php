<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Laravel Baron | Dashboard</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>
  <body>

    @include('dashboard.layouts.header')

<div class="container-fluid">
  <div class="row">
    @include('dashboard.layouts.sidebar')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('container')
    </main>
  </div>
</div>


    <script src="/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script> --}}
    <script src="/js/dashboard.js"></script>
  </body>
</html>
