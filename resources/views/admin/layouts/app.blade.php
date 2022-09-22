<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('admin.layouts.includes.meta')

    <title>{{ config('app.admin.name', 'Laravel') }}</title>

    @include('admin.layouts.includes.scripts')

    @include('admin.layouts.includes.styles')
</head>
{{--<body oncontextmenu="return false;">--}}
<body id="page-top">
<div id="app">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.layouts.includes.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('admin.layouts.includes.topbar')
                @yield('content')
                @include('admin.layouts.includes.footer')
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

{{--@include('admin.layouts.includes.logout_modal')--}}

@hasSection('modal')
    @yield('modal')
@else
    @include('layouts.components.modals.modal_template')
@endif
@include('layouts.components.modals.basic_modal')

@unless(empty($components))
    @foreach($components as $component)
        @include('layouts.components.'.$component)
    @endforeach
@endunless

@include('admin.layouts.includes.body_scripts')

@include('admin.layouts.includes.loading')
</body>
</html>
