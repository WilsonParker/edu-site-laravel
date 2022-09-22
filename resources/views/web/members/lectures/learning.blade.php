@extends('web.members.lectures.info_template')

@section('page_content')
    <div class="sub_content">
        <div class="table-responsive">
            <table class="t_style37">
                <tr>
                    <th>No.</th>
                    <th>강의명</th>
                    <th>교육기간</th>
                    <th>진도율</th>
                    <th>진행단계평가</th>
                    <th>시험</th>
                    <th>과제</th>
                    <th>총점</th>
                    <th>학습</th>
                </tr>
                @foreach($data as $item)
                    @php
                        $setMemberLectureProgramModel($item);
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1}}</td>
                        <td>{{ $item->lectureProgram->getTitle() }}</td>
                        <td>{{ $formatDefaultDate($item->learning_start_date) }} ~ {{ $formatDefaultDate($item->learning_end_date) }}</td>
                        <td>{{ $item->rate }}%</td>
                        <td>{{ $getMiddleExamText }}</td>
                        <td>{{ $getFinalExamText }}</td>
                        <td>{{ $getTaskExamText }}</td>
                        <td>0/100</td>
                        <td><a href="{{ route('members.lectures.detail', $item) }}" class="font-dblue01 font17"><span class="text_icon01">학습하기</span></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
