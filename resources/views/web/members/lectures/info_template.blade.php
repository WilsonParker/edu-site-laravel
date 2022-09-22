@extends('web.members.index_template')

@section('bottom_banner')
    <font size=+2>{{ $member->memberInformation->name }}</font>님 환영합니다. 본인이 아니신경우 02-6953-3893 로 연락바랍니다.  대리수강은 처벌대상이 됩니다.
    <p> {{ $ip }} IP에서 (접속시간)에 접속하였습니다.</p>
    <p>부정훈련 모니터링중</p>
@endsection
@section('sub_content')
    @yield('page_content')
@endsection
