@extends('web.layouts.app')

@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>멤버쉽</span></li>
            <li><span>회원가입</span>
                <ul>
                    <li><a href="{{ route('auth.index') }}">로그인</a></li>
                    <li><a href="{{ route('members.create') }}">회원가입</a></li>
                    <li><a href="#">아이디찾기</a></li>
                    <li><a href="#">비밀번호찾기</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- class="sub_navi" -->
    <div class="sub_banner">
        @yield('banner')
    </div><!-- class="sub_banner" -->

    <div class="sub_content">
        <ul class="sub_tab02">
            <li class="{{ $page == 1 ? 'on' : '' }}"><span>1. 약관동의</span></li>
            <li class="{{ $page == 2 ? 'on' : '' }}"><span>2. 본인인증</span></li>
            <li class="{{ $page == 3 ? 'on' : '' }}"><span>3. 정보입력</span></li>
            <li class="{{ $page == 4 ? 'on' : '' }}"><span>4. 가입완료</span></li>
        </ul>
        @yield('sub_content')
    </div><!-- class="sub_content" -->
@endsection

@push('body_scripts')
@endpush
