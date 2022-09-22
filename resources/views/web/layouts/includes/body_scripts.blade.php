<script src="{{ asset('/js/bootstrap/bootstrap.min.js') }}"></script>
{{--<script src="https://js.pusher.com/7.0/pusher.min.js"></script>--}}

{{--<script src="{{ asset('js/addon/videoHelper.js')}}"></script>--}}
<script src="{{ asset('js/common.js')}}"></script>
<script>
    /*
    * 에러 발생 시 alert 실행
    * */
    $(function () {
        @if($errors->any())
        modal.init('componentModal');
        modal.setContent("{!! $errors->first() !!}");
        modal.show();
        @endif

        @if (session()->has('message'))
        modal.init('componentModal');
        modal.setContent("{!! session()->get('message') !!}");
        modal.show();
        @endif
    });
</script>
@stack('body_scripts')
