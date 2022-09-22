@extends('web.layouts.app')
@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="../index/index.html"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>내일배움카드</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>카드신청안내</span>@include('web.layouts.includes.sub_menu_page_nbc')</li>
        </ul>
    </div><!-- class="sub_navi" -->

    <div class="sub_banner">
        <h3>카드신청안내</h3>
    </div><!-- class="sub_banner" -->

    <div class="sub_content card-process">
        <div class="process pro-visit">
            <h4 class="tit">첫번째. 방문신청 <span>(거주지  또는 소속사업장 관할 고용센터 방문)</span></h4>
            <ol class="list-ordered">
                <li><span class="ico ico-1">아이콘</span> 고객센터 방문<br/>신분증 지참</li>
                <li><span class="ico ico-2">아이콘</span> 카드 발급 신청<br/>신청서 작성</li>
                <li><span class="ico ico-3">아이콘</span> 발급 상담<br/>지정은행 담당자 상담</li>
                <li><span class="ico ico-4">아이콘</span> 카드 수령<br/>즉시 발급/우편 배송</li>
                <li><span class="ico ico-5">아이콘</span> 교육 수강<br/>수강 신청</li>
            </ol>
        </div>

        <div class="process pro-online">
            <h4 class="tit">두번째. 온라인 신청</h4>
            <ol class="list-ordered">
                <li>HDR-Net<br/>회원가입</li>
                <li>회원가입<br/>인증서 로그인</li>
                <li>교육 동영상<br/>시청</li>
                <li>국민내일배움<br/>카드 신청</li>
                <li>카드<br/>수령</li>
                <li>교육<br/>수강</li>
            </ol>
            <ol class="list-detail">
                <li>01. HRD-Net 홈페이지(www.hrd.go.kr) 접속</li>
                <li>02. 회원가입/로그인</li>
                <li>03. 공인인증서 로그인 (*공인인증서가 없을 경우 오프라인으로 발급)</li>
                <li>04. 훈련안내 교육동영상 시청 (20분 분량의 안내 동영상)</li>
                <li>05. 카드 발급신청서 작성 후 발급신청
                    <ul>
                        <li>우편(전화신청)_카드사를 통해 전화상으로 상담 후 우편을 통해서 발급받는 방법</li>
                        <li>우편(모바일신청)_카드사 모바일 홈페이지에 접속하여 신청한 뒤, 우편을 통해 발급받는 방법</li>
                        <li>은행방문_발급 승인 후 관할 고용센터에 방문하여 확인증 수령 또는 홈페이지 마이 서비스 > 마이 카드 > 국민내일배움카드 > 신청내역 >발급확인서출력 후 <strong>지정된 은행에 방문하여</strong> 카드를 수령하는 방법 </li>
                    </ul>
                </li>
            </ol>
            <p class="notice">* 신청 후 수령까지는 최소 1~2주정도 기간 소요</p>
        </div>

        <div class="btn-wrap">
            <a href="http://www.hrd.go.kr/" target="_blank" class="card-link link-go">카드신청 GO ></a>
            <a href="http://www.edu-site-laravel.co.kr/custom/news_view.html?p=1&keyfield=&keyword=&gubun=&no=33" target="_blank" class="card-link link-more">신청방법 상세보기 ></a>
        </div>
    </div><!-- class="sub_content" -->
@endsection
