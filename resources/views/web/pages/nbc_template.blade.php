@extends('web.layouts.app')
@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>내일배움카드</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>내일배움카드제도 안내</span>@include('web.layouts.includes.sub_menu_page_nbc')</li>
        </ul>
    </div>
    <div class="sub_banner">
        <h3>국민내일배움카드</h3>
        <ul class="sub_tab">
            <li class="{{ $page == 1 ? 'on' : ''}}"><a href="{{ route('pages.nbc.1') }}">제도소개</a></li>
            <li class="{{ $page == 2 ? 'on' : ''}}"><a href="{{ route('pages.nbc.2') }}">지원대상</a></li>
            <li class="{{ $page == 3 ? 'on' : ''}}"><a href="{{ route('pages.nbc.3') }}">지원절차</a></li>
            <li class="{{ $page == 4 ? 'on' : ''}}"><a href="{{ route('pages.nbc.4') }}">지원내용</a></li>
        </ul>
        <h3>{{ $menuTitle }}</h3>
    </div>
    <div class="sub_content">
        @yield('sub_content')
    </div>
@endsection
