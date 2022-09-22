@extends('web.layouts.app')

@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/">
                    <x-image src="images/common/icon_home.png" alt="홈으로"/>
                </a></li>
            <li><span>내강의실</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>{{ $menuTitle }}</span>@include('web.layouts.includes.sub_menu_page_members')</li>
        </ul>
    </div>
    <div class="sub_banner">
        @yield('top_banner')
        <h3>내강의실</h3>
        <ul class="sub_tab">
            <li class="{{ $page == 1 ? 'on' : '' }}"><a href="{{ route('members.lectures.learning') }}">학습중인 수업</a></li>
            <li class="{{ $page == 2 ? 'on' : '' }}"><a href="{{ route('members.lectures.ended') }}">학습종료된 수업</a></li>
            <li class="{{ $page == 3 ? 'on' : '' }}"><a href="{{ route('members.carts.index') }}">장바구니</a></li>
            <li class="{{ $page == 4 ? 'on' : '' }}"><a href="{{ route('members.payments') }}">주문/결제내역</a>
            </li>
        </ul>
        <h4>{{ $menuTitle }}</h4>
        @yield('bottom_banner')
    </div>

    <div class="sub_content">
        @yield('sub_content')
    </div>
@endsection
@push('body_scripts')
    <script>
        $(function () {
            $('#all_chk').on('click', function () {
                if ($(this).is(':checked')) {
                    $('input.agree').prop('checked', true);
                } else {
                    $('input[name=join]').prop('checked', false);
                }
            });
        })
    </script>
@endpush

