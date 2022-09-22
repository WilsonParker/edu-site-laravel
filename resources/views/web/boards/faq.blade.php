@extends('web.layouts.app')
@inject('baseViewModel', "LaravelSupports\ViewModels\BaseViewModel")
@inject('baseComponent', "LaravelSupports\Views\Components\BaseComponent")
@push('first_styles')
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
@endpush
@section('content')
    <div id="section">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>학습지원센터</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>자주하는질문(FAQ)</span>@include('web.boards.sub_menu_board')/li>
            </ul>
        </div>
        <div class="sub_content">
            <div class="faq_box">
                <ul class="sub_tab02">
                    @foreach($categories as $item)
                        <li class="{{ $item->code == $selectedCategory?->name ? 'on' : ''}}">
                            <a href=" {{ route('board.index', ['code' => $item->code, 'type'=>'faq']) }}">{{$item->name}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="sub_title"><h4 class="tit02">{{ $selectedCategory?->name }}</h4></div>
                <div class="faq_list">
                    @foreach($data as $item)
                        <div class="faq_con">
                            <div class="faq_q"><span class="q">Q</span>{{ $item->title }}</div>
                            <div class="faq_a"><span class="a">A</span>{!! $item->contents !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
