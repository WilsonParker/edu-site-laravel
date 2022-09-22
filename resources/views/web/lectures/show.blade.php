@extends('web.lectures.index_template')

@php
    $tuition = number_format($data->tuition);
    $subsidy = number_format($data->worker_subsidy);
@endphp

@push('styles')
    <style>
        @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
            .search_box {
                width: 510px
            }

            .popup-txt .popup-content .close {
                position: absolute;
            }

        }

        * {
            font-size: 16px;
        }

        .no_img {
            padding: 21px;
            height: 125px;
            background: #f7f7f7;
        }

        .hrd_big {
            font-size: 20px
        }

    </style>
@endpush

@section('show_content')
    <div class="ncs-cont-wrap ncs-lecture">
        <div class="ncs-cont">
            <div class="content-area">
                <div class="title-wrap">
                    <!-- best 아이콘 없는 경우 class .d-none 처리되어있습니다. -->
                    <h2 class="title">
                        <span></span>
                        {{ $data->title }}
                    </h2>

                    <div class="badge-wrap">
                        @foreach($data->getTypes() as $lectureType)
                            @switch($lectureType->code)
                                @case('normal')
                                <span class="badge badge-yellow" style="display:block">모바일</span>
                                @break
                                @case('nbc')
                                <span class="badge badge-blue" style="display:block">근로자카드</span>
                                @break
                                @case('business')
                                <span class="badge badge-green" style="display:block">사업주</span>
                                @break
                            @endswitch
                            &nbsp;
                        @endforeach
                    </div>
                </div>

                <div class="info-wrap">
                    <div class="m-show lec-info-m">
                        <span>학습시간: {{ $data->total_learning_time }}시간 (총{{ $data->classes->count() }}강)</span>
                        <span>수강료: {{ number_format($data->tuition) }}원</span>
                    </div>
                    <div class="lec-img">
                        <x-image src="{{ $data->resource->getOriginUrl() }}" alt="교육과정사진"/>
                        <a href="{{ route('lectures.preview', [$data]) }}" style="margin-top:10px" class="btn lec-preview">강의 미리보기</a>
                        <div class="contents">
                            <span class="sub_text"></span>
                        </div>
                    </div>

                    <div class="lec-wrap">
                        <div class="lec-info">
                            <dl>
                                <dt>NCS 분류:</dt>
                                <dd>{{ $selectedCategory->getNumberTextInDetail() }} <a href="{{ route('lectures.index', ['code' => $data->category]) }}" class="btn btn-more m-none">강의 더보기</a></dd>
                            </dl>
                            <dl class="m-none">
                                <dt>강좌구성:</dt>
                                <dd>{{ $data->total_learning_time }}시간 ({{ $data->classes->count() }}강)</dd>
                            </dl>
                            <dl class="m-none">
                                <dt>수강기간:</dt>
                                <dd>{{ $data->getLeaningTermText() }}</dd>
                            </dl>
                            <dl>
                                <dt>수료기준:</dt>
                                <dd>진도율 80%이상,
                                    시험 {{ $data->getExamCount() }}회
                                    <span class="display_size"
                                          @if($data->problem_reflection_rate < 1)
                                          style="display: none"
                                          @endif
                                    >, 과제 1회</span></dd>
                            </dl>
                        </div>
                        <div class="lec-select">
                            <div class="select-class">
                                <h3 class="title layer_popup">신청유형
                                    <button type="button" class="btn btn-more img02" data-toggle="modal"
                                            data-target="#exampleModal">상세보기
                                    </button>
                                </h3>
                                <ul class="class-category change_radio">
                                    <li class="form-check">
                                        <input class="form-check-input" type="radio" id="class-category01"
                                               autocomplete="off" name="course_type" value="nbc">
                                        <label for="class-category01">내일배움카드(근로자) <small>※ 취성패, 고용위기지역, 근로장려금 등
                                                포함</small></label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" type="radio" id="class-category02"
                                               autocomplete="off" name="course_type" value="business">
                                        <label for="class-category02">사업주지원</label>
                                    </li>
                                    <li class="form-check">
                                        <input class="form-check-input" type="radio" id="class-category03"
                                               autocomplete="off" name="course_type" value="normal" checked>
                                        <label for="class-category03">일반과정</label>
                                    </li>
                                </ul>
                            </div>

                            <button class="btn btn-hrd" id="btn-hrd" style="cursor: pointer; width: 100%; display: block;" onclick="moveHrdUrl(this)" data-url=""></button>

                            <!-- 일반일 경우 학습기간 선택 필드 -->
                            <div class="select-term course_type2">
                                <h3 class="title">학습기간</h3>
                                <div class="class-term search_box">
                                    <select name="startday" id="startday" style="-webkit-tap-highlight-color:transparent;" class="nm-select">
                                        <option value="" data-url="{{ $data->getHrdUrl() }}">{{ $formatDefaultDate(now()) }}~ {{ $formatDefaultDate($data->getNormalProgram()->getLearningEndDate()) }}</option>
                                    </select>
                                    <p>※ 학습기간 종료 후 무료 복습기간 6개월 제공 (학습기간 내 수료 시 수료증 발급)</p>
                                </div>
                            </div>

                            <!-- 내일배움제 카드 : 최대 5까지 나오도록 -->
                            <div class="select-term course_type3" style="display:none">
                                <h3 class="title">학습기간</h3>
                                <div class="class-term search_box">
                                    <select name="class_id" id="class_id" class="nbc-select" onchange="updateNBCHrdButton()">
                                        @foreach($data->availableNbcPrograms->take(5) as $program)
                                            <option value="{{ $program->idx }}" data-progress="{{ $program->nbcInformation->number }}" data-url="{{ $data->getHrdUrl($program) }}">{{ $formatDefaultDate($program->nbcInformation->study_start) }}~ {{ $formatDefaultDate($program->nbcInformation->study_end) }}({{ $program->nbcInformation->number }})회차</option>
                                        @endforeach
                                    </select>
                                    <p>※ 학습기간 31일 + 무료 추가학습기간 1년 제공</p>
                                </div>
                            </div>

                            <!-- 사업주 지원 수강신청일 경우 학습기간 선택 필드 / class="d-none" - display: none; 처리 되어있습니다.-->
                            <div class="select-term course_type4" style="display:none">
                            </div>

                            <table class="select-price">
                                <tbody>

                                <!-- 일반과정 -->
                                <tr class="course_type2">
                                    <td>수강료</td>
                                    <td class="num"><span class="cost">{{ $tuition }}</span>원</td>
                                </tr>

                                <tr class="course_type2 lecture-price">
                                    <td>총 결제금액</td>
                                    <td class="num"><span class="total" id="total">{{ $tuition }}</span>원</td>
                                </tr>
                                <!-- //일반과정 -->

                                <!-- 내일배움제 -->
                                <tr class="course_type3" style="display:none">
                                    <td>수강료</td>
                                    <td class="num"><span class="cost">{{ $tuition }}</span>원
                                    </td>
                                </tr>

                                <tr class="course_type3" style="display:none">
                                    <td>지원금</td>
                                    <td class="num">-<span class="benefit" id="benefit">{{ number_format($data->worker_subsidy) }}</span>원</td>
                                </tr>
                                <tr class="course_type3 lecture-price" style="display:none">
                                    <td>총 결제금액</td>
                                    <td class="num"><span class="total" id="total3">{{ number_format($data->getWorkerPrice()) }}</span>원</td>
                                </tr>
                                <!-- //내일배움제 -->

                                </tbody>
                            </table>
                            <div class="btn-wrap btn-2">
                                <!-- 일반과정 -->
                                <button class="btn btn-cart course_type2"
                                    @auth
                                        onclick="addCart()"
                                    @else
                                        onclick="location.href='{{ route('auth.index', ['link' => url()->current()]) }}'"
                                    @endauth
                                style="cursor:pointer">강의담기</button>

                                <button class="btn btn-enroll course_type2" onclick="payment()" style="cursor:pointer">수강신청</button>
                                <!-- //일반과정 -->

                                <!-- 내일배움제 -->
                                <button onclick="nbcPayment()" class="btn btn-enroll course_type3" style="cursor:pointer; display:none">수강신청</button>
                                <!--// 내일배움제 -->

                                <!-- 사업주과정 -->
                                <button onclick="alert('사업주지원 과정으로 수강신청이 불가합니다. ');" class="btn btn-enroll  course_type4" style="cursor:pointer; display:none">수강신청</button>
                                <!-- //사업주과정 -->
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="notice-wrap m-none">
                    <li>
                        <span class="title">과정소개</span>
                        <span>{!! $data->course_introduction !!}</span>
                    </li>
                    <li>
                        <span class="title">학습대상</span>
                        <span>{!! $data->learning_target !!}</span>
                    </li>
                    <li>
                        <span class="title">학습목표</span>
                        <span>{!! $data->learning_objectives !!}</span>
                    </li>
                    <li>
                        <span class="title">교수소개</span>
                        @foreach($data->subjectMatterExperts as $subjectMatterExpert)
                            <span>{!! $subjectMatterExpert->introduction !!}</span>
                        @endforeach
                    </li>

                    {{--                    <? if ($c_row[book_yn] == 'Y') { ?>
                                        <li class="book-info-wrap">
                                            <span class="title">교재정보</span>
                                            <span class="book-img"><? if ($c_row[book_img]) { ?><img
                                                    src="/data/course/<?= $c_row[book_img] ?>" alt=""><? } else { ?><span
                                                    class="no_img">이미지 없음</span><? } ?></span>
                                            <span class="book-info">
                                                        <span class="book-tit"><?= $c_row[book_name] ?></span>
                                                        <span class="book-price"><?= number_format($c_row[book_price]) ?>원</span>
                                                        <span class="book-link"><a href="<?= $c_row[book_link] ?>" class="btn"
                                                                                   target="_blank">구매하러 가기</a></span>
                                                    </span>
                                        </li>
                                        <? } ?>--}}

                    <li>
                        <div class="course_info">
                            <span class="title">학습내용</span>
                            <div class="con">
                                <table class="t_style01">
                                    <tbody>
                                    <tr>
                                        <th>차시</th>
                                        <th>내용</th>
                                    </tr>
                                    @foreach($data->classes as $class)
                                        <tr>
                                            <th>{{ $class->number }}차시</th>
                                            <td class="txt_left">{{ $class->title }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="course_info">
                            <span class="title">평가기준</span>
                            <div class="con">
                                <table class="t_style01">
                                    <tbody>
                                    <tr>
                                        <th>평가항목</th>
                                        <th>진도율</th>
                                        <th>시험</th>
                                        <th>과제</th>
                                        <th>진행단계평가</th>
                                        <th>수료기준</th>
                                    </tr>
                                    <tr>
                                        <th>평가비율</th>
                                        <td style="text-align:center; padding:0;">-</td>
                                        <td style="text-align:center; padding:0;">{{ $data->exam_reflection_rate }}%
                                        </td>
                                        <td style="text-align:center; padding:0;">{{ $data->problem_reflection_rate }}
                                            %
                                        </td>
                                        <td style="text-align:center; padding:0;">{{ $data->evaluation_reflection_rate }}
                                            %
                                        </td>
                                        <td style="text-align:center; padding:0;">-</td>
                                    </tr>
                                    <tr>
                                        <th>수료조건</th>
                                        <td style="text-align:center; padding:0;">80% 이상</td>
                                        <td style="text-align:center; padding:0;">0점 이상</td>
                                        <td style="text-align:center; padding:0;">0점 이상</td>
                                        <td style="text-align:center; padding:0;">0점 이상</td>
                                        <td style="text-align:center; padding:0;">60점 이상</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="btn_box m-none"><a href="{{ route('lectures.index', ['code' => $data->category]) }}"
                                               class="btn_type04">목록보기</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="exampleModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="line-height: 2;"><b><span style="font-family: arial;">국민내일배움카드(근로자)</span></b></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">국민내일배움카드를 소지하고 있는 근로자</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">(취성패1·2, 고용위기지역 대상자, 출소예정자, 장애인, 기초생활수급자, 한부모가족 지원법에 해당하는 자, 북한이탈주민, 근로·자녀장려금 수급자, 특별고용지원업종 대상자, 무급휴직자 포함)</span>
                    </p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- NCS직무분류 수료증 발급</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- 학습기간 종료일부터 평균 2일이내 수료증 발급</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- 등록된 학습시간 중 희망하는 기간 선택</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- HRD-Net사이트에서 검색 가능</span><span
                            style="font-family: arial;">​</span></p>
                    <p>&nbsp;</p>
                    <p style="line-height: 2;"><b><span style="font-family: arial;">사업주지원훈련</span></b></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">사업주가 근로자를 대상으로 직업능력개발훈련을 실시할 경우 훈련비를 지원받아 교육하는 제도</span>
                    </p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- NCS직무분류 수료증 발급</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- 학습기간 종료일로부터 2~3일 이후 수료증 발급</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- 등록된 학습기간 확인 후 희망하는 기간 선택</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- HRD-Net사이트에서 검색 가능</span><span
                            style="font-family: arial;">​</span>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p style="line-height: 2;"><b><span style="font-family: arial;">일반과정</span></b></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">강의를 수강하고자 하는 누구나(훈련비 미지원)</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- NCS직무분류 수료증 발급</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- 수료시 바로 수료증 발급</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- 상시 수강신청 및 수강 가능</span></p>
                    <p style="line-height: 2;"><span style="font-family: arial;">- HRD-Net사이트에서 검색 가능</span><span
                            style="font-family: arial;">​</span>&nbsp;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
        $(document).ready(function () {
            //내일배움제, 사업주, 일반과정 선택시
            $("input:radio[name=course_type]").click(function () {
                let no = $(this).val();
                updateCourseType(no);
            });

            updateCourseType('normal');
        });

        function updateCourseType(no) {
            let class_id = $('#class_id').val();

            //일반과정
            if (no == 'normal') {
                $('.course_type2').show();
                $('.course_type3').hide();
                $('.course_type4').hide();
                updateNormalHrdButton();
            } else if (no == 'nbc') {
                //내일배움제
                if (class_id == null) {
                    alert('내일배움카드 과정으로 수강신청이 불가합니다. ');
                    $('.course_type2').show();
                    $('.course_type4').hide();
                    $("input:radio[name='course_type']:radio[value='normal']").prop('checked', true);
                    updateNormalHrdButton();
                } else {
                    $('.course_type3').show();
                    $('.course_type2').hide();
                    $('.course_type4').hide();
                    updateNBCHrdButton();
                }
            } else if (no == 'business') {
                alert('사업주지원 과정으로 수강신청이 불가합니다. ');
                $('.course_type2').show();
                $('.course_type3').hide();
                $("input:radio[name='course_type']:radio[value='normal']").prop('checked', true);
                updateNormalHrdButton();
            }
            let course_id = $('.change_radio input[type=radio]:checked').val();
            change_radio_text(course_id);
        }

        function updateNormalHrdButton() {
            updateHrdButton($('#startday option:selected').attr('data-url'), 'n');
        }

        function updateNBCHrdButton() {
            let option = $('#class_id option:selected');
            let progress = option.attr('data-progress');
            updateHrdButton(option.attr('data-url'), 'nbc', progress);
        }

        function updateHrdButton(val, type, progress) {
            let message = '';
            switch (type) {
                case 'b' :
                    message = `<b class="hrd_big">사업주 직업능력개발 지원 가능!</b><br/>사업주 훈련제도 안내 바로가기`;
                    break;
                case 'nbc' :
                    message = `<b class="hrd_big">빠른 신청 가능!</b><br/>HRD-Net ${progress}회차 수강신청 바로가기`;
                    break;
                case 'n' :
                default :
                    message = `<b class="hrd_big">국가인증 NCS 인정강의!</b><br/>HRD-Net 훈련과정 정보 바로가기`;
                    break;
            }
            let btn = $('#btn-hrd');
            if (val == '' || val == undefined) {
                btn.css('display', 'none');
            } else {
                btn.css('display', 'block');
            }
            btn.attr('data-url', val);
            btn.html(message);
        }

        function moveHrdUrl(obj) {
            window.open($(obj).attr('data-url'), "_blank");
        }

        //콤마 추가
        function add_comma(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        //강좌미리보기
        function vod_preview(url) {
            //브라우저의 크기를 기준으로 중앙에 창띄우기
            let popupX = (document.body.offsetWidth / 2) - (1010 / 2);
            let popupY = (document.body.offsetHeight / 2) - (690 / 2);

            window.open(url, '동영상 미리보기', 'width=1010, height=690, left=' + popupX + ',top=' + popupY + ', menubar=no,status=no, toolbar=no');
        }

        //강의 담기
        function addCart() {
            axios({
                method : 'post',
                url : '{{ route('members.carts.store') }}',
                data : { lecture : {{ $data->idx }} },
            }).then((result) => {
                modal.setContent(result.data.message);
                modal.show();
            }).catch((error) => {
                modal.setContent(error.response.data.message);
                modal.show();
            });
        }

        //일반과정 수강신청  버튼 클릭
        function payment() {
            location.href = "{{ route('lectures.payments.normal', ['idx' => $data->getNormalProgram()]) }}";
        }

        //내일배움제 수강신청 버튼 클릭
        function nbcPayment() {
        }

        /**
         * change_radio_text
         * @author  dev9163
         * @added   2021/08/06
         * @updated 2021/08/06
         *          - 신청 유형마다 다른 문구가 나오도록 수정
         * @updated 2021/08/11
         * 사업주 선택 시 문구 지움
         */
        function change_radio_text(course_type) {
            if (course_type == 'nbc') {
                $('.sub_text').html("- 내일배움카드로 강의 수강시,<br>&nbsp;&nbsp;반드시 <b style=\"color:red;font-size:14px\">HRD-Net에 먼저 수강신청</b><br>&nbsp;&nbsp;후 edu-site-laravel 사이트에서 수강신청을<br>&nbsp;&nbsp;해야합니다.<br><br>- 수강신청은 <b style=\"color:red;font-size:14px\">학습시작 전일<br>&nbsp;&nbsp;오후5시에 마감</b>됩니다.<br>&nbsp;&nbsp;(영업일 기준)<br><br>- 내일배움카드로만 결제가능하며<br>&nbsp;&nbsp;<b style=\"color:red;font-size:14px\">학습시작일 기준으로 근로자</b>인<br>&nbsp;&nbsp;경우에만 수강신청 가능합니다.<br>&nbsp;&nbsp;(실업자 수강불가)");
            } else if (course_type == 'normal') {
                $('.sub_text').html("- <b style=\"color:red;font-size:14px\">HRD-Net 검색 가능!</b><br>&nbsp;&nbsp;HRD-Net(www.hrd.go.kr)에서<br>&nbsp;&nbsp;과정 검색이 가능합니다.<br><br>- <b style=\"color:red;font-size:14px\">NCS코드 부여!</b><br>&nbsp;&nbsp;수료증 발급시 NCS코드 <br>&nbsp;&nbsp;8자리가 부여됩니다.<br><br>- <b style=\"color:red;font-size:14px\">무제한 수강!</b><br>&nbsp;&nbsp;1일 최대 수강 제한이 없어<br>&nbsp;&nbsp;무제한으로 수강 가능합니다.<br><br>- <b style=\"color:red;font-size:14px\">빠른 수료증 발급!</b><br>&nbsp;&nbsp;학습종료일 이전에도<br>&nbsp;&nbsp;조기수료가 가능합니다.");
            } else {
                $('.sub_text').html("");
            }
        }
    </script>
@endpush
