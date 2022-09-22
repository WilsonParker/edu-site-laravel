@extends('web.auth.template')

@push('styles')
    <style>
        *{font-size:16px;}
    </style>
@endpush
@section('sub_content')
    <div class="login_box">
        <div class="left">
            <form method="post" name="mlogin2" action="{{ route('auth.login') }}" onSubmit="return Mlogin_Check2();"  class="login">
                @csrf
                <input type="hidden" name="link" value="{{ $link }}">

                <fieldset>
                    <legend>
                        <span class="tit">로그인하기</span>
                        <span>로그인을 위하여 아래 아이디와 비밀번호를 입력해주세요.</span>
                    </legend>
                    <p class="mb7"><label for="login_ID" class="info">ID</label> <input type="text" id="login_ID" name="id" required /></p>
                    <p class="mb7"><label for="login_PW" class="info">PW</label> <input type="password" id="login_PW" name="password" required /></p>
                    <p class="mb7"><input type="checkbox" id="login_IDr" name="login_IDr" /> <label for="login_IDr">아이디 기억하기</label></p>
                    <p><input type="submit" class="login_btn01" value="로그인" /></p>
                </fieldset>
            </form>
        </div>
        <div class="right">
            <div class="find id"><span>아이디를 잊으셨나요?</span> <a href="find_id.html" class="login_btn02">아이디찾기</a></div>
            <div class="find pw"><span>비밀번호를 잊으셨나요?</span> <a href="find_pw.html" class="login_btn02">비밀번호찾기</a></div>
            <div class="join">
                <a href="/member/join1.html" class="login_btn03">회원가입</a>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
    </script>
@endpush
