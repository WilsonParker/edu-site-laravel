<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('web.layouts.includes.meta')

    <title>{{ config('constants.web.title', 'Laravel') }}</title>

    @include('web.layouts.includes.styles')
    @include('web.layouts.includes.scripts')
</head>
<body>
<div id="app">
    @include('web.layouts.includes.top')
    @yield('content')
    @include('web.layouts.includes.footer')

    {{--<iframe name="ifr" src="" width="0" height=0 frameborder="0"></iframe>--}}
</div>
@include('web.layouts.includes.body_scripts')
@include('web.layouts.includes.modal')
@include('web.layouts.includes.confirm_modal')
</body>
</html>
