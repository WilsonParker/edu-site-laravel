@extends('web.layouts.app')
@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>기업교육</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>사업주훈련제도 안내</span>@include('web.layouts.includes.sub_menu_page_business')</li>
        </ul>
    </div><!-- class="sub_navi" -->
    <div class="sub_banner">
        <h3>국비지원환급과정</h3>
        <ul class="sub_tab">
            <li class="{{ $page == 1 ? 'on' : ''}}"><a href="{{ route('pages.business.1') }}">지원대상</a></li>
            <li class="{{ $page == 2 ? 'on' : ''}}"><a href="{{ route('pages.business.2') }}">지원절차</a></li>
            <li class="{{ $page == 3 ? 'on' : ''}}"><a href="{{ route('pages.business.3') }}">지원내용</a></li>
            <li class="{{ $page == 4 ? 'on' : ''}}"><a href="{{ route('pages.business.4') }}">제도소개</a></li>
        </ul>
        <h3>{{ $menuTitle }}</h3>
    </div>
    <div class="sub_content">
        @yield('sub_content')
    </div>
@endsection
