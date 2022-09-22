@extends('web.members.create_template')


@section('banner')
    <h3>회원가입</h3>
@endsection

@section('sub_content')
    <div class="sub_title"><p class="tit02">1. 약관동의</p></div>
    <form action="{{ route('members.create2') }}">
        <div class="join_box">
            <div class="all_chk">
                <input type="checkbox" id="all_chk"/>
                <label for="all_chk">전체 약관에 동의합니다.</label>
            </div>
            <div class="chk_box">
                <p class="tit">[필수] 이용약관동의</p>
                <div class="con">
                    {!! nl2br(' 제1조 (목적)
                    이 약관은 edu-site-laravel 가 운영하는 edu-site-laravel.co.kr 사이트를 통해 제공하는 서비스(이하 "서비스"라 함)를 이용함에 있
                    어 edu-site-laravel 서비스이용자(이하 "회원"이라 함) 사이에 권리, 의무 및 책임사항을 규정함을 목적으로 합니다.
                    ') !!}
                </div>
                <p class="agr"><input type="checkbox" id="agr_chk1" class="agree" required/> <label for="agr_chk1">이용약관에 동의합니다.</label></p>
            </div>
            <div class="chk_box">
                <p class="tit">[필수] 개인정보취급방침</p>
                <div class="con">
                    {!! nl2br(' 1. 수집하는 개인정보 항목
') !!}
                </div>
                <p class="agr"><input type="checkbox" id="agr_chk2" class="agree" required/> <label for="agr_chk2">개인정보취급방침 동의합니다.</label></p>
            </div>

            <div class="chk_box">
                <p class="tit">[필수] ACS 안내</p>
                <div class="con">
                    <p class="mb12">한국산업인력공단에서 원격훈련 모니터링과 관련하여 훈련실시 여부 등을 확인하는 문자를 발송합니다.</p>
                    <table class="t_style16">
                        <tr>
                            <th>문자내용</th>
                            <td>한국산업인력공단 훈련품질향상센터에서 OOO님께 OO년 O월, OO과정의 원격훈련(이러닝) 수강여부를 확인중입니다. <br/><br/>
                                위의 수강내용이 맞으면 숫자 '1', 틀리면 숫자 '2'를 OO까지 문자로 회신 주시면 감사하겠습니다. <br/><br/>
                                - 이하생략 -
                            </td>
                        </tr>
                        <tr>
                            <th>관련규정</th>
                            <td>-휴대전화번호 수집 규정 <br/><br/>
                                근로자직업능력개발법 제24조 <br/><br/>
                                사업주직업능력개발훈련 지원규정 <br/><br/>
                                제7조 제1항 제1호 별지 제2호 서식 <br/><br/>
                                -모니터링 대상 규정 <br/><br/>
                                직업능력개발훈련 모니터링업무지침 제2조 <br/><br/>
                                -휴대전화번호 모니터링 관련 사용 규정 <br/><br/>
                                직업능력개발훈련 모니터링에 관한 규정 제2조
                            </td>
                        </tr>
                    </table>
                </div>
                <p class="agr"><input type="checkbox" id="agr_chk3" class="agree" required/> <label for="agr_chk3">ACS 안내에 동의합니다.</label></p>
            </div>
        </div>

        <div class="btn_box"><input type="submit" class="btn_type01" value="다음단계"/></div>
    </form>
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
