@extends('web.members.lectures.info_template')

@section('page_content')
    <div class="sub_content">
        <div class="table-responsive">
            <table class="t_style37">
                <tr>
                    <th>강의명</th>
                    <th>교육기간</th>
                    <th>진도율</th>
                    <th>진행단계평가</th>
                    <th>시험</th>
                    <th>과제</th>
                    <th>총점</th>
                    <th>수료여부</th>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->getTitle() }}</td>
                        <td>{{ $formatDefaultDate($item->pivot->learning_start_date) }} ~ {{ $formatDefaultDate($item->pivot->learning_end_date) }}</td>
                        <td>0%</td>
                        <td>미제출</td>
                        <td>미제출</td>
                        <td>미대상</td>
                        <td>0/100</td>
                        <td>수료, 수료증발급</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
