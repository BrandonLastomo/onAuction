<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    
    <title>{{ $title }}</title>
</head>
<body>

    @include('partials.navbar')

    <div style="margin-top: 90px">
        @yield('contents')
    </div>

<script type="text/javascript" src="/js/bootstrap.js"></script>

</body>
</html>