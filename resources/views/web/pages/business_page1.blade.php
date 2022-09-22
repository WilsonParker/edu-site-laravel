@extends('web.pages.business_template')
@section('sub_content')
    <div class="sub_content">
        <div class="sub_title">
            <p class="tit">지원대상은 누구인가요?</p>
            <p>근로자 등을 대상으로 고용노동부장관으로부터 인정받은 교육훈련을 직접 또는 훈련기관에 위탁하여 실시하고 있는 고용보험 가입 사업주</p>
        </div>


        <div class="mosa_box">
            <p class="tit"> <x-image src="images/common/bul_tit2_1.gif" alt=""  style="width:15px"/>&nbsp; 훈련대상</p>
            <ul class="list_num">
                <li>고용보험 피보험자</li>
                <li>고용보험 피보험자가 아닌 자로서 해당 사업주에게 고용된 자</li>
                <li>해당 사업이나 그 사업과 관련되는 사업에서 고용하려는 자 (채용예정자)</li>
                <li>직업안정기관에 구직 등록한 자 (자체훈련만 가능)</li>
            </ul>
        </div>
    </div>
@endsection
