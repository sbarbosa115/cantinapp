<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Cantinapp - The new way to get your Cantina!!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset("dist/restaurant/css/app.css") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

@yield('content')

<script src="{{ asset("dist/restaurant/js/app.js") }}"></script>

@yield('javascript')
</body>
</html>
