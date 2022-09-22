@extends('web.layouts.app')

@push('first_styles')
    <link rel="stylesheet" href="/css/slick.css" />
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/layerPopup.css">
    <style>
        body {
            line-height : 1.0; !important;
        }

        .main_banner{
            width: 1100px;
            height: 500px;
            margin: 0 auto;
        }
        .main_banner .banner_list img{
            height: auto;
            width: 1100px;
        }

        .main_banner_02 {
            width: 1100px;
            height: 130px;
            margin: 40px auto 0;
            background: #DFEDF8;
        }

        @media screen and (max-width:992px)  {
            .main_banner{width: 100%;}
            .main_banner .banner_list img{
                height: auto;
                width: 100%;
            }
        }
        @media screen and (max-width:792px)  {
            .main_banner{width: 100%;}

            .main_banner .banner_list img{
                height:auto;
                width: 100%;
            }
            .banner_dot{display:none!important;}

        }
        @media screen and (max-width:592px)  {
            .main_banner{width: 100%;}

            .main_banner .banner_list img{
                height:auto;
                width: 100%;
            }
            .banner_dot{display:none!important;}
        }
    </style>
@endpush

@section('content')
    <div id="section">

        <div class="main_banner">
            <div class="banner_list">
                <div class="sliders" style="width: 100%; display: inline-block;"><a href="https://edu-site-laravel.co.kr/custom/news_view.html?&amp;no=41" target="_self" tabindex="-1"><img src="/data/visual/banner.png" alt="메인배너"></a></div>
                <div class="sliders" style="width: 100%; display: inline-block;"><a href="https://edu-site-laravel.co.kr/custom/news_view.html?p=1&amp;keyfield=&amp;keyword=&amp;gubun=6&amp;no=70" target="_self" tabindex="-1"><img src="https://edu-site-laravel.co.kr/data/visual/3@1100x500.jpg" alt="메인배너"></a></div>
            </div>
        </div>

        <div class="main_banner_02">
            <div class="etc_box">
                <a href="https://www.edu-site-laravel.co.kr/custom/news_view.html?p=1&amp;keyfield=&amp;keyword=&amp;gubun=&amp;no=71"><img src="/images/main/etc3_quick03.jpg" alt="21년 정책 완화 연장! 국민내일배움카드 자비부담 15% 추가지원!"></a>
            </div>
        </div>

        <div class="main_lecture">
            <div class="main_tit">
                <h2>이러닝센터 인기강좌</h2>
                <div class="main_btn">
                    <button class="btn_prev slick-arrow" style="display: block;"><img src="/images/common/btn_prev.gif" alt="이전"></button>
                    <button class="btn_next slick-arrow" style="display: block;"><img src="/images/common/btn_next.gif" alt="다음"></button>
                    <a href="../class/course.html" class="ml3"><img src="/images/common/btn_more.gif" alt="인기강좌 더보기"></a>
                </div>
            </div>
            <div class="lecture_list slick-initialized slick-slider"><div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 4480px; transform: translate3d(-896px, 0px, 0px);"><div class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=42&amp;class_id=48&amp;category_id=A00010005&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]과정이미지_회계스타 개그맨 김승혜의 난생처음 재무회계.png" width="253" height="" alt=""></p>
                                        <p><span>[회계스타] 개그맨 김승혜의 난생처음 재무회계</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=35&amp;class_id=577&amp;category_id=A00010003&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]고객과의 행복지수를 높여라.png" width="253" height="" alt=""></p>
                                        <p><span>감성충만CS, 고객과의 행복지수를 높여라!</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=32&amp;class_id=32&amp;category_id=A00010001&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]스마트사원 경영지식.PNG" width="253" height="" alt=""></p>
                                        <p><span>스마트 사원이 알아야 할 알기쉬운 경영지식 100가지</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=31&amp;class_id=3229&amp;category_id=A00010012&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]스마트사원 회계.PNG" width="253" height="" alt=""></p>
                                        <p><span>스마트 사원이 알아야 할 알기쉬운 재무지식 100가지</span></p>
                                    </a></div></div></div><div class="slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=115&amp;class_id=546&amp;category_id=A00010001&amp;course_type=2" tabindex="0">
                                        <p class="img"><img src="/data/course/[크기변환]최진기의 지금 당장 경제학.png" width="253" height="" alt=""></p>
                                        <p><span>최진기의 지금 당장 경제학</span></p>
                                    </a></div></div></div><div class="slick-slide slick-active" data-slick-index="1" aria-hidden="false" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=110&amp;class_id=572&amp;category_id=A00010006&amp;course_type=2" tabindex="0">
                                        <p class="img"><img src="/data/course/[크기변환]1606801276.png" width="253" height="" alt=""></p>
                                        <p><span>스마트한 업무 혁신! 일반사무, 행정</span></p>
                                    </a></div></div></div><div class="slick-slide slick-active" data-slick-index="2" aria-hidden="false" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=78&amp;class_id=177&amp;category_id=A00010002&amp;course_type=2" tabindex="0">
                                        <p class="img"><img src="/data/course/핵심만 콕 집어 전하는 인사노무 이야기.PNG" width="253" height="" alt=""></p>
                                        <p><span>핵심만 콕 집어 전하는 인사노무 이야기</span></p>
                                    </a></div></div></div><div class="slick-slide slick-active" data-slick-index="3" aria-hidden="false" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=59&amp;class_id=135&amp;category_id=A00010019&amp;course_type=2" tabindex="0">
                                        <p class="img"><img src="/data/course/핵심만 콕! 바로 쓰는 총무 실무.PNG" width="253" height="" alt=""></p>
                                        <p><span>핵심만 콕! 바로 쓰는 총무 실무</span></p>
                                    </a></div></div></div><div class="slick-slide" data-slick-index="4" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=42&amp;class_id=48&amp;category_id=A00010005&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]과정이미지_회계스타 개그맨 김승혜의 난생처음 재무회계.png" width="253" height="" alt=""></p>
                                        <p><span>[회계스타] 개그맨 김승혜의 난생처음 재무회계</span></p>
                                    </a></div></div></div><div class="slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=35&amp;class_id=577&amp;category_id=A00010003&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]고객과의 행복지수를 높여라.png" width="253" height="" alt=""></p>
                                        <p><span>감성충만CS, 고객과의 행복지수를 높여라!</span></p>
                                    </a></div></div></div><div class="slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=32&amp;class_id=32&amp;category_id=A00010001&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]스마트사원 경영지식.PNG" width="253" height="" alt=""></p>
                                        <p><span>스마트 사원이 알아야 할 알기쉬운 경영지식 100가지</span></p>
                                    </a></div></div></div><div class="slick-slide" data-slick-index="7" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=31&amp;class_id=3229&amp;category_id=A00010012&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]스마트사원 회계.PNG" width="253" height="" alt=""></p>
                                        <p><span>스마트 사원이 알아야 할 알기쉬운 재무지식 100가지</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=115&amp;class_id=546&amp;category_id=A00010001&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]최진기의 지금 당장 경제학.png" width="253" height="" alt=""></p>
                                        <p><span>최진기의 지금 당장 경제학</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=110&amp;class_id=572&amp;category_id=A00010006&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]1606801276.png" width="253" height="" alt=""></p>
                                        <p><span>스마트한 업무 혁신! 일반사무, 행정</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="10" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=78&amp;class_id=177&amp;category_id=A00010002&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/핵심만 콕 집어 전하는 인사노무 이야기.PNG" width="253" height="" alt=""></p>
                                        <p><span>핵심만 콕 집어 전하는 인사노무 이야기</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="11" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=59&amp;class_id=135&amp;category_id=A00010019&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/핵심만 콕! 바로 쓰는 총무 실무.PNG" width="253" height="" alt=""></p>
                                        <p><span>핵심만 콕! 바로 쓰는 총무 실무</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="12" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=42&amp;class_id=48&amp;category_id=A00010005&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]과정이미지_회계스타 개그맨 김승혜의 난생처음 재무회계.png" width="253" height="" alt=""></p>
                                        <p><span>[회계스타] 개그맨 김승혜의 난생처음 재무회계</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="13" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=35&amp;class_id=577&amp;category_id=A00010003&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]고객과의 행복지수를 높여라.png" width="253" height="" alt=""></p>
                                        <p><span>감성충만CS, 고객과의 행복지수를 높여라!</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="14" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=32&amp;class_id=32&amp;category_id=A00010001&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]스마트사원 경영지식.PNG" width="253" height="" alt=""></p>
                                        <p><span>스마트 사원이 알아야 할 알기쉬운 경영지식 100가지</span></p>
                                    </a></div></div></div><div class="slick-slide slick-cloned" data-slick-index="15" aria-hidden="true" tabindex="-1" style="width: 214px;"><div><div class="sliders" style="width: 100%; display: inline-block;"><a href="/ncs/lecture.html?course_id=31&amp;class_id=3229&amp;category_id=A00010012&amp;course_type=2" tabindex="-1">
                                        <p class="img"><img src="/data/course/[크기변환]스마트사원 회계.PNG" width="253" height="" alt=""></p>
                                        <p><span>스마트 사원이 알아야 할 알기쉬운 재무지식 100가지</span></p>
                                    </a></div></div></div></div></div></div>
        </div><!-- class="main_lecture" -->

        <div class="main_bg">
            <div class="main_quick">
                <div class="quick_box">
                    <ul>
                        <li><a href="../custom/qna.html">
                                <div class="img"><img src="/images/main/quick_icon01.png" alt=""></div>
                                <div class="txt">
                                    <p class="tit">1:1 친절상담</p>
                                    <p>언제나 열려있는 친절상담센터</p>
                                </div>
                            </a></li>
                        <li><a href="../careful/careful.html">
                                <div class="img"><img src="/images/main/quick_icon02.png" alt=""></div>
                                <div class="txt">
                                    <p class="tit">학습유의사항</p>
                                    <p>학습시 주의사항 안내필독서</p>
                                </div>
                            </a></li>
                        <li><a href="../careful/config.html">
                                <div class="img"><img src="/images/main/quick_icon03.png" alt=""></div>
                                <div class="txt">
                                    <p class="tit">학습환경설정</p>
                                    <p>교육진행 전 필수 프로그램 설정</p>
                                </div>
                            </a></li>
                    </ul>
                    <ul>
                        <li><a href="http://939.co.kr/specup">
                                <div class="img"><img src="/images/main/quick_icon04.png" alt=""></div>
                                <div class="txt">
                                    <p class="tit">원격학습지원</p>
                                    <p>시간과 장소에 상관없이 학습지원</p>
                                </div>
                            </a></li>
                        <li><a href="../careful/pg.html">
                                <div class="img"><img src="/images/main/quick_icon05.png" alt=""></div>
                                <div class="txt">
                                    <p class="tit">필수 프로그램</p>
                                    <p>학습 진행에 필요한 프로그램 다운로드</p>
                                </div>
                            </a></li>
                        <li><a href="mailto:seunghakedu@naver.com">
                                <div class="img"><img src="/images/main/quick_icon06.png" alt=""></div>
                                <div class="txt">
                                    <p class="tit">기업교육상담</p>
                                    <p>쉽고 간편한 기업관련 상담문의</p>
                                </div>
                            </a></li>
                    </ul>
                </div>
                <div class="quick_box02">
                    <p class="tit">E-LEARNING</p>
                    <p class="mb10">전체과정이 궁금하세요?</p>
                    <p><a href="../class/course.html"><img src="/images/main/quick2_icon.png" alt="전체교육과정 바로가기"></a></p>
                </div>
            </div><!-- class="main_quick" -->
        </div>

        <div class="main_etc">
            <div class="etc_box">
                <div class="etc_faq">
                    <div class="main_tit">
                        <h2>자주하는질문</h2>
                        <div class="main_btn"><a href="../custom/faq.html"><img src="/images/common/btn_more.gif" alt="자주하는질문 더보기"></a></div>
                    </div>
                    <div class="list">
                        <ul>

                            <li>
                                <span class="tit"><a href="../custom/faq.html">과제 응시 시 "일치하는 수업정보가 없습니다" 문구 출력</a></span>
                                <span class="date">시험/과제</span>
                            </li>
                            <li>
                                <span class="tit"><a href="../custom/faq.html">"일치하는 회원정보가 없습니다" 문구 출력, "비밀번호가 일치하지 않습니다" 문구 출력</a></span>
                                <span class="date">회원가입/로그인</span>
                            </li>
                            <li>
                                <span class="tit"><a href="../custom/faq.html">"수업 최초 1회는 본인인증을 하셔야 합니다." 문구 출력</a></span>
                                <span class="date">수강신청/학습</span>
                            </li>
                            <li>
                                <span class="tit"><a href="../custom/faq.html">"일치하는 학습정보가 없습니다" 문구 출력</a></span>
                                <span class="date">수강신청/학습</span>
                            </li>
                            <li>
                                <span class="tit"><a href="../custom/faq.html">로그인 후 홈페이지가 뜨지 않고 하얀 화면으로 전환됩니다.</a></span>
                                <span class="date">회원가입/로그인</span>
                            </li>



                        </ul>
                    </div>
                </div>
                <div class="etc_quick">
                    <a href="/custom/news.html?gubun=3"><img src="/images/main/etc_quick01.png" alt="기업별 직업교육 가이드 #건강보험공단 #근로복지공단 #국민연금공단 #건강보험심사평가원"></a>
                    <a href="http://www.edu-site-laravel.co.kr/custom/news.html?gubun=4"><img src="/images/main/etc_quick02.png" alt="NCS 직업교육 FAQ #직업교육에 관한 궁금증 한번에 해결"></a>
                </div>
            </div>
            <div class="etc_box">
                <a href="../ncs/main.html"><img src="/images/main/etc2_quick01.png" alt="국민내일배움카드 과정 국비지원으로 가격부담 DOWN #부담없이 최대 교육비 0원 #최대 500만원 교육비 지원"></a>
            </div>
            <div class="etc_box">
                <div class="etc_notice">
                    <p class="tab on"><a href="../custom/news.html">공지사항</a></p>
                    <div class="list" style="display: block;">
                        <ul>


                            <li>
                                <span class="tit"><a href="../custom/news_view.html?&amp;no=69">직업교육 정복하기!</a></span>
                                <span class="date">2021-09-17</span>
                            </li>


                            <li>
                                <span class="tit"><a href="../custom/news_view.html?&amp;no=68">[공지] 추석연휴 휴무 안내</a></span>
                                <span class="date">2021-09-16</span>
                            </li>


                            <li>
                                <span class="tit"><a href="../custom/news_view.html?&amp;no=60">[2021하반기] 국민건강보험공단 직업교육의 모든 것!</a></span>
                                <span class="date">2021-09-02</span>
                            </li>


                            <li>
                                <span class="tit"><a href="../custom/news_view.html?&amp;no=56">[2021하반기] 건강보험심사평가원 직업교육의 모든 것!</a></span>
                                <span class="date">2021-09-13</span>
                            </li>



                        </ul>
                    </div>
                    <p class="tab"><a href="../custom/qna.html">질문답변</a></p>
                    <div class="list" style="display: none;">
                        <ul>

                            <li>
                                <span class="tit"><a href="javascript:alert('본인이 작성한 글만 확인할 수 있습니다.')">sdf</a></span>
                                <span class="date">2021-09-27</span>
                            </li>

                            <li>
                                <span class="tit"><a href="javascript:alert('본인이 작성한 글만 확인할 수 있습니다.')">ㅊㅌㅍ</a></span>
                                <span class="date">2021-09-27</span>
                            </li>

                            <li>
                                <span class="tit"><a href="javascript:alert('본인이 작성한 글만 확인할 수 있습니다.')">수강 접속 오류 문의드립니다.</a></span>
                                <span class="date">2021-09-26</span>
                            </li>

                            <li>
                                <span class="tit"><a href="javascript:alert('본인이 작성한 글만 확인할 수 있습니다.')">hrd-net 훈련과정 정보 바로가기</a></span>
                                <span class="date">2021-09-26</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="etc_call">
                    <p class="tit">고객상담안내</p>
                    <p class="num">02-6953-3893</p>
                    <p>평일 <span>AM 10:00</span> ~ <span>PM 18:30</span></p>
                    <p>점심시간 <span>PM 12:30</span> ~ <span>PM 13:30</span></p>
                    <p>매월 마지막주 금요일 AM 10:00 ~ PM 14:00</p>
                    <p>(토, 일요일 및 공휴일 휴무)</p>
                </div>
            </div>
        </div><!-- class="main_etc" -->


        <!-- 배너 추가_2021-01-13 -->
        <div class="banner-wrap">
            <div class="main-banner banner-left">
                <a href="https://vo.la/aM93t" target="_blank"><img src="/images/main/main_banner_left_4.png" alt="심평원 직업교육 가이드 한눈에 보기(링크이동)"></a>
            </div>
            <div class="main-banner banner-right">
                <a href="/edu/hrd51.html?p=1&amp;keyfield=&amp;keyword=&amp;gubun=2&amp;no=7" target="_blank"><img src="/images/main/main_banner_right.png" alt="NCS직업교육 신청 방법 안내(링크이동)"></a>
            </div>
        </div>

    </div>
@endsection
@push('body_scripts')
    <script src="/js/slick.min.js"></script>
    <script src="/js/main.js"></script>
@endpush
