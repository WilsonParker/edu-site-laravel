@extends('web.layouts.app')

@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/"><x-image src="images/common/icon_home.png" alt="홈으로"/></a></li>
            <li><span>내강의실</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>정보수정</span>@include('web.layouts.includes.sub_menu_page_members')</li>
        </ul>
    </div>
    <div class="sub_banner">
        <h3>정보수정</h3>
        <ul class="sub_tab">
            <li class="{{ $page == 1 ? 'on' : '' }}"><a href="{{ route('members.edit.index') }}">나의정보</a></li>
            <li class="{{ $page == 2 ? 'on' : '' }}"><a href="{{ route('members.edit.password') }}">비밀번호변경</a></li>
            <li class="{{ $page == 3 ? 'on' : '' }}"><a href="{{ route('members.delete') }}">회원탈퇴</a></li>
        </ul>
        <h4>@yield('banner')</h4>
    </div>

    <div class="sub_content">
        <div class="sub_title mb20"><p class="tit02">@yield('sub_title')</p></div>
        @yield('sub_content')
    </div>
@endsection

@push('body_scripts')
@endpush
