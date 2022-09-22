@extends('web.members.create_template')

@section('banner')
    <div class="top_banner">
        <div class="txt">
            <h2>멤버쉽</h2>
            <p>edu-site-laravel에 오신 것을 환영합니다!</p>
        </div>
    </div>
    <h3>회원가입(가입완료)</h3>
@endsection
@section('sub_content')
    <div class="sub_title"><p class="tit02">4. 가입완료</p></div>
    <div class="result_box">
        <p class="img">
            <x-image src="images/sub/member/icon_party.png" alt=""/>
        </p>
        <p class="tit">회원가입완료</p>
        <p class="txt">
            축하드립니다! 회원님의 가입이 정상적으로 완료되었습니다! <br/>
            회원이 되신 것을 진심으로 환영합니다! 이제 다양한 혜택을 누리세요!
        </p>

        <div class="btn_box"><a href="{{ route('auth.index') }}" class="btn_type03">로그인 하러가기 &nbsp;&nbsp;&gt;</a></div>
    </div>
@endsection
