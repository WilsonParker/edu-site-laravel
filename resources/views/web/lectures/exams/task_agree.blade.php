@extends('web.layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/popup.css"/>
@endpush

@section('content')
    <div id="wrap">
        <div class="pop_box">
            <h2 class="pop_tit03"><span class="sky12">과제 제출</span> 유의사항</h2>
            <div class="pop_homework">
                <table class="t_style16">
                    <tr>
                        <th>유의사항</th>
                        <td>
                            (1) 과제는 제한시간이 없으나, 학습종료일 23:59까지는 제출을 완료하여야 합니다.
                            <br />
                            (2) 과제를 [임시제출]한 경우 반드시 학습기간 내 [과제제출]을 완료하여야 합니다.
                            <br />
                            (3) 과제는 1회만 제출 가능하며 제출 후에는 수정이 불가능하므로 제출 전 반드시 파일을 확인 바랍니다.
                            <br />
                            (4) 제출한 파일을 확인할수 없는 경우 0점 처리 됩니다. (ex. 암호파일, 깨진파일, 파일오류 등)
                            <br />
                            (5) 제출한 파일 확인결과 모사답안으로 확인된 경우 0점 처리됩니다.
                            <br />
                            (6) 과제내용을 입력창에 붙여넣기(ctrl+v) 할 수 없습니다. 처음부터 과제창에 직접 입력해주시거나, 별도 파일을 첨부하시어 제출해주시기 바랍니다.
                            <br />
                            (7) 자동 로그아웃 등으로 인하여 과제가 초기화되는 것을 방지하기 위해 수시로 임시저장 또는 별도의 문서프로그램에 작성 후 파일첨부를 통해 제출해주시기 바랍니다.
                        </td>
                    </tr>
                    <tr>
                        <th>모사답안 처리기준</th>
                        <td>
                            (1) 주관식(서술형) 문제 및 과제(서술형)에 대한 띄어쓰기, 오타, 특수문자 등이 동일한 경우
                            <br />
                            (2) 파일속성, 크기가 완전 일치하는 동일 파일
                            <br />
                            (3) 과제내용이 완전이 동일한 경우
                            <br />
                            (4) 우연으로 보기에는 상식 이하의 오답이 동일하게 발견된 경우
                            <br />
                            위 항목이 100% 일치했을 시 모사답안으로 판단, 모사답안 추출 프로그램을 통한 모사답안 추출 진행
                        </td>
                    </tr>
                </table>
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
    </div>
@endsection
