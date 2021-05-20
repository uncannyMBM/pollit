<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('page_title') | Poll iT</title>
    @include('layouts.styles')
</head>
<body>
@include('layouts.header')
<main role="main">
    @section('content')
    @show
</main>
@include('layouts.footer')
@include('layouts.scripts')
@yield('scripts')
</body>
</html>
