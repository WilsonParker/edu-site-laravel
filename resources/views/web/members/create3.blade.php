@extends('web.members.create_template')

@section('banner')
    <div class="top_banner">
        <div class="txt">
            <h2>멤버쉽</h2>
            <p>edu-site-laravel에 오신 것을 환영합니다!</p>
        </div>
    </div>
    <h3>회원가입</h3>
@endsection
@section('sub_content')
    <div class="sub_title"><p class="tit02">3. 정보입력</p></div>

    <form name="join" method="post" action="{{ route('members.store') }}" onsubmit="return Join_Check(this)" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <input type=hidden name="ss" value="{{ $ss }}">
        <input type=hidden name="ck" id="ck" value="">
        <input type=hidden name="ck_id" id="ck_id" value="">
        <input type=hidden name="co_ids" id="co_ids" value="">
        <div class="sub_title mb20"><p class="tit02">기본정보</p></div>
        <table class="t_style33 mb60">
            <col width="180">
            <col>

            <tr>

                <th><span class="font-red01">*</span> 아이디</th>
                <td><input type="text" name="user_id"   maxlength=20 required /> <input type="button" class="btn_type10" value="중복체크" onClick="idConfirm();" /> *영문 또는 숫자 4~20자로 입력해주세요.</td>

            </tr>
            <tr>

                <th><span class="font-red01">*</span> 비밀번호</th>
                <td><input type="password" id="PASSWORD_NM" name="wiz_pw" maxlength=20 required /> *비밀번호는 6~20자리로 해주세요.
                    <span class="no" style="display:none;color:#ff0000;font-size:11px;">영어 대문자, 영어 소문자, 숫자, 특수문자 중 2개 이상의 조합으로 6자 이상으로 설정해 주세요. </span>
                    <span class="yes" style="display:none;">정상입력 되었습니다.</span>
                </td>

            </tr>
            <tr>

                <th><span class="font-red01">*</span> 비밀번호 확인</th>
                <td><input type="password"  id="PASSWORD_NM2" onkeyup="passwordCheckFunction();" name="re_pw" maxlength=20 required />
                    <span style="color: red;" id="passwordCheckMessage1"></span>
                    <span  id="passwordCheckMessage2"></span>
                </td>

            </tr>
            <tr>

                <th><span class="font-red01">*</span> 이름</th>
                <td><input type="text"  name="name"  value="{{ $name }}"  maxlength=10 readOnly  required /></td>
            </tr>
            <tr>

                <th><span class="font-red01">*</span> 주민등록번호</th>
                <td><input type="text" id="s_jumin" name="jumin1"  value="{{ $registrationNumber[0] }}"   maxlength=6 required readOnly>
                    -
                    <input type="password" id="s_jumin" name="jumin2"  value="{{ $registrationNumber[1] }}"  maxlength=7 required></td>

            </tr>
            <tr>

                <th><span class="font-red01">*</span> 휴대폰 번호</th>
                <td><input type="tel" name="mobile"  maxlength=20 value="{{ $contact }}" onLoad="phoneNumber(this)" onkeyup="phoneNumber(this)" required /> </td>

            </tr>
            <tr>
                <th><span class="font-red01">*</span> 이메일</th>
                <td><input type="email" name="email" maxlength=50 required /></td>

            </tr>
            <tr>
                <th><span class="font-red01">*</span> 주소</th>
                <td class="address_box">
                    <p class="address_top">
                        <input type="text" name="post" value="" class="address_input01" id="sample6_postcode" readonly required />
                        <input type="button" class="btn_type10" onclick="sample6_execDaumPostcode(); return false;" value="우편번호 찾기" />
                    </p>
                    <p>
                        <input type="text" name="addr" class="address_input02" id="sample6_address" readonly required />
                        <input type="text" name="addr2" id="sample6_address2" />
                    </p>
                </td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 마케팅 정보 SMS <br/>수신동의 (선택)</th>
                <td>
                    <span class="mr10"><input type="radio" id="sms_yn" name="sms_yn" value="Y" checked /> <label for="sms_y">예</label></span>
                    <span><input type="radio" id="sms_n" name="sms_yn" name="sms_yn" value="N" /> <label for="sms_n">아니오</label></span>
                    <br/>(단, 내일배움카드/사업주지원교육의 경우, 교육독려문자는 발송됩니다.)
                </td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 마케팅정보 E-Mail <br/>수신동의 (선택)</th>
                <td>
                    <span class="mr10"><input type="radio" id="email_yn" name="email_yn" value="Y" checked /> <label for="email_y">예</label></span>
                    <span><input type="radio" id="email_n" name="email_yn" value="Y" /> <label for="email_n">아니오</label></span>
                </td>
            </tr>
            <tfoot>
            <tr>
                <td colspan="2" style="border: 0px">
                    <span class="font-red01">*</span> <span class="font15">마케팅 수신 미 동의 시, 할인쿠폰/무료강의 혜택 등의 이벤트알림을 받으실 수 없습니다.</span>
                </td>
            </tr>
            </tfoot>
        </table>
        <div class="sub_title mb20"><p class="tit02 fL">추가정보</p> <span class="font15 fR">아래 정보는 더 나은 서비스를 제공하기 위한 참고목적으로 사용합니다.</span></div>
        <table class="t_style33">
            <col width="180">
            <col>
            <tr>
                <th>일반전화</th>
                <td><input type="tel" name="tel"  maxlength=20 onkeyup="phoneNumber(this)" /> 예) 02-0000-0000</td>
            </tr>
        </table>

        <div class="btn_box">
            <a href="join1.html" class="btn_type02 mr3">취소</a>
            <input type="submit" id="btn_submit" accesskey="s" class="btn_type04" value="회원가입" />
        </div>
    </form>
