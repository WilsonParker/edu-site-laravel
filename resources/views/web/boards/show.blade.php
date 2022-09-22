@extends('web.layouts.app')
@section('content')
    <div id="section" class="page-news">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>학습지원센터</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>공지사항</span>@include('web.boards.sub_menu_board')/li>
            </ul>
        </div>
        <div class="sub_banner">
            <div class="top_banner">
                <div class="txt">
                    <h2>학습지원센터</h2>
                    <p>이러닝 원격교육원에서 궁금증을 해결해드리겠습니다!</p>
                </div>
            </div>
            <h3>공지사항(보기)</h3>
        </div>
        <div class="sub_content">
            <table class="t_style32">
                <caption>공지사항 게시글 보기 : 번호, 제목, 조회수, 작성일 등 정보제공</caption>
                <thead class="view">
                <tr>
                    <th class="view_tit">{{ $data->title }}</th>
                    <th class="name">관리자</th>
                    <th class="day">{{ substr($data->created_at,0,10) }}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="3" class="view_con">
                        <div class="view_txt">
                            {!! $data->contents !!}
                        </div>
                        @if(isset($data->file_idx))
                            <div class="view_down">
                                <div class="left">첨부파일</div>
                                <div class="right">
                                    <p>
                                        <a href="{{ route('board.download',['path'=>$data->resource->path.'/'.$data->resource->name]) }}">{{ $data->resource->origin_name }}</a>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="btn_box02"><a href="javascript:history.back()" class="btn_type01">목록</a></div>
        </div>
    </div>
@endsection

