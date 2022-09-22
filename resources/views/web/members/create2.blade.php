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
    <form name="form2" action="/ipin/ipin2.php" method="post">
        <input type="hidden" name="loc" value="1"/>
        <input type="hidden" name="no" value=""/>
    </form>

    <form name="form1" action="/ipin/hs_cnfrm_popup2.php" method="post">
        <input type="hidden" name="rqst_caus_cd" value="00"/>
        <input type="hidden" name="in_tp_bit" value="0"/>
        <input type="hidden" name="no" value=""/>
        <input type="hidden" name="loc" value="1"/>
    </form>

    <form name="kcbOutForm" method="post">
        <input type="hidden" name="encPsnlInfo"/>
        <input type="hidden" name="virtualno"/>
        <input type="hidden" name="dupinfo"/>
        <input type="hidden" name="realname"/>
        <input type="hidden" name="cprequestnumber"/>
        <input type="hidden" name="age"/>
        <input type="hidden" name="sex"/>
        <input type="hidden" name="nationalinfo"/>
        <input type="hidden" name="birthdate"/>
        <input type="hidden" name="coinfo1"/>
        <input type="hidden" name="coinfo2"/>
        <input type="hidden" name="ciupdate"/>
        <input type="hidden" name="cpcode"/>
        <input type="hidden" name="authinfo"/>
        <input type="hidden" name="no" value=""/>
        <input type="hidden" name="loc" value=""/>
    </form>
    <form name="kcbResultForm" method="post">
        <input type="hidden" name="mem_id" value=""/>
        <input type="hidden" name="svc_tx_seqno" value=""/>
        <input type="hidden" name="rqst_caus_cd" value=""/>
        <input type="hidden" name="result_cd" value=""/>
        <input type="hidden" name="result_msg" value=""/>
        <input type="hidden" name="cert_dt_tm" value=""/>
        <input type="hidden" name="di" value=""/>
        <input type="hidden" name="ci" value=""/>
        <input type="hidden" name="name" value=""/>
        <input type="hidden" name="birthday" value=""/>
        <input type="hidden" name="sex" value=""/>
        <input type="hidden" name="nation" value=""/>
        <input type="hidden" name="tel_com_cd" value=""/>
        <input type="hidden" name="tel_no" value=""/>
        <input type="hidden" name="return_msg" value=""/>
        <input type="hidden" name="no" value=""/>
        <input type="hidden" name="loc" value=""/>
    </form>

    <div class="sub_title">
        <p class="tit02">2. 본인인증</p>
    </div>
    <div class="join_box">
        <div class="ident_box">
            <p class="tit">가입여부인증</p>
            <p class="txt">고객님의 개인정보는 본인의 동의 없이 제 3자에게 제공되지 않으며, <br/>
                개인정보 취급방침에 따라 외부 위협으로 부터 안전하게 보호 되고 있습니다. <br/>
                고객님께서 입력하신 정보를 안전하고 정확하게 관리하기 위해 최선을 다하겠습니다.</p>
            <div class="text-center">
                <a href="javascript:;" onclick="jsSubmit()" class="ident_btn">휴대폰 인증</a>
                <a href="javascript:;" onclick="jsSubmit2()" class="ident_btn">아이핀(I-Pin) 인증</a>
            </div>
            <p class="txt font15">※ 휴대폰 인증 시 본인 명의가 아닌 경우 정상적으로 가입되지 않을 수 있습니다. <br/>
                ※ 명의 문제로 인한 휴대폰 인증 실패 시 아이핀(i-PIN) 인증을 이용하시기 바랍니다. </p>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
        function jsSubmit() {
            var form1 = document.form1;
            var inTpBit = "";

            inTpBit = form1.in_tp_bit.value;

            if (inTpBit & 1) {
                if (form1.name.value == "") {
                    alert("성명을 입력해주세요");
                    return;
                }
            }
            if (inTpBit & 2) {
                if (form1.birthday.value == "") {
                    alert("생년월일을 입력해주세요");
                    return;
                }
            }
            if (inTpBit & 8) {
                if (form1.tel_com_cd.value == "") {
                    alert("통신사코드를 입력해주세요");
                    return;
                }
                if (form1.tel_no.value == "") {
                    alert("휴대폰번호를 입력해주세요");
                    return;
                }
            }

            window.open("", "auth_popup", "width=430,height=590,scrollbar=yes");

            var form1 = document.form1;
            form1.target = "auth_popup";
            form1.submit();
        }

        function jsSubmit2() {
            var popupWindow = window.open("", "kcbPop", "left=200, top=100, status=0, width=450, height=550");
            var form2 = document.form2;
            form2.target = "kcbPop";
            form2.submit();

            popupWindow.focus();
        }
    </script>
@endpush