@endsection

@push('body_scripts')
    <script>
        $(function() {
            $.ajax({
                    type: "POST",
                    url: "_autocomplete.php",
                    success: result    //function result 를 의미함
                }
            );

            $("#PASSWORD_NM").keyup(function(){
                var password = $(this).val();
                var no = $(this).siblings(".no");
                var yes = $(this).siblings(".yes");

                var num = password.search(/[0-9]/);
                var engU = password.search(/[A-Z]/);
                var engL = password.search(/[a-z]/);
                var spe = password.search(/[`~!@#$%^&*]/);

                if(password.length >= 6){
                    if(num > 0 || engU > 0 || engL > 0 || spe > 0){
                        if(!/^[a-zA-Z0-9`~!@#$%^&*]{6,20}$/.test(password))
                        {
                            yes.hide();
                            no.show();
                        }else{
                            yes.show();
                            no.hide();
                        }
                    }else{
                        no.show();
                        yes.hide();
                    }
                } else {
                    no.show();
                    yes.hide();
                }
            });
        });

        function load_company() {
            var x = document.join.cs_company.value;
            $.ajax({
                    type: "POST",
                    url: "_autocomplete.php",
                    data: "t1=" + x,   //&a=xxx 식으로 뒤에 더 붙이면 됨
                    success: result    //function result 를 의미함
                }
            );
        }

        function load_company2() {
            var x = document.join.cs_company.value;
            var y = $("#co_id option:selected").val();
            document.join.co_ids.value = y;
            $.ajax({
                    type: "POST",
                    url: "_autocomplete.php",
                    data: "t1=" + x + "&t2=" + y,   //&a=xxx 식으로 뒤에 더 붙이면 됨
                    success: result    //function result 를 의미함
                }
            );
        }

        function result(msg) {
            //sub()가 실행되면 결과 값을 가지고 와서 action 을 취해주는 callback 함수
            $("#sp1").html(msg); //innerHTML 을 이런 방식으로 사용함
        }

        function Join_Check(f) {
            f = document.join;
            //if(!TrimString(f.co_ids.value)){ alert('소속을 선택하세요.'); f.co_ids.focus();return;}
            if (!TrimString(f.user_id.value)) {
                alert('회원아이디를 입력하세요');
                f.user_id.focus();
                return false;
            }
            if (!TypeCheck(f.user_id.value, ALPHA + NUM)) {
                alert('회원아이디는 영문,숫자만 입력가능합니다.');
                f.user_id.focus();
                return false;
            }
            if (!CheckLen1(f.user_id, 4, 20)) {
                alert('회원아이디는 4자이상 20자이하이야 합니다.');
                f.user_id.focus();
                return false;
            }
            if (!TrimString(f.wiz_pw.value)) {
                alert('비밀번호를 입력하세요');
                f.wiz_pw.focus();
                return false;
            }
            if (!CheckLen1(f.wiz_pw, 6, 20)) {
                alert('비밀번호는 6자이상 20자이하이야 합니다.');
                f.wiz_pw.focus();
                return false;
            }
            if ((f.wiz_pw.value) != (f.re_pw.value)) {
                alert('비밀번호가 일치하지 않습니다. ');
                f.wiz_pw.focus();
                return false;
            }
            if (!TrimString(f.ck.value)) {
                alert('아이디 중복체크해주세요. ');
                f.user_id.focus();
                return false;
            }
            if (f.ck_id.value != f.user_id.value) {
                alert('중복체크한 아이디를 바꾸시면 다시 중복체크하셔야 합니다.');
                $("#ck").val("");
                return false;
            }
            if (!TrimString(f.name.value)) {
                alert('이름을 입력하세요');
                f.name.focus();
                return false;
            }


            var ssn1 = f.jumin1.value,
                ssn2 = f.jumin2.value,
                ssn = ssn1 + '' + ssn2,
                arr_ssn = [],
                compare = [2, 3, 4, 5, 6, 7, 8, 9, 2, 3, 4, 5],
                sum = 0;

            // 입력여부 체크
            if (ssn1 == '') {
                alert('주민등록번호를 기입해주세요.');
                f.jumin2.focus();
                return false;
            }

            if (ssn2 == '' && f.jumin2.length != 7) {
                alert('주민등록번호를 기입해주세요.');
                f.jumin2.focus();
                return false;
            }

            // 입력값 체크
            if (ssn1.match('[^0-9]')) {
                alert("주민등록번호는 숫자만 입력하셔야 합니다.");
                f.jumin2.focus();
                return false;
            }
            if (ssn2.match('[^0-9]')) {
                alert("주민등록번호는 숫자만 입력하셔야 합니다.");
                f.jumin2.focus();
                return false;
            }

            // 자리수 체크
            if (ssn.length != 13) {
                alert("올바른 주민등록 번호를 입력하여 주세요.");
                f.jumin2.focus();
                return false;
            }


            // 공식: M = (11 - ((2×A + 3×B + 4×C + 5×D + 6×E + 7×F + 8×G + 9×H + 2×I + 3×J + 4×K + 5×L) % 11)) % 11
            for (var i = 0; i < 13; i++) {
                arr_ssn[i] = ssn.substring(i, i + 1);
            }

            for (var i = 0; i < 12; i++) {
                sum = sum + (arr_ssn[i] * compare[i]);
            }

            sum = (11 - (sum % 11)) % 10;

            if (sum != arr_ssn[12]) {
                alert("올바른 주민등록 번호를 입력하여 주세요.");
                f.jumin2.focus();
                return false;
            }

            if (!TrimString(f.email.value)) {
                alert('이메일주소를 입력하세요');
                f.email.focus();
                return false;
            }
            if (!ChkMail(f.email.value)) {
                f.email.focus();
                return false;
            }
            if (!TrimString(f.mobile.value)) {
                alert('휴대폰을 입력하세요');
                f.mobile.focus();
                return false;
            }
            if (!TypeCheck(f.mobile.value, UNDER + NUM)) {
                alert('휴대폰번호는 010-1234-5678과 같은 형식으로 입력해 주세요.');
                f.mobile.focus();
                return false;
            }
            if (!TrimString(f.post.value)) {
                alert('주소를 모두 입력하세요');
                return false;
            }
            if (!TrimString(f.addr.value)) {
                alert('주소를 모두 입력하세요');
                return false;
            }
            if (!TrimString(f.addr2.value)) {
                alert('주소를 모두 입력하세요');
                return false;
            }

            document.getElementById("btn_submit").disabled = "disabled";
            return true;
        }

        function passwordCheckFunction() {
            var userPassword1 = $('#PASSWORD_NM').val();
            var userPassword2 = $('#PASSWORD_NM2').val();

            if (userPassword1 != userPassword2) {
                $('#passwordCheckMessage1').html("비밀번호가 일치하지 않습니다");
                $('#passwordCheckMessage2').html("");
            } else {
                $('#passwordCheckMessage2').html("정상입력 되었습니다.");
                $('#passwordCheckMessage1').html("");
            }
        }

        function idConfirm() {
            var f = document.join;
            if (f.user_id.value == '') {
                alert('ID를 입력해 주세요. ');
                return false;
            }

            $.ajax({
                    type: "POST",
                    url: "idCheck.php",
                    data: "id=" + f.user_id.value,   //&a=xxx 식으로 뒤에 더 붙이면 됨
                    dataType: "json",
                    async: true,
                    success: function (data) {
                        if (data.result == 'y') {
                            alert("사용가능한 ID입니다.");
                            $("#ck").val("y");
                            $("#ck_id").val(f.user_id.value);
                        } else {
                            alert("동일한 ID가 존재합니다.");
                            $("#ck").val("");
                        }
                    },
                }
            );
        }

    </script>
@endpush
