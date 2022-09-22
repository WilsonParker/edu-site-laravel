@extends('web.layouts.app')
@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="/"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>내일배움카드</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>카드신청안내</span>@include('web.layouts.includes.sub_menu_page_business')</li>
        </ul>
    </div><!-- class="sub_navi" -->

    <div class="sub_content">
        <div class="sub_title">
            <p class="tit">환급절차 안내</p>
        </div>

        <div class="mosa_box">
            <p class="tit"> <x-image src="images/common/bul_tit2_1.gif" alt=""  style="width:15px"/>&nbsp; 교육 및 환급절차</p>
            <p>사업주 위탁훈련 지원규정 변경으로 인하여, 2019년 1월 개강 과정부터는 사업주 자부담비를 입금해야 환급이 진행 됩니다. <br />교육 시작전에 사업주 자부담비를 훈련기관 명의의 계좌로 입금이 되야합니다. <br /></p>
            <p class="mb40">※단, 교육 미수료자는 교육비 환급을 받을 수 없습니다.</p>

            <p class="tit02">적용대상?</p>
            <ul class="list_num mb40">
                <li>진도율 80% 필수, 최종평가 응시 필수, 과제 제출 필수</li>
                <li>총 100점 만점 기준으로 60점 이상 취득 시 수료 가능합니다.</li>
                <li>교육과정 미수료 시에는 교육비 환급을 받으실 수 없습니다.</li>
            </ul>

            <p class="tit02">우선지원 대상기업이란</p>
            <p class="mb7">보험요율의 적용과 고용안정사업 및 직업능력개발사업의 실시에 있어서 우선적으로 고려하는 기업을 말하며, 산업별 상시 근로자의 수가 다음과 같을 <br />경우에는 우선지원대상기업에 해당됩니다.</p>
            <ul class="list_num">
                <li>제조업 : 500인 이하</li>
                <li>건설업 : 300인 이하</li>
                <li>광업 : 300인 이하</li>
                <li>운수·창고·통신업 : 300인 이하</li>
                <li>기타산업 : 100인 이하</li>
                <li>중소기업청장이 중소기업기본법 제2조 제1항 및 제3항의 기준에 의하여 중소기업으로 확인한 기업 우선지원 대상기업 해당여부는 전년도를 기준으로 1년 단위로 판단합니다. <br />하나의 사업주가 2개 이상의 산업의 사업을 경영하는 경우에는 상시 근로자수가 없는 산업을 기준으로 적용하고, 상시 근로자수가 같을 때에는 임금총액·매출액 순으로 적용합니다.</li>
            </ul>
            <br>
            <p><b>※ 우선지원 대상기업의 해당여부는 근로복지공단(1588-0075)에 문의하시기 바랍니다.</b></p>
            <p><b>※ 추가로 문의사항은 당사(02-6953-3893)로 문의하시기 바랍니다.</b></p>
        </div>

    </div><!-- class="sub_content" -->
@endsection
