@extends('web.layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/popup.css"/>
@endpush

@section('content')
    <div id="wrap">
        <div class="pop_tit02"><h2>
                {{ \App\Models\Lectures\ExamKind::from($type)->text() }}[{{ $exam->exam_status_code == \App\Models\Lectures\ExamStatus::COMPLETE->value ? '결과보기' : '시험응시' }}]</h2></div>
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
                    <th>시험 시작시간</th>
                    <td>{{ $exam->start }}</td>
                </tr>
                <tr>
                    <th>시험 종료시간</th>
                    <td>{{ $exam->end }}</td>
                </tr>
            </table>
        </div>

        <div class="pop_test">
            <div class="test_box">
                <p class="test_ask">문제 {{ $data->sort }}. {!! $data->exam->contents !!}
                    &nbsp;
                    @if($exam->showCommentary())
                        @if($data->answer == $data->answer)
                        <span style='color:blue'>[O]</span>
                        @else
                        <span style='color:red'>[X]</span>
                        @endif
                    @endif
                    &nbsp;
                </p>
                <ul class="test_radio">
                    @if($checkType([\App\Models\Lectures\ExamType::MULTIPLE, \App\Models\Lectures\ExamType::AUTHENTIC]))
                    <li>
                        <label>
                            <input type="radio" class="question" name="question" value="1" {{ $data->answer == 1 ? 'checked' : ''  }} />
                            1. {{ $data->exam->first_question }}
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" class="question" name="question" value="2" {{ $data->answer == 2 ? 'checked' : ''  }} />
                            2. {{ $data->exam->second_question }}
                        </label>
                    </li>
                    @endif

                    @if($checkType(\App\Models\Lectures\ExamType::MULTIPLE))
                        <li>
                            <label>
                                <input type="radio" class="question" name="question" value="3" {{ $data->answer == 3 ? 'checked' : ''  }} />
                                3. {{ $data->exam->third_question }}
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" class="question" name="question" value="4" {{ $data->answer == 4 ? 'checked' : ''  }} />
                                4. {{ $data->exam->fourth_question }}
                            </label>
                        </li>
                    @endif
                </ul>

                @if($checkType(\App\Models\Lectures\ExamType::SHORT))
                    <p><input type="text" name="question" id ="question" class="answer_txt question" placeholder="여기에 답을 입력하세요." value="{{ $data->answer }}" /></p>
                @endif

                @if($checkType(\App\Models\Lectures\ExamType::SUBJECTIVE))
                    <p><textarea name="question" id ="question" placeholder="여기에 답을 입력하세요."  class="answer_area question" >{{ $data->answer }}</textarea></p>
                @endif

                @if($exam->isComplete())
                    <p class="test_ask">정답 {{ $data->exam->answer }} (제출답안 :  {{ $data->answer }})</p>
                    <p class="test_ask">해설내용(채점기준) {!! $data->exam->explanation !!}</p>
                    @isset($data->correction)
                        <p class="test_ask">첨삭내용 :  {!! $data->correction !!}</p>
                    @endif
                @endif
            </div>
        </div>

        <div class="pop_bottom">
            <p class="tit">총 <b class="emp">{{ $examCount }}</b>문제 중 <b class="emp">{{ $data->sort }}</b>번 문제를 풀고
                계십니다.</p>
            <div class="pop_btn_box02">
                <div class="pop_btn_left">
                    @if($data->sort > 1)
                        <span class="mr4"><input type="button" value="이전문제" class="pop_btn02" onclick="location.href='{{ route('lectures.exams.exam', ['program' => $program, 'type' => $type, 'page' => $data->sort - 1]) }}'"/></span>
                    @endif
                    @if($data->sort < $examCount)
                        <span><input type="button" value="다음문제" class="pop_btn03" onclick="location.href='{{ route('lectures.exams.exam', ['program' => $program, 'type' => $type, 'page' => $data->sort + 1]) }}'"/></span>
                    @endif
                    @if($checkType(\App\Models\Lectures\ExamType::SUBJECTIVE, \App\Models\Lectures\ExamType::SHORT))
                        <span><input type="button" value="임시 저장" class="pop_btn03" onclick="storeTrigger()"/></span>
                    @endif
                </div>

                @if(!$exam->showCommentary())
                    <div class="pop_btn_right">
                        <input type="button" value="제출하기" class="pop_btn04" onclick="submit()"/>
                    </div>
                @endif
            </div>
        </div>
    </div><!-- id="wrap" -->
@endsection

@push('body_scripts')
    <script>
        $(function () {
            let code = "{{ $checkType([\App\Models\Lectures\ExamType::SHORT, \App\Models\Lectures\ExamType::SUBJECTIVE]) ? '' : 'click'}}";

            $('.question').on(code, function () {
                if({{$exam->isComplete() ? 1 : 0}}) {
                    return false;
                } else {
                    store(this.value);
                }
            })
        })

        function storeTrigger() {
            store($('.question').val(), true);
        }

        function store(value, show = false) {
            axios.post('{{ route("lectures.exams.exam", ['type' => $type, 'program' => $program ]) }}', {
                page: '{{ $data->sort }}',
                answer: value,
            }).then(function (result) {
                if(show) {
                    modal.setContent(result.data.message);
                    modal.show();
                }
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
