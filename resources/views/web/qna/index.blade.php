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
                <li><span>1:1상담</span>@include('web.boards.sub_menu_board')</li>
            </ul>
        </div>
    </div>

    <div class="sub_content">
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
                <th>상태</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td class="num">{{ $loop->remaining + 1}}</td>
                    <td class="tit"><a href="{{ route('qna.show',['qna'=>$item->idx]) }}">{{ $item->title }}</a></td>
                    <td><input type="button" class="text_icon03" style="height: 27px"
                               value=" {{
                               match ($item->step) {
                                   'ready' => '대기',
                                   'continue' => '진행중',
                                   default => '완료',
                               }
                            }}"/></td>
                    <td class="name">{{ $item->member->id }}</td>
                    <td class="day">{{ $formatDefaultDate($item->created_at) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="btn_box02"><a href="{{ route('qna.create') }}" class="btn_type01">글쓰기</a></div>
        <div class="pager_box_boot">
            {{ $data->appends($searchData)->links() }}
        </div>
    </div>
@endsection
