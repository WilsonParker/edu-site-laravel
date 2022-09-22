@extends('web.layouts.app')
@inject('baseViewModel', "LaravelSupports\ViewModels\BaseViewModel")
@inject('baseComponent', "LaravelSupports\Views\Components\BaseComponent")
@push('first_styles')
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
@endpush
@section('content')
    <div id="section" class="page-news">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>학습지원센터</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>{{ $selectedCategory?->name ?? '공지사항' }}</span>@include('web.boards.sub_menu_board')</li>
            </ul>
        </div>
        <div class="sub_content">
            <ul class="sub_tab02">
                <li class=""><a href="{{ route('board.index') }}">전체</a></li>
                @foreach($categories as $item)
                    <li class="{{ $item->code == $selectedCategory?->name ? 'on' : ''}}">
                        <a href=" {{ route('board.index', ['code' => $item->code]) }}">{{$item->name}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="search_box">
                <form method="GET" action="">
                    @foreach($search as $key => $values)
                        <select name="{{ $baseComponent::KEY_SEARCH }}" id="search">
                            @foreach($values[$baseViewModel::KEY_SEARCH_VALUES] as $itemKey => $itemValue)
                                <option value="{{ $itemKey }}"
                                        @if(isset($searchData[$key]))
                                        @if($searchData[$key] == $itemKey)
                                        selected
                                    @endif
                                    @endif
                                >{{ $itemValue }}</option>
                            @endforeach
                            @endforeach
                        </select>
                        <input type="search" name="keyword" type="keyword" placeholder="검색어를 입력하세요." value=""/>
                        <button>
                            <x-image src="images/common/icon_search.png" alt="검색" attribute="class=btn-search"/>
                        </button>
                </form>
            </div>
            <table class="t_style32">
                <thead>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>조회</th>
                    <th>작성일</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td class="num" {{$item->is_notice=='1'?'style=color:red':''}}>{{ $item->is_notice=='1'?'공지':$item->idx }}</td>
                        <td class="tit"><a
                                href="{{ route('board.show', ['board'=>$item->idx]) }}">{{ $item->title }}</a></td>
                        <td class="name">{{ $item->views }} </td>
                        <td class="day">{{ $item->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pager_box_boot">
                {{ $data->appends($searchData)->links() }}
            </div>
        </div>
    </div>
@endsection
