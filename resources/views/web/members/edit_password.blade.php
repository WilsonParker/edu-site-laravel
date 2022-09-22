@extends('web.members.edit_template')

@section('banner')
    비밀번호변경
@endsection

@section('sub_title')
    비밀번호변경
@endsection

@section('sub_content')
    <form name="join" method="post" action="{{ route('members.edit.password') }}">
        @method('PUT')
        @csrf
        <table class="t_style33">
            <tr>
                <th>아이디</th>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <th>현재 비밀번호</th>
                <td><input type="password" name="current_password" maxlength=20 required/>
                </td>
            </tr>
            <tr>
                <th>새 비밀번호</th>
                <td><input type="password" name="new_password" id="PASSWORD_NM" onkeyup="passwordCheckFunction();" required maxlength=20/>
                    <span class="no" style="display:none;color:#ff0000;font-size:11px;">영어, 숫자, 특수문자를 1개 이상 포함하고, 8자 이상으로 설정해 주세요. </span>
                    <span class="yes" style="display:none;">정상입력 되었습니다.</span>
                </td>
            </tr>
            <tr>
                <th>새 비밀번호 확인</th>
                <td><input type="password" name="new_password_confirmation" id="PASSWORD_NM2" onkeyup="passwordCheckFunction();" maxlength=20 required/>
                    <span style="color: red;" id="passwordCheckMessage1"></span>
                    <span id="passwordCheckMessage2"></span>
                </td>
            </tr>
        </table>

        <div class="btn_box"><input type="submit" class="btn_type04" value="완료"/></div>
    </form>
@endsection
@push('body_scripts')
    <script type="text/javascript">
        $("#PASSWORD_NM").keyup(function () {
            var password = $(this).val();
            var no = $(this).siblings(".no");
            var yes = $(this).siblings(".yes");

            var num = password.search(/[0-9]/);
            var engU = password.search(/[A-Z]/);
            var engL = password.search(/[a-z]/);
            var spe = password.search(/[`~!@#$%^&*]/);

            if (password.length >= 8) {
                if (num > 0 || engU > 0 || engL > 0 || spe > 0) {
                    if (!/^[a-zA-Z0-9`~!@#$%^&*]{8,20}$/.test(password)) {
                        yes.hide();
                        no.show();
                    } else {
                        yes.show();
                        no.hide();
                    }
                } else {
                    no.show();
                    yes.hide();
                }
            } else {
                no.show();
                yes.hide();
            }
        });
    </script>
@endpush
