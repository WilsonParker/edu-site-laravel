@extends('web.lectures.payments.template')

@php
    $total = 10000;
@endphp
@push('styles')
    <style>
        @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
            .ncs-payment {
                width: 100%;
                overflow: hidden;
                position: relative;
            }

            .inner {
                overflow: hidden;
                padding: 40px 0;
                display: flex;
            }

            .ncs-cont-wrap {
                max-width: 1050px;
                margin: 0 auto;
                overflow: hidden;
            }

            html {
                position: static;
            }
        }

        @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
            .ncs-popup-wrap .popup-style1 .popup-content .close {
                position: absolute;
            }
        }
    </style>
@endpush
@section('content')
    <form name="pay_form" id="pay_form">
        <div id="ncs-section" class="ncs-payment">
            <div class="inner">
                <div class="ncs-cont-wrap">
                    <div class="ncs-cont">
                        <div class="title-area">
                            <h1 class="main-title">수강신청 정보</h1>
                        </div>
                        <div class="content-area">
                            <h2 class="title">{{ $data->lecture->title }}</h2>
                            <table class="ncs-table">
                                <thead class="hidden">
                                <tr>
                                    <th scope="col">분류</th>
                                    <th scope="col">내용</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">학습기간</th>
                                    <td>{{ $formatDefaultDate(now()) }}
                                        ~ {{ $formatDefaultDate($data->getLearningEndDate()) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">복습기간</th>
                                    <td>{{ $formatDefaultDate($data->getReviewStartDate()) }}
                                        ~ {{ $formatDefaultDate($data->getReviewEndDate()) }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">신청유형</th>
                                    <td>일반과정</td>
                                </tr>
                                <tr>
                                    <th scope="row">NCS 직무분류</th>
                                    <td>{{ $data->lecture->category->getNumberText() }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">금액</th>
                                    <td>{{ number_format($total) }}원</td>
                                </tr>
                                <tr>
                                    <th scope="row">할인금액</th>
                                    <td><span id="discount">0</span>원</td>
                                </tr>
                                <tr>
                                    <th scope="row">결제금액</th>
                                    <td class="total"><span class="total_pay">{{ number_format($total) }}</span>원</td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="payment-box ncs-policy">
                                <h3 class="title">일반과정 신청 동의서</h3>
                                <div class="policy-box">
                                    <p class="policy-info">
                                    <p style="line-height: 2;"><b><span
                                                style="font-family: arial;">■ 일반과정 신청 시 필수 확인사항​</span></b></p>
                                    <p><b><br></b></p>
                                    <p style="line-height: 2;"><span style="font-family: arial;">신청하신 일반과정은 내일배움카드와 사업주훈련과 달리 미지원 과정으로 자비로 결제하시는 과정입니다.</span>
                                    </p>
                                    <p>&nbsp;</p>
                                    <p style="line-height: 2;"><span style="font-family: arial;">신청하신 과정은 NCS직무능력 표기된 수료증 발급이 가능합니다.&nbsp;&nbsp;</span>
                                    </p>
                                    <p style="line-height: 2;"><b><span
                                                style="color: rgb(255, 0, 0); font-family: arial;">단, HRD-net내 수강 이력에는 확인되지 않습니다.</span></b>
                                    </p>
                                    <p style="line-height: 2;"><b><span
                                                style="color: rgb(255, 0, 0); font-family: arial;">(HRD-net내 수강 이력 확인은 지원과정으로 수강시에 가능하며 일반과정은 미지원 과정으로 이력확인이 불가합니다.)&nbsp;</span></b>
                                    </p>
                                    <p>&nbsp;</p>
                                    <p style="line-height: 2;"><span style="font-family: arial;">또한 해당과정의 수료조건을 충족해야 하며 미수료시 수료증 발급이 되지 않습니다.&nbsp; &nbsp; &nbsp;</span>
                                    </p>
                                    <p>&nbsp;</p>
                                    <p style="line-height: 2;"><span style="font-family: arial;">수료증은 수료기준이 완료되는 즉시 아래 위치에서 발급이 가능합니다.&nbsp;&nbsp;</span>
                                    </p>
                                    <p style="line-height: 2;"><span style="font-family: arial;">[내강의실 - 학습종료된 수업- 수료증발급]&nbsp;&nbsp;</span>
                                    </p>
                                    <p style="line-height: 2;"><span style="font-family: arial;">※ </span><span
                                            style="font-family: arial;">단, 시험 및 과제 채점으로 수료증 발급은 지연될 수 있습니다.</span></p>
                                    <p>&nbsp;</p>
                                    </p>
                                </div>
                                <div class="policy-guide">
                                    <p>상기내용을 확인하였으며, 상기내용 미숙지로 인한 불이익에 대해서는 본인의 책임으로 인정합니다.</p>
                                    <p class="plicy-user">학습자 <span>{{ $member->memberInformation->name }}</span></p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="agree" id="agree1" value="Y">
                                        <label class="form-check-label" for="agree1">
                                            동의함
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="agree" id="agree2" value="N"
                                               checked>
                                        <label class="form-check-label" for="agree2">
                                            동의안함
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-box ncs-discount">
                                <h3 class="title">할인 코드 등록</h3>
                                <p>추천인 코드 또는 할인 쿠폰 번호를 입력해주세요. 등록 후 중복 사용은 불가합니다.</p>

                                <div class="input-group">
                                    <input type="text" name="coupon_num" id="coupon_num" class="form-control"
                                           placeholder="할인 코드" aria-label="할인 코드" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn img01" type="button" id="button-addon1"
                                                style="cursor:pointer">조회
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="payment-box ncs-method">
                                <h3 class="title">최종 결제 정보</h3>
                                <table class="ncs-table">
                                    <thead class="hidden">
                                    <tr>
                                        <th scope="col">분류</th>
                                        <th scope="col">내용</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">강의금액</th>
                                        <td>{{ number_format($total) }}원</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">할인금액</th>
                                        <td><span id="discount-sum">0</span>원</td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="total">최종결제금액</th>
                                        <td class="total"><span class="total_pay">{{ number_format($total) }}</span>원
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <label for="pay-method" class="method-label">결제방법</label>

                                <!-- name="LGD_CUSTOM_FIRSTPAY" -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="LGD_CUSTOM_USABLEPAY"
                                           id="pay-method1" value="SC0010">
                                    <label class="form-check-label" for="pay-method1">
                                        신용카드
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="LGD_CUSTOM_USABLEPAY"
                                           id="pay-method2" value="SC0030">
                                    <label class="form-check-label" for="pay-method2">
                                        실시간 계좌이체
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="LGD_CUSTOM_USABLEPAY"
                                           id="pay-method3" value="SC0040">
                                    <label class="form-check-label" for="pay-method3">
                                        무통장 입금(가상계좌) - 가상계좌는 5일간 유효합니다.
                                    </label>
                                </div>

                                <div class="btn-wrap btn-2">
                                    <button type="button" class="btn btn-prev" style='cursor:pointer' onclick="location.href=''">
                                        이전으로
                                    </button>
                                    <button type="button" class="btn btn-pay" onclick="payment()" style='cursor:pointer'>결제하기</button>
                                </div>
                            </div>
                        </div>

                        <!-- 쿠폰등록 팝업 -->
                        <div class="ncs-popup-wrap">
                            <div class="s2_popup01 popup-style1" style="display: none;">
                                <div class="popup-content">
                                    <h3 class="popup-tit">사용가능 할인 코드 <span class="num">(<span
                                                id="used_num">0</span>)</span></h3>
                                    <div class="popup-txt">
                                        <table class="t_style38">
                                            <thead>
                                            <tr>
                                                <th scope="col" width="*">할인코드명</th>
                                                <th scope="col" width="10%">할인율</th>
                                                <th scope="col" width="*">할인코드</th>
                                                <th scope="col" width="20%">사용 기한</th>
                                            </tr>
                                            </thead>
                                            <tbody id="coupon_info">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn" type="button" style="cursor:pointer" onclick="chk_cp_id()">
                                            사용하기
                                        </button>
                                    </div>
                                    <button class="close" style="cursor:pointer">닫기</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- id="section" -->
    </form>
@endsection

@push('body_scripts')
    <script>
        function chk_cp_id() {
            var cp_id = $('input[name="cp_id"]:checked').val();
            var course_id = 1; //$('#cos_id_arr-'+cp_id).val();
            var discount = $('#coup_discnt-' + cp_id).val();

            var total = 1;
            var total_pay = parseInt(total) - parseInt(discount);


            if (total_pay < 0) total_pay = 0;

            $("#coupon_num").val(cp_id);  //할인코드번호
            $("#discount").html(AddCommas(discount)); //할인금액 계산
            $("#discount2").val(discount); //할인금액 hidden 값
            $(".total_pay").html(AddCommas(total_pay)); //결재금액, 최종결재금액

            $("#LGD_AMOUNT").val(total_pay); //LGD_AMOUNT 값
            $("#total").val(total_pay); //total hiden값

            $('#discount-sum').html(AddCommas(discount)); //할인금액 합계

            $('.s2_popup01').fadeOut();

            $("html").css("position", "static");
            posY = $(window).scrollTop();
            posY = $(window).scrollTop(posY);

        }

        function AddCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function payment() {

        }
    </script>
@endpush
