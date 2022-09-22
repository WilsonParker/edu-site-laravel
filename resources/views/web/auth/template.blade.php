@extends('web.layouts.app')

@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>멤버쉽</span></li>
            <li><span>로그인</span>
                <ul>
                    <li><a href="{{ route('auth.login') }}">로그인</a></li>
                    <li><a href="{{ route('members.create') }}">회원가입</a></li>
                    <li><a href="/member/find_id.html">아이디찾기</a></li>
                    <li><a href="/member/find_pw.html">비밀번호찾기</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- class="sub_navi" -->

    <div class="sub_content">
        @yield('sub_content')
    </div><!-- class="sub_content" -->
@endsection
