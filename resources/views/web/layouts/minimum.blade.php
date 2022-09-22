<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('web.layouts.includes.meta')

    <title>{{ config('constants.web.title', 'Laravel') }}</title>

    @include('web.layouts.includes.styles')
    @stack('head_scripts')
</head>
<body>
<div id="app">
    @include('web.layouts.includes.top')
    @yield('content')
    @include('web.layouts.includes.footer')
</div>
</body>
</html>
