@extends('web.layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/popup.css"/>
@endpush

@section('content')
    <div id="wrap">
        <div class="pop_box">
            <h2 class="pop_tit03"><span class="sky12">진행단계평가 응시</span> 유의사항</h2>
            <div class="pop_con">
                <ul>
                    <li>시험문제는 객관식 {{ $data->lectureProgram->lecture->information->mid_multiple_choice_count }}문제가 출제됩니다.</li>
                    <li>시험응시 제한시간은 없으나 진행단계 평가를 완료하셔야 다음차시의 강좌를 수강 하실수 있습니다.</li>
                    <li>응시 후 제출을 클릭하면 시험이 제출됩니다.</li>
                    <li>문제은행을 구축하여 랜덤방식으로 선택되어 문제가 제공되기 때문에 동일한 시험문제를 최소화 합니다.</li>
                    <li>수료기준 : 진도율 80%이상 (내일배움카드:1일 8강으로 제한 / 일반과정:제한없음), 시험({{ $data->lectureProgram->lecture->exam_reflection_rate }}%),진행단계평가({{ $data->lectureProgram->lecture->evaluation_reflection_rate }}%)
                        @if($data->lectureProgram->lecture->hasTaskExams())
                        ,과제({{ $data->lectureProgram->lecture->problem_reflection_rate }}%)
                        @endif
                        를 합산하여 100점 만점으로 환산, 100점 중 60점 이상 취득하셔야 합니다.</li>
                    <li>시험은 1회만 응시가능하고 시험 재응시는 규정에 따라 불가능합니다.	</li>
                    <br />
                    ※ 시험 응시중에 컴퓨터가 꺼지거나 시험창에 문제가 생길경우 바로 재부팅하여 시험응시 부탁드립니다.  </li>
                </ul>

            </div>
            <form action="" class="pop_check" method="post">
                @csrf
                <fieldset>
                    <p style="margin-bottom: 25px;">
                        <input type="checkbox" name="agree" value="Y" required />
                        <label for="agreeChk">위 내용을 확인하셨습니까?</label>
                    </p>
                    <p><input type="submit" value="시험응시" class="pop_btn" /></p>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
