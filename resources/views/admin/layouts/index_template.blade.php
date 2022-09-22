@extends('admin.layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    @hasSection('title')
        @yield('title')
    @else
        <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">
                {!! $title ?? '' !!}
            </h1>
        @endif

        @hasSection('description')
            @yield('description')
        @else
            <samp class="mb-4">
                {!! $description ?? '' !!}
            </samp>
        @endif
        <br/>
        <br/>

        @yield('sub_content')
    </div>
@endsection

@push('body_scripts')
@endpush
