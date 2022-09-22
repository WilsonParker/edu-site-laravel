@extends('web.lectures.payments.template')

@section('content')
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
            <td>{{ $formatDefaultDate(now()) }}~ {{ $formatDefaultDate($data->getLearningEndDate()) }}</td>
        </tr>
        <tr>
            <th scope="row">복습기간</th>
            <td>{{ $formatDefaultDate($data->getReviewStartDate()) }}~ {{ $formatDefaultDate($data->getReviewEndDate()) }}</td>
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
            if (isAgree('input[name="agree"]:checked')) {
                axios({
                    url: "{{ route('lectures.payments.ready', ['idx' => [ $data->idx ]]) }}",
                    method: 'post',
                    data: {
                        method: getMethod()
                    }
                }).then((result) => {
                    let arr = [
                        'pg',
                        'pay_method',
                        'merchant_uid',
                        'name',
                        'amount',
                        'buyer_email',
                        'buyer_name',
                        'buyer_tel',
                        'buyer_addr',
                        'buyer_postcode',
                    ];
                    let data = arr.reduce(function (target, key, index) {
                        target[key] = result.data.data[key];
                        return target;
                    }, {}) //initial empty object

                    IMP.request_pay(data, function (rsp) { // callback
                        console.log(rsp);
                        if (rsp.success) {
                            axios({
                                url: "{{ route('lectures.payments.paid') }}",
                                method: 'post',
                                data: {
                                    request_id: rsp.merchant_uid,
                                    unique_id: rsp.imp_uid,
                                    name: rsp.name,
                                    price: rsp.paid_amount,
                                    method: rsp.pay_method,
                                    pg_provider: rsp.pg_provider,
                                    pg_unique_id: rsp.pg_tid,
                                    receipt_url: rsp.receipt_url,
                                    buyer_address: rsp.buyer_addr,
                                    buyer_email: rsp.buyer_email,
                                    buyer_name: rsp.buyer_name,
                                    buyer_postcode: rsp.buyer_postcode,
                                    buyer_contact: rsp.buyer_tel,
                                    bank_name: rsp.bank_name,
                                    card_approval: rsp.apply_num,
                                    card_name: rsp.card_name,
                                    card_number: rsp.card_number,
                                    card_quota: rsp.card_quota,
                                    vbank_date: rsp.vbank_date,
                                    vbank_holder: rsp.vbank_holder,
                                    vbank_name: rsp.vbank_name,
                                    vbank_num: rsp.vbank_num,
                                }
                            }).then((result) => {
                                console.log(result);
                                // location.href = "{{ route('members.lectures.learning') }}";
                            }).catch((error) => {
                                modal.setContent(error.response.data.message);
                                modal.show();
                            });
                        } else {
                            modal.setContent(rsp.error_msg);
                            modal.show();
                        }
                    });
                }).catch((error) => {
                    modal.setContent(error.response.data.message);
                    modal.show();
                });
            }
        }
    </script>
@endpush
