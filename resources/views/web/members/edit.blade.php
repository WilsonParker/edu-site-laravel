@extends('web.members.edit_template')

@section('banner')
    회원정보수정
@endsection

@section('sub_title')
    기본정보
@endsection

@section('sub_content')
    <form name="join" method="post" action="{{ route('members.update') }}">
        @method('PUT')
        @csrf
        <table class="t_style33 mb60">
            <col width="180">
            <col>
            <tr>
                <th><span class="font-red01">*</span> 아이디</th>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 현재 비밀번호</th>
                <td><input type="password" name="current_password" maxlength=20 required/></td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 이름</th>
                <td>{{ $data->memberInformation->name }}</td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 생년월일</th>
                <td>{{ $data->memberInformation->front_rg_number }}</td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 휴대폰 번호</th>
                <td>{{ substr($data->memberInformation->phone_number,0,3) }}
                    -{{ substr($data->memberInformation->phone_number,3,4) }}
                    -{{substr($data->memberInformation->phone_number,7)}} <input type="button" class="btn_type10"
                                                                                 onclick="jsSubmit();"
                                                                                 value="휴대폰번호 변경"/></td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 이메일</th>
                <td><input type="email" name="email" maxlength=50 value="{{ $data->memberInformation->email }}"
                           required/></td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 마케팅 정보 SMS <br/>수신동의 (선택)</th>
                <td>
                    <span class="mr10">
                        <input type="radio" id="sms_yn" name="sms_agree" value="1" {{ $data->memberPush->sms_agree=="1" ? "checked" : "" }}/> <label for="sms_y">예</label>
                    </span>
                    <span>
                        <input type="radio" id="sms_n" name="sms_agree" value="0" {{ $data->memberPush->sms_agree=="0" ? "checked" : "" }} /> <label for="sms_n">아니오</label>
                    </span>
                    <br/>(단, 내일배움카드/사업주지원교육의 경우, 교육독려문자는 발송됩니다.)
                </td>
            </tr>
            <tr>
                <th><span class="font-red01">*</span> 마케팅정보 E-Mail <br/>수신동의 (선택)</th>
                <td>
                    <span class="mr10">
                        <input type="radio" id="email_yn" name="email_agree" value="1" {{ $data->memberPush->email_agree=="1" ? "checked" : "" }} /> <label for="email_y">예</label>
                    </span>
                    <span>
                        <input type="radio" id="email_n" name="email_agree" value="0" {{ $data->memberPush->email_agree=="0" ? "checked" : "" }}/> <label for="email_n">아니오</label>
                    </span>
                </td>
            </tr>
        </table>
        <div class="sub_title mb20"><p class="tit02 fL">추가정보</p> <span class="font15 fR">아래 정보는 더 나은 서비스를 제공하기 위한 참고목적으로 사용합니다.</span>
        </div>
        <table class="t_style33">
            <col width="180">
            <col>
            <tr>
                <th>일반전화</th>
                <td><input type="text" name="home_number" value=" {{ $data->memberInformation->home_number }}" onkeyup="phoneNumber(this)"/>예) 02-0000-0000</td>
            </tr>
            <tr>
                <th>주소</th>
                <td class="address_box">
                    <p class="address_top">
                        <input type="text" class="address_input01" id="sample6_postcode" name="zip_code"
                               value="{{ $data->memberInformation->zip_code }}" required readonly/>
                        <input type="button" class="btn_type10" onclick="sample6_execDaumPostcode(); return false;"
                               value="우편번호 찾기"/>
                    </p>
                    <p>
                        <input type="text" class="address_input02" id="sample6_address" name="address"
                               value="{{ $data->memberInformation->address }}" readonly required/>
                        <input type="text" name="detail_address" id="sample6_address2"
                               value="{{ $data->memberInformation->detail_address }}" required/>
                    </p>
                </td>
            </tr>
        </table>

        <div class="btn_box"><input type="submit" class="btn_type04" value="수정완료"/></div>
    </form>
@endsection
@push('body_scripts')
    <script>
        function Join_Check() {
            f = document.join;
            if (!TrimString(f.current_password.value)) {
                alert('비밀번호를 입력하세요');
                f.current_password.focus();
                return false;
            }
            if (!CheckLen1(f.current_password, 8, 20)) {
                alert('비밀번호는 8자이상 20자이하이야 합니다.');
                f.current_password.focus();
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
            return true;
        }
    </script>
@endpush
