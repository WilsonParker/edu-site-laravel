@extends('web.layouts.app')

@section('content')
    <div id="section">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>NCS 직업교육 가이드</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>NCS 직업교육 신청 방법</span>
                    <ul>
                        <li><a href="{{ route('board.ncs_guide', ['board'=>5]) }}">NCS 직업교육 신청 방법</a></li>
                        <li><a href="{{ route('board.index', ['code'=>'guide']) }}">기업별 직업교육 가이드</a></li>
                        <li><a href="{{ route('board.index', ['code'=>'ncs_faq']) }}">NCS 직업교육 FAQ</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- class="sub_navi" -->

        <div class="sub_banner sub_content">

            <h3>NCS 직업교육 신청 방법</h3>

            <div class="sub_content">

                <table class="t_style32">
                    <thead class="view">
                    <tr>
                        <th class="view_tit">{{ $data->title }}</th>
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
            </div>
        </div>
@endsection
