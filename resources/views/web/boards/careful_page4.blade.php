@extends('web.boards.careful_template')
@section('sub_content')
    <div class="sub_content">
        <div class="sub_title">
            <p class="tit">모사답안이란?</p>
            <p>수강생의 리포트 답안 내용이 인터넷 또는 타인의 답안과 동일하거나, 일부 문구만을 수정하여 제출한 경우 확인하여 모사처리 하는 것을 의미합니다.</p>
        </div>

        <div class="sub_title mb10"><p class="tit">모사답안방지안내</p></div>
        <div class="mosa_box">
            <p class="tit">자사는 모사답안에 대해 철저히 관리하고 있습니다.</p>
            <p>모사답안이 발생하여 수료할 수 없을 시 어떠한 경우도 책임지지 않습니다.</p>
        </div>
        <div class="mosa_box">
            <p class="tit">모사답안 발생시</p>
            <ul class="list_num">
                <li>모사답안이 발생할 경우 해당 문제 및 과제가 0점 처리됩니다.</li>
                <li>모사답안이 발생하여 수료점수 미달 시 재시험 및 과제 재제출은 없습니다.</li>
                <li>모사답안이 발생하여 수료점수 미달 시 미수료로 처리됩니다.</li>
            </ul>
        </div>
        <div class="mosa_box">
            <p class="tit">모사답안 발생시 처리기준</p>
            <ul class="list_num">
                <li>주관식(서술형)문제 및 과제(서술형)에 대한 띄어쓰기, 오타, 특수문자 등이 동일할 경우</li>
                <li>파일 속성, 크기가 완전 일치하는 동일 파일</li>
                <li>과제 내용이 완전히 동일한 경우</li>
                <li>우연으로 보기에는 상식 이하의 오답이 동일하게 발견된 경우</li>
                <li>다른 사람이 했다면 완전히 같게 될 수 없는 것이 동일하게 발견되는 경우 <br/>(예: 수많은 도형의 위치, 선 굵기 등이 완전 일치)</li>
            </ul>
            <p>위 항목 100% 일치 했을 시 모사답안으로 판단, 모사답안 추출 프로그램을 통한 모사답안 추출 진행</p>
        </div>
        <div class="mosa_box">
            <p class="tit">모사답안 예방 방법</p>
            <ul class="list_num">
                <li>
                    <p><b>학습자 공지</b></p>
                    <p>교육시작시 안내문을 통해 모사기준 및 처리에 대한 내용을 학습자에게 공지합니다.</p>
                </li>
                <li>
                    <p><b>문제은행 구축 및 랜덤 출제</b></p>
                    <p>시험 및 과제의 경우 문제은행을 구축하여 랜덤방식으로 선택되어 제공되지 때문에 동일한 시험문제 및 과제를 통한 평가를 최소화 합니다.</p>
                </li>
                <li>
                    <p><b>학습자 모드에서 복사 금지</b></p>
                    <p>학습자가 시험응시 및 과제 제출시 웹상에서의 복사기능 제어 진행</p>
                </li>
                <li>
                    <p><b>교수자 상세 필터링</b></p>
                    <p>교수자의 검색으로 모사답안 확인 절차를 진행합니다.</p>
                </li>
            </ul>
        </div>
        <div class="mosa_box">
            <p class="tit">수료기준</p>
            <ul class="list_num">
                <li>진도율 80%이상(1일 8강으로 제한)</li>
                <li>시험과 과제 합산하여 100점 만점으로 환산, 100점 중 60점 이상 취득</li>
            </ul>
        </div>
    </div>
@endsection
