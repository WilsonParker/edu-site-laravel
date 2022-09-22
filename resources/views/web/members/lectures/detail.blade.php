@extends('web.members.lectures.info_template')

@section('top_banner')
    <div class="top_banner">
        <div class="txt">
            <h2>내강의실</h2>
            <p>edu-site-laravel에 오신 것을 환영합니다!</p>
        </div>
    </div>
@endSection

@section('bottom_banner')
    <p>부정훈련 모니터링중 [{{ $ip }}]</p>
    <br/>
    <span style="color:red">※ 부정훈련은 {{ config('constants.web.contact') }} 또는 1:1문의로 신고 바랍니다.</span>
@endsection

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
                </tr>
                <tr>
                    <td class="tit">{{ $data->lectureProgram->getDetailTitle() }}</td>
                    <td>
                        <span>{{ $formatDefaultDate($data->lectureProgram->getLearningStartDate()) }} ~ {{ $formatDefaultDate($data->lectureProgram->getLearningEndDate()) }}</span>
                    </td>
                    <td>{{ $data->lectureProgram->rate }}%</td>
                    <td>{{ $getMiddleExamText }}</td>
                    <td>{{ $getFinalExamText }}</td>
                    <td>{{ $getTaskExamText }}</td>
                    <td><span>{{ 1 }}</span>/<span>100</span></td>
                </tr>
            </table>
        </div>

        <div class="detail_info">
            <div class="detail_left">
                <table class="t_style13">
                    <tr class="top_tit">
                        <th colspan="5">수료기준</th>
                    </tr>
                    <tr>
                        <th>수강정원</th>
                        <th>총 진도율</th>
                        <th>중간평가</th>
                        <th>최종평가</th>
                        <th>과제</th>
                    </tr>
                    <tr>
                        <td rowspan="2"><span class="emp">{{ number_format($data->lectureProgram->limit) }}명</span></td>
                        <td rowspan="2"><span class="emp2">80%이상</span></td>
                        <td>
                            <b>0</b>점 이상 / 평가비율 <b>{{ number_format($data->lectureProgram->lecture->evaluation_reflection_rate) }}</b>% 반영
                        </td>
                        <td>
                            <b>0</b>점 이상 / 평가비율 <b>{{ number_format($data->lectureProgram->lecture->exam_reflection_rate) }}</b>% 반영
                        </td>
                        <td>
                            <b>0</b>점 이상 / 평가비율 <b>{{ number_format($data->lectureProgram->lecture->problem_reflection_rate) }}</b>% 반영
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">반영된 평가 합산 <b>60</b>점 이상</td>
                    </tr>
                </table>
            </div>

            <div class="detail_right">
                <span><a href="#" onclick="openDetail()"><x-image src="/images/sub/mypage/myclass_detail_icon01.png" alt="교육과정 상세보기"/></a></span>
                <span><a href="#" onclick="openVote()" class="popup_window"><x-image src="/images/sub/mypage/myclass_detail_icon02.png" alt="설문조사 참여하기"/></a></span>
            </div>

            {{--
            /**
             * @todo
             * 마지막 진도 내역 처리
             * @author  dev9163
             * @added   2022/01/04
             * @updated 2022/01/04
             */
           --}}
            {{--<div
                style='border-right:1px solid #dfdfdf; border-left:1px solid #dfdfdf; border-bottom:1px solid #dfdfdf; font-size:12px; font-weight:bold; text-align:center; margin-top:10px; line-height: 3.3em; clear:both'>
				<span>
					<strong style='color:#3300ff'>※ 진도이력&nbsp;&nbsp;&nbsp;&nbsp; 마지막 진도 페이지 : <span>{{ 1 }} 차시 {{ 1 }} 페이지</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                            style='color:red'>(학습페이지 이동후 10초이상 수강해야 이어보기가 가능합니다.)</span></strong>
				</span>
            </div>--}}
        </div>

        {{--if($row[goyong_yn]!="0" || $row[gubun_yn]!="2"){--}}

        <div class="detail_info2">
            <ul>
                @if($hasMiddleExam)
                    <li>
                        <div class="detail_icon">
                            <div class="icon">
                                <x-image src="/images/sub/mypage/myclass_detail_icon03.png" alt=""/>
                            </div>
                            <div class="con">
                                <p class="tit">중간평가 <b><x-new-tab href="{{ route('lectures.exams.agree', ['program' => $data, 'type' => \App\Models\Lectures\ExamKind::MIDDLE->value]) }}" attribute="class=popup_window">응시하기</x-new-tab></b></p>
                            </div>
                        </div>
                    </li>
                @endif

                @if($hasFinalExam)
                    <li>
                        <div class="detail_icon">
                            <div class="icon">
                                <x-image src="/images/sub/mypage/myclass_detail_icon04.png" alt=""/>
                            </div>
                            <div class="con">
                                <p class="tit">최종평가 <b><x-new-tab href="{{ route('lectures.exams.agree', ['program' => $data, 'type' => \App\Models\Lectures\ExamKind::FINAL->value]) }}" attribute="class=popup_window">응시하기</x-new-tab></b></p>
                            </div>
                        </div>
                    </li>
                @endif

                @if($hasTaskExam)
                    <li>
                        <div class="detail_icon">
                            <div class="icon">
                                <x-image src="/images/sub/mypage/myclass_detail_icon05.png" alt=""/>
                            </div>
                            <div class="con">
                                <p class="tit">과제 <b><x-new-tab href="{{ route('lectures.exams.agree', ['program' => $data, 'type' => \App\Models\Lectures\ExamKind::TASK->value]) }}" attribute="class=popup_window">제출하기</x-new-tab></b></p>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

        <div class="detail_list tab_box sub_tab">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#lectures">내강의실</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#consulting">1:1상담</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#reference">학습자료실</a>
                </li>
            </ul>

            <div class="con_box tab-pane fade show active" id="lectures">
                <ul class="detail_con mb20">
                    @php
                        $isPlayable = true;
                        $classCount = $data->getClassCount();
                        $middleCount = $data->getMiddleClassNumber() - 1;
                    @endphp
                    @foreach($data->lectureProgram->lecture->classes as $item)
                    <li>
                        <div class="num">{{ $item->number }}차시</div>
                        <div class="txt">
                            <p class="tit">{{ $item->title }}</p>
                            <p>교육이수 시간 : <span></span></p>
                            <p>총 교육시간 : <span>{{ $getTotalTimeText($item->totalTime) }}</span></p>
                        </div>
                        <div><b class="font18">{{ $item->rate }}%</b></div>
                        <div>
                            @if($isPlayable)
                            <x-new-tab href="{{ route('members.lectures.before.play', ['program' => $data, 'class' => $item]) }}" attribute="class=detail_btn popup_window">학습하기</x-new-tab>
                            @endif
                        </div>
                    </li>
                    @php
                        $isPlayable = $item->rate == 100;
                    @endphp
                        @if($hasMiddleExam && $loop->index == $middleCount)
                            @php($middleExam = $data->getMemberLectureMiddleExam())
                            <li>
                                <div class="num02">평가</div>
                                <div class="txt">
                                    <p class="tit">진행단계평가</p>
                                    <p>시험시간 : <span>{{ $getExamTimeText($middleExam) }}</span></p>
                                    <p>응시아이피 : <span>{{ $middleExam?->ip }}</span></p>
                                </div>
                                <div><b class="font18">{{ $getExamStatusText($middleExam) }}</b></div>
                                <div>
                                    @if($isPlayable)
                                    <x-new-tab href="{{ route('lectures.exams.agree', ['program' => $data, 'type' => \App\Models\Lectures\ExamKind::MIDDLE->value]) }}" attribute="class=detail_btn02 popup_window">평가응시</x-new-tab>
                                    @endif
                                </div>
                            </li>
                        @endif
                    @endforeach
                    @if($hasFinalExam)
                        @php($finalExam = $data->getMemberLectureFinalExam())
                        <li>
                            <div class="num02">평가</div>
                            <div class="txt">
                                <p class="tit">최종평가응시</p>
                                <p>시험시간 : <span>{{ $getExamTimeText($finalExam) }}</span></p>
                                <p>응시아이피 : <span>{{ $finalExam?->ip }}</span></p>
                            </div>
                            <div><b class="font18">{{ $getExamStatusText($finalExam) }}</b></div>
                            <div>
                                @if($isPlayable)
                                <x-new-tab href="{{ route('lectures.exams.agree', ['program' => $data, 'type' => \App\Models\Lectures\ExamKind::FINAL->value]) }}" attribute="class=detail_btn02 popup_window">최종평가</x-new-tab>
                                @endif
                            </div>
                        </li>
                    @endif
                    @if($hasTaskExam)
                        @php($task = $data->getMemberLectureTaskExam())
                        <li>
                            <div class="num02">과제</div>
                            <div class="txt">
                                <p class="tit">과제제출</p>
                                <p>제출시간 : <span>{{ $getExamTimeText($task) }}</span></p>
                                <p>응시아이피 : <span>{{ $task?->ip }}</span></p>
                            </div>
                            <div><b class="font18">{{ $getExamStatusText($task) }}</b></div>
                            <div>
                                @if($isPlayable)
                                <x-new-tab href="{{ route('lectures.exams.agree', ['program' => $data, 'type' => \App\Models\Lectures\ExamKind::TASK->value]) }}" attribute="class=detail_btn02 popup_window">과제제출</x-new-tab>
                                @endif
                            </div>
                        </li>
                    @endif
                </ul>
                <div class="btn_box"><a href="{{ route('members.lectures.learning') }}" class="btn_type04">목록가기</a></div>
            </div>

            <div class="con_box tab-pane fade" id="consulting">
                <!-- 1:1 상담 -->
            </div>

            <div class="con_box tab-pane fade" id="reference">
                <!-- 학습자료실 -->
            </div>
        </div>
    </div>
@endsection
@push('body_scripts')
    <script>
        function openDetail() {
        }

        function openVote() {
        }
    </script>
@endpush
