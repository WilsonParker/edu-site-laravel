@extends('web.layouts.app')

@php
  $examStatus = \App\Models\Lectures\ExamStatus::from($exam->exam_status_code);
@endphp

@push('styles')
    <link rel="stylesheet" href="/css/popup.css"/>
@endpush

@section('content')
    <div id="wrap">
        <div class="pop_tit02"><h2>
                {{ \App\Models\Lectures\ExamKind::from($type)->text() }}[{{ $examStatus->taskText() }}]</h2></div>
        <div class="pop_user">
            <table class="t_style15">
                <tr>
                    <th>성명</th>
                    <td>{{ $member->memberInformation->name }}</td>
                </tr>
                <tr>
                    <th>접속IP</th>
                    <td>{{ $ip }}</td>
                </tr>
                <tr>
                    <th>제출 시작시간</th>
                    <td>{{ $exam->start }}</td>
                </tr>
                <tr>
                    <th>제출 완료시간</th>
                    <td>{{ $exam->end }}</td>
                </tr>
            </table>
        </div>

        <div class="pop_homework">
            <form method="post" enctype="multipart/form-data" name="frm" id="frm">
                <table class="t_style16">
                    <tr>
                        <th>과제선택</th>
                        <td>과제파일로 첨부하거나 과제를 직접 입력하시면 됩니다.</td>
                    </tr>

                    <tr>
                        <th>과제</th>
                        <td>{!! $data->exam->contents !!}</td>
                    </tr>
                    <tr>
                    @isset($data->exam->attachment)
                        <th>첨부파일</th>
                        <td><a href="{{ route('download', $data->exam->attachment) }}">{{ $data->exam->attachment->origin_name }}</a></td>
                    </tr>
                    @endisset
                    <tr>
                        <th>과제파일</th>
                        <td>
                            @if(!$exam->showCommentary())
                            <input type="file" name="file" id="file"/>
                            (pdf,doc,hwp,xls,xlsx,docx,ppt,pptx,zip)
                            @endif
                            @isset($data->attachment)
                            제출된 파일 : <a href="{{ route('download', $data->attachment) }}">{{ $data->attachment->origin_name }}</a>
                            @endisset
                        </td>
                    </tr>
                    <tr>
                        @if($examStatus == \App\Models\Lectures\ExamStatus::COMPLETE)
                            <th>제출내용</th>
                        @else
                            <th>과제내용</th>
                        @endif
                        <td>
                            <textarea name="answer" id="homework" placeholder="과제 내용을 입력하세요."
                                      @if($exam->showCommentary())
                                          readonly
                                      @endif
                            >{!! $data->answer !!}</textarea>
                        </td>
                    </tr>

                    @if($exam->isComplete())
                        <tr>
                            <th>해설 및 채점기준</th>
                            <td>
                                {!! $data->exam->answer !!}
                            </td>
                        </tr>
                        <tr>
                            <th>첨삭내용</th>
                            <td>
                                {!! $data->correction !!}
                            </td>
                        </tr>
                    @endif
                </table>
            </form>

            <div class="pop_btn_box">
            @if($exam->showCommentary())
                <span><input type="button" value="창닫기" class="pop_btn04" onClick="self.close();" /></span>
            @else
                <span class="mr4"><input type="button" value="임시제출" onClick="saveTemporary()" class="pop_btn05" /></span>
                <span><input type="button" value="과제제출" class="pop_btn04" onClick="submit()" /></span>
            @endif
            </div>
        </div>
    </div><!-- id="wrap" -->
@endsection

@push('body_scripts')
    <script>
        function saveTemporary() {
            modal.confirm("과제를 임시제출 하시겠습니까?<br/> 제출된 과제는 종료일 전에 제출하셔야 합니다.", () => {
                modal.hide();
                store($('#homework').val());
            });
        }

        function store(value) {
            let frm = $('#frm');
            let formData = new FormData(frm[0]);
            // formData.append('file', this.file);
            formData.append('page', '{{ $data->sort }}');
            formData.append('answer', value);

            axios.post('{{ route("lectures.exams.exam", ['type' => $type, 'program' => $program ]) }}', formData
            ).then(function (result) {
            }).catch(function (error) {
                modal.error(error);
            });
        }

        function submit() {
            modal.confirm("시험을 제출 하시겠습니까?<br/> 제출된 답안은 수정제출이 불가능합니다.", () => {
                window.location.href = "{{ route("lectures.exams.submit", ['type' => $type, 'program' => $program ]) }}";
            });
        }
    </script>
@endpush
