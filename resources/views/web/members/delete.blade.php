@extends('web.members.edit_template')

@section('banner')
    회원탈퇴
@endsection

@section('sub_title')
    회원탈퇴
@endsection

@section('sub_content')
    <form action="#" method="delete" onSubmit="return Join_Check();">
        <table class="t_style33">
            <tr>
                <th>아이디</th>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <th>이름</th>
                <td>{{ $data->memberInformation->name }}</td>
            </tr>
            <tr>
                <th>현재 비밀번호</th>
                <td><input type="password" name="wiz_pw" maxlength=20 style="ime-mode:disabled" required/></td>
            </tr>
            <tr>
                <th>탈퇴사유</th>
                <td><input type="text" name="reason" required/></td>
            </tr>
        </table>

        <div class="btn_box"><input type="submit" class="btn_type04" value="회원탈퇴"/></div>
    </form>
@endsection
@push('body_scripts')
    <script>
        function Join_Check() {
            // f=document.join;
            // if(!TrimString(f.wiz_pw.value)){ alert('비밀번호를 입력하세요');f.wiz_pw.focus(); return false;}
            // if(!CheckLen1(f.wiz_pw,6,20)){alert('비밀번호는 6자이상 20자이하이야 합니다.'); f.wiz_pw.focus();return false;}
            // if(!TrimString(f.reason.value)){ alert('탈퇴사유를 입력하세요');f.reason.focus(); return false;}
            // return true;
            alert('회원탈퇴가 불가능합니다. 고객센터에 문의주세요.\n대표번호(02-6953-3893)');
            return false;
        }
    </script>
@endpush
