@extends('web.layouts.app')

@section('content')
    <div id="section" class="page-news">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>학습지원센터</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>1:1상담</span>@include('web.boards.sub_menu_board')/li>
            </ul>
        </div>
        <div class="sub_banner">
            <div class="top_banner">
                <div class="txt">
                    <h2>학습지원센터</h2>
                    <p>이러닝 원격교육원에서 궁금증을 해결해드리겠습니다!</p>
                </div>
            </div>
            <h3>1:1상담</h3>
        </div>
        <div class="sub_content">
            <table class="t_style32">
                <thead class="view">
                <tr>
                    <th class="view_tit">{{ $data->title }}</th>
                    <th class="name">
                        {{ match ($data->step) {
                            'ready'=> '대기',
                            'continue' => '진행중',
                            default => '완료',
                        } }}
                    </th>
                    <th class="day">{{ substr($data->created_at,0,10) }}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="3" class="view_con">
                        <div class="view_txt">
                            {{ $data->contents }}
                        </div>
                        @if(isset($answer))
                            <br><br>
                            -------------------------------------답변입니다.---------------------------------------------------
                            <br><br>
                            {{ $answer->contents }}
                        @endif
                        @isset($data->resource)
                            <div class="view_down">
                                <div class="left">첨부파일</div>
                                <div class="right">
                                    <p>
                                        <a href="{{ route('download',['resource'=>$data->resource]) }}">{{ $data->resource->origin_name }}</a>
                                    </p>
                                </div>
                            </div>
                        @endisset
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="btn_box02">
                <form method="post" action="{{ route('qna.destroy',['qna'=>$data]) }}">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('qna.index') }}" class="btn_type01">목록</a>
                    <a href="{{ route('qna.edit', ['qna'=>$data]) }}" class="btn_type01">수정</a>

                    @if($data->step=='ready')
                        <button class="btn_type01" type="submit"
                                onClick="return Really();">삭제
                        </button>
                    @else
                        <a href="javascript:alert('삭제는 신청(대기)상태에서만 가능합니다.');" class="btn_type01">삭제</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
