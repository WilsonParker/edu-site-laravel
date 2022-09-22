@extends('web.layouts.app')

@push('styles')
    <link rel="stylesheet" href="/css/popup.css"/>
@endpush

@php
  $link = "/video/03/docs/01/1001.html";
  // $link = $data->class->link;
@endphp

@section('content')
    <div id="wrap">
        <div class="pop_study">
            <div class="study_left">
                <div class="study_video">
                    <iframe src="{{ $link }}" width="100%" height="800"
                            name="frame" id="frame" allow="autoplay; fullscreen"
                            onload="afterInit(this)"
                    ></iframe>
                    <label>
                        <select onchange="changeSpeed(this.value)" class="video_select">
                            <option value="0.5">0.5배속</option>
                            <option value="1" selected>1배속</option>
                            <option value="1.5">1.5배속</option>
                            <option value="2">2배속</option>
                        </select>
                    </label>
                </div>
            </div>
            <!-- <button type="button" class="display_btn" onclick="open_info()"></button> -->
            <div class="study_right">
                <div class="study_box">
                    <div class="tit_box">
                        <h2 class="title">학습하기</h2>
                        <h3>{{ $data->memberLectureProgram->lectureProgram->lecture->title }}</h3>
                        <h4><span><b>{{ $data->class->number }}</b>차시</span> | <span>{{ $data->class->title }}</span></h4>
                    </div>

                    <div class="study_con tab_box tab_box sub_tab">
                        <nav class="sub_tab pop_tab">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-qna-tab" data-bs-toggle="tab" data-bs-target="#nav-qna" type="button" role="tab" aria-controls="nav-home" aria-selected="true">학습Q&amp;A</button>
                                <button class="nav-link" id="nav-debate-tab" data-bs-toggle="tab" data-bs-target="#nav-debate" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">토론</button>
                                <button class="nav-link" id="nav-study-tab" data-bs-toggle="tab" data-bs-target="#nav-study" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">학습자료</button>
                                <button class="nav-link" id="nav-note-tab" data-bs-toggle="tab" data-bs-target="#nav-note" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">수업노트</button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="con_box tab-pane tab-pane fade show active" id="nav-qna" role="tabpanel" aria-labelledby="nav-qna-tab">qna</div>
                            <div class="con_box tab-pane tab-pane fade" id="nav-debate" role="tabpanel" aria-labelledby="nav-debate-tab">debate</div>
                            <div class="con_box tab-pane tab-pane fade" id="nav-study" role="tabpanel" aria-labelledby="nav-study-tab">study</div>
                            <div class="con_box tab-pane tab-pane fade" id="nav-note" role="tabpanel" aria-labelledby="nav-note-tab">note</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
        let videoTag;
        let iframe;
        let classNumber;
        let runningStart;
        $(function () {
            // 10 초 마다 수강 내역을 저장 합니다
            setInterval(function () {
                let runningTime = Math.floor((Date.now() - runningStart) / 1000) + 1;
                axios.get('{{ route('members.lectures.playing', $data) }}', {
                    params: {
                        number : classNumber,
                        time : runningTime,
                    }
                });
            }, 3000);

            disableContextMenu();
            videoHelper.init();

            window.addEventListener('message', function (e) {
                console.log('parent');
                console.log(e.data);
                if(e.data.key === 'url') {
                    classNumber = videoHelper.validation.extractClassNumber(e.data.data);
                    runningStart = Date.now();
                }
            });

            iframe = document.getElementById('frame')
        });

        function afterInit(frame) {
            console.log(frame);
            callIframe('init');
            callIframe('url');

            /*console.log(data);
            document.getElementById('frame').contentWindow.postMessage('call:afterInit', '*');
            disableContextMenuInFrame(iframe);

            videoTag = iframe.contentWindow.document.getElementsByTagName("video")[0];
            console.log(videoTag);
            if (videoTag != undefined) {
                $('.video_select').show();
            }else{
                $('.video_select').hide();
            }

            video.updatePlayer();*/
        }

        function changeSpeed(rate) {
            callIframe('changeRate', rate);
        }

        function callIframe(key, data) {
            iframe.contentWindow.postMessage({
                key: key,
                data: data,
            }, '*');
        }
    </script>
@endpush
