<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('web.layouts.includes.meta')

    <title>{{ config('constants.web.title', 'Laravel') }}</title>

    @include('web.layouts.includes.styles')
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
    @include('web.layouts.includes.scripts')
</head>
<body>
<div id="app" style="background: white">
    <div id="ncs-wrap" class="page-payment">
        <div class="header-new">
            <div class="logo">
                <x-image src="images/sub/ncs/logo-copy@2x.png" alt="" attribute='style="width:100%"'/>
            </div>
        </div>

        <div id="ncs-section" class="ncs-payment">
            <div class="inner">
                <div class="ncs-cont-wrap">
                    <div class="ncs-cont">
                        <div class="title-area">
                            <h1 class="main-title">수강신청 정보 @yield('sub_title')</h1>
                        </div>
                        <div class="content-area">
                            @yield('content')
                        </div>

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
{{--                            <p>추천인 코드 또는 할인 쿠폰 번호를 입력해주세요. 등록 후 중복 사용은 불가합니다.</p>--}}
                            <p>할인 쿠폰 번호를 입력해주세요.</p>

                            <div class="input-group">
                                <input type="text" name="coupon_num" id="coupon_num" class="form-control"
                                       placeholder="할인 코드" aria-label="할인 코드" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn img01" type="button" id="button-addon1" style="cursor:pointer">등록</button>
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

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" id="method_card" value="card"
                                       checked>
                                <label class="form-check-label" for="pay-method_card">신용카드</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" id="method_trans" value="trans">
                                <label class="form-check-label" for="method_trans">실시간 계좌이체</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="method" id="method_vbank" value="vbank">
                                <label class="form-check-label" for="method_vbank">무통장 입금(가상계좌)</label>
                            </div>

                            <div class="btn-wrap btn-2">
                                <button type="button" class="btn btn-prev" style='cursor:pointer'
                                        onclick="history.back()">이전으로
                                </button>
                                <button type="button" class="btn btn-pay" onclick="payment()" style='cursor:pointer'>
                                    결제하기
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('web.layouts.includes.footer')
    </div>
</div>
@include('web.layouts.includes.modal')
@include('web.layouts.includes.body_scripts')
<!-- iamport.payment.js -->
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.2.0.js"></script>
<script>
    $(function () {
        const IMP = window.IMP; // 생략 가능
        IMP.init("{{ config('constants.payment.iamport.key') }}"); // Example: imp00000000
    })

    function getMethod() {
        return $('input[name="method"]:checked').val();
    }

    function isAgree(selector) {
        let agree = $(selector).val();
        if(agree !== 'Y') {
            modal.setContent('신청동의를 선택해 주세요');
            modal.show();
            return false;
        }
        return true;
    }
</script>
</body>
</html>
