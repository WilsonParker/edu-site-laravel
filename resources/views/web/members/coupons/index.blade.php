@extends('web.layouts.app')

@push('styles')
    <style>
        .tab_wrap ul.tab_container li{}
        .red {
            color: red;
        }
    </style>
@endpush
@section('content')
    <div id="coupon-section" class="page-coupon ncs-payment">
        <div class="section01 container">
            <div class="inner">
                <div class="payment-box ncs-discount">
                    <h3 class="title">쿠폰코드 입력</h3>
                    <form action="{{ route('members.coupons.use') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="code" class="form-control" placeholder="쿠폰코드" aria-label="쿠폰코드" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn p-show" type="submit" id="button-addon1" style="cursor:pointer">쿠폰등록</button>
                            </div>
                        </div>
                    </form>
                    <small>* 쿠폰번호가 16자리인 경우, 반드시 <span class="red">하이픈(-)까지 입력</span> 을 해주셔야 합니다.</small>
                    <small>
                        * 콘텐츠 지급 쿠폰의 경우, <span class="red">쿠폰을 등록하는 즉시 수강이 시작</span>됩니다.<br/>
                        &nbsp;(※ <span class="red">등록일로부터 30일 이내 수강 및 수료요건 충족</span> 필수)
                    </small>
                    <small>* 지급된 강의는 [내 강의실] > [학습중인 강의]에서 확인 가능합니다.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('body_scripts')
    <script>
    </script>
@endpush

