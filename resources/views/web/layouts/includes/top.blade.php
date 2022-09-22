<div class="skip_box">
    <a href="#section">본문 바로가기</a>
    <a href="#footer">하단메뉴 바로가기</a>
</div>
<div id="wrap">
    <div id="header">
        <div class="m_navi_icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header_bg"></div>
        <div class="gnb_box">
            <h1><a href="/">
                    <x-image src="images/common/logo.png" :alt="config('app.url')"/>
                </a></h1>
            <div class="gnb">

                @auth()
                    <a href="{{ route('auth.logout') }}">로그아웃</a>
                    <a href="{{ route('members.edit.index') }}">정보수정</a>
                @else
                    <a href="{{ route('auth.index') }}">로그인</a>
                    <a href="{{ route('members.create') }}">회원가입</a>
                @endauth
                <a href="{{ route('members.index') }}" class="font-green01">마이페이지</a>
                <a href="{{ route('members.coupons.index') }}">쿠폰함</a>
            </div>
        </div><!-- class="gnb_box" -->
        <div class="navi">
            <ul>
                <li><a>내일배움카드</a>
                    <ul>
                        <li><a href="{{ route('pages.nbc.index') }}">내일배움카드제도 안내</a></li>
                        <li><a href="{{ route('pages.nbc.training') }}">훈련진행절차 안내</a></li>
                        <li><a href="{{ route('pages.nbc.card') }}">카드신청안내</a></li>
                    </ul>
                </li>

                <li><a>기업교육</a>
                    <ul>
                        <li><a href="{{ route('pages.business.index') }}">사업주훈련제도 안내</a></li>
                        <li><a href="{{ route('pages.business.training') }}">훈련진행절차 안내</a></li>
                        <li><a href="{{ route('pages.business.refunds') }}">환급절차안내</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('lectures.index') }}">NCS 직업교육</a></li>
                <li><a href="{{ route('lectures.index', ['type' => 'semiconductor']) }}">NCS 반도체교육</a></li>
                <li><a href="{{ route('lectures.index', ['type' => 'it']) }}">IT 교육</a></li>

                <li><a>NCS 직업교육 가이드</a>
                    <ul>
                        <li><a href="{{ route('board.ncs_guide', ['board'=>5]) }}">NCS 직업교육 신청 방법</a></li>
                        <li><a href="{{ route('board.index', ['code'=>'guide']) }}">기업별 직업교육 가이드</a></li>
                        <li><a href="{{ route('board.index', ['code'=>'ncs_faq']) }}">NCS 직업교육 FAQ</a></li>
                    </ul>
                </li>

                <li><a>학습지원센터</a>
                    <ul>
                        <li><a href="{{ route('board.index') }}">공지사항</a></li>
                        <li><a href="{{ route('board.index', ['code'=>'event']) }}">이벤트</a></li>
                        <li><a href="{{ route('board.faq') }}">자주하는질문(FAQ)</a></li>
                        <li><a href="{{ route('qna.index') }}">1:1상담</a></li>
                        <li><a href="https://939.co.kr/specup/" target="_blank">원격지원프로그램</a></li>
                        <li><a href="{{ route('board.careful.index') }}">학습유의사항</a></li>
                    </ul>
                </li>

                <li><a>내강의실</a>
                    @include('web.layouts.includes.sub_menu_page_members')
                </li>
            </ul>
        </div>
    </div>
</div>
