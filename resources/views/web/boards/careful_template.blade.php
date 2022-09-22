@extends('web.layouts.app')

@section('content')
    <div id="section" class="page-news">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>학습지원센터</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>{{ $subTitle?? '학습유의사항' }}</span>
                    <ul>
                        <li><a href="{{ route('board.manual') }}">학습매뉴얼<span style="font-size:10px; color:blue;">   (다운로드)</span></a>
                        </li>
                        <li><a href="{{ route('board.careful.index') }}">학습유의사항</a></li>
                        <li><a href="{{ route('board.careful.2') }}">학습환경설정</a></li>
                        <li><a href="{{ route('board.careful.3') }}">필수프로그램</a></li>
                        <li><a href="{{ route('board.careful.4') }}">모사방지시스템 운영기준</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        @yield('sub_content')
    </div>
@endsection
