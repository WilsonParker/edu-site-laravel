@extends('web.boards.careful_template')
@section('sub_content')
    <div class="sub_content">
        <div class="sub_title mb10"><p class="tit">Flash 설치확인</p></div>
        <div class="config_box mb40">
            <div class="content">
                <div class="wrap">
                    <div class="content" style="width: auto;">
                        <div class="test">
                            <p class="txt">훈련생 PC에 Flash가 (<span id="hadobin"></span>)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub_title mb10"><p class="tit">인터넷 익스플로러의 인터넷 임시파일 제거</p></div>
        <div class="config_box mb40">
            <div class="content">
                <p class="txt">1. 인터넷 옵션창 > [일반]탭 > 검색기록 > 삭제를 클릭</p>
                <p><x-image src="images/sub/careful/config01_1.jpg" alt="" /></p>
            </div>
            <div class="content">
                <p class="txt">2. 임시인터넷 파일, 쿠키,  ActiveX 필터링 및 추적 방지 데이터 3항목만 체크 후 삭제 클릭</p>
                <p><x-image src="images/sub/careful/config01_2.jpg" alt="" /></p>
            </div>
        </div>

        <div class="sub_title mb10"><p class="tit">인터넷 익스플로러의 인터넷 옵션을 아래와 같이 설정해주세요.</p></div>
        <div class="config_box">
            <div class="content">
                <p class="txt">1. 인터넷 옵션 창에서 [보안]탭으로 이동 > 모든 영역을 기본 수준으로 다시 설정을 클릭</p>
                <p><x-image src="images/sub/careful/config02_1.jpg" alt="" /></p>
            </div>
            <div class="content">
                <p class="txt">2. [개인 정보]탭으로 이동 > 팝업 차단 사용 체크해제</p>
                <p><x-image src="images/sub/careful/config02_2.jpg" alt="" /></p>
            </div>
        </div>
        <div class="config_box">
            <div class="content">
                <p class="txt02">3. [고급]탭으로 이동 > GPU 렌더링 대신소프트웨어 렌더링 사용 체크 (단,  Internet Explorer 8 이하 버전에서는 이 항목이 없습니다.)</p>
                <p><x-image src="images/sub/careful/config02_3.jpg" alt="" /></p>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
        function is_flash_installed() {
            try {
                if (new ActiveXObject('ShockwaveFlash.ShockwaveFlash')) {
                    return "설치되어 있습니다.";
                }
            } catch (e) {
                if (navigator.mimeTypes['application/x-shockwave-flash'] != undefined) {
                    return "설치되어 있습니다.";
                }
            }
            return "미설치 또는 허용안함으로 되어 있습니다.";
        }

        function openPopup() {
            var win = window.open('', 'win', 'width=1, height=1, scrollbars=yes, resizable=yes');

            if (win == null || typeof (win) == "undefined" || (win == null && win.outerWidth == 0) || (win != null && win.outerHeight == 0) || win.test == "undefined") {
                alert("팝업 차단 기능이 설정되어있습니다\n\n차단 기능을 해제(팝업허용) 한 후 다시 이용해 주십시오.\n\n만약 팝업 차단 기능을 해제하지 않으면\n정상적인 주문이 이루어지지 않습니다.");

                if (win) {
                    win.close();
                }
                return;
            } else if (win) {
                if (win.innerWidth === 0) {
                    alert("팝업 차단 기능이 설정되어있습니다\n\n차단 기능을 해제(팝업허용) 한 후 다시 이용해주십시오.\n\n만약 팝업차단기능을 해제하지 않으면\n정상적인 주문이 이루어지지않습니다.");
                }
            } else {
                return;
            }
            if (win) {    // 팝업창이 떠있다면 close();
                win.close();
            }
        }    // 함수 끝

        window.onload = function () {      // 페이지 로딩 후 즉시 함수 실행(window.onload)
            document.getElementById("hadobin").innerHTML = is_flash_installed();
            openPopup()
        }
    </script>
@endpush
