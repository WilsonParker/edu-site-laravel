@extends('web.layouts.app')
@section('content')
    <div class="sub_navi">
        <ul>
            <li class="home"><a href="../index/index.html"><x-image src="images/common/icon_home.png" alt="홈으로" /></a></li>
            <li><span>내일배움카드</span>@include('web.layouts.includes.sub_menu')</li>
            <li><span>훈련진행절차 안내</span>@include('web.layouts.includes.sub_menu_page_nbc')</li>
        </ul>
    </div>
    <div class="sub_content">
        <div class="sub_title">
            <p class="tit">훈련진행절차 안내</p>
        </div>

        <div class="step_box">
            <ol>
                <li>
                    <div class="step">
                        <div class="num">01</div>
                        <div class="con">
                            <p class="tit">교육안내</p>
                            <p class="txt">일정안내 공지사항을 통해 교육과정 및 학습일정 확인</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">02</div>
                        <div class="con">
                            <p class="tit">수강신청</p>
                            <p class="txt">교육안내 참고하여 교육과정 신청</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">03</div>
                        <div class="con">
                            <p class="tit">학습시작</p>
                            <p class="txt">학습 계획 수립 및 학습 시작</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">04</div>
                        <div class="con">
                            <p class="tit">학습진행</p>
                            <p class="txt">일정 내에 자율적인 학습 시작</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">05</div>
                        <div class="con">
                            <p class="tit">평가실시</p>
                            <p class="txt">매월 학습 종료일까지 평가 실시(월 1회, 의무사항)</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">06</div>
                        <div class="con">
                            <p class="tit">강사채점</p>
                            <p class="txt">제출된 리포트를 첨삭위원의 평가지도 및 평가확인</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">07</div>
                        <div class="con">
                            <p class="tit">수료여부확정</p>
                            <p class="txt">교육기간 내 평가 실시 등 수료기간에 의거, 수료/미수료 확정(평가시험 평균 60점 이상)</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="step">
                        <div class="num">08</div>
                        <div class="con">
                            <p class="tit">교육결과보고</p>
                            <p class="txt">교육종료 후 교육결과 및  훈련생 환급자료보고</p>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div><!-- class="sub_content" -->
@endsection
