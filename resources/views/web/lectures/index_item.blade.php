@php
    $showLink = route('lectures.show', [ 'lecture' => $item, 'type' => $type ]);
@endphp
<li class="lecture-list" style="{{ $style ?? '' }}">
    <div class="title-wrap">
        <h3 class="title">
            <a href="{{ $showLink }}">
                {{--<span class="ico-best"></span>--}}
                {{ $item->title }}
            </a>
        </h3>
        <div class="badge-wrap">
            @foreach($item->getTypes() as $lectureType)
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
    <div class="lec-info-wrap">
        <div class="lec-img">
            <a href="{{ $showLink }}">
                <x-image src="{{ $item->resource?->getOriginUrl() }}" alt="교육과정 이미지"/>
            </a>
        </div>
        <div class="lec-info">
            <div class="info-course">
                <dl>
                    <dt class="m-none">NCS 분류:</dt>
                    <dd>{{ $item->getNCSTitle() }}</dd>
                </dl>
                <dl>
                    <dt class="m-none">수강기간:</dt>
                    <dd class="m-none">{{ $item->getLeaningTermText() }}</dd>
                </dl>
                <dl>
                    <dt>강좌구성:</dt>
                    <dd>{{ $item->total_learning_time }}시간 ({{ $item->classes->count() }}강)</dd>
                </dl>
            </div>
            <div class="info-price">
                <dl>
                    <dt>수강료:</dt>
                    <dd class="c-red">{{ number_format($item->tuition) }}<span class="m-show">원</span></dd>
                </dl>
                <dl>
                    <dt>지원금:</dt>
                    <dd>
                        <span class="c-blue"><span class="m-show">최대</span> {{ number_format($item->worker_subsidy) }}<span class="m-show">원</span></span>
                        <div class="ncs-popup m-none">
                            @php
                                $listID = 'list-'.$item->idx;
                                $hasWorkerSubsidy = $item->worker_subsidy > 0;
                                $hasRefundSupport = $item->refund_support > 0;
                                $hasRefundLess = $item->refund_less > 0;
                                $hasRefundOver = $item->refund_over > 0;
                            @endphp
                            <button
                                data-popup-open="{{ $listID }}"
                                type="button"
                                class="btn btn-more popup-open"
                                style="cursor:pointer"
                            >지원금 상세보기
                            </button>
                            @if($hasWorkerSubsidy && $hasRefundSupport && $hasRefundLess && $hasRefundOver)
                                <div class=" popup" data-popup="{{ $listID }}">
                                    <div class="popup-cont">
                                        <h1 class="title">근로자카드 지원</h1>
                                        @if($hasWorkerSubsidy)
                                            <p>근로자 카드로 신청시 <span class="price">{{ number_format($item->worker_subsidy) }}원</span>
                                            </p>
                                        @endif
                                        <br>
                                    </div>

                                    <div class="popup-cont">
                                        <h1 class="title">사업주 지원</h1>
                                        @if($hasRefundSupport)
                                            <p>중소기업 <span class="price">{{ number_format($item->refund_support) }}원</span>
                                            </p>
                                        @endif
                                        @if($hasRefundLess)
                                            <p>대규모(1000인 미만) <span class="price">{{ number_format($item->refund_less) }}원</span>
                                            </p>
                                        @endif
                                        @if($hasRefundOver)
                                            <p>대규모(1000인 이상) <span class="price">{{ number_format($item->refund_over) }}원</span>
                                            </p>
                                        @endif
                                    </div>
                                    <!-- 사업주지원 -->
                                    <button class="popup-close"
                                            data-popup-close="{{ $listID }}"
                                            type="button"
                                            style="cursor:pointer">닫기
                                    </button>
                                </div>
                            @else
                                <div class=" popup" data-popup="{{ $listID }}"
                                     style=" width:200px">
                                    <div class="popup-cont" style="font-size:10px;">
                                        해당과정은 지원금이 없습니다.
                                        <button class="popup-close"
                                                type="button"
                                                data-popup-close="{{ $listID }}"
                                                style="cursor:pointer">닫기
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="btn-wrap m-none">
                <a href="{{ $showLink }}" class="btn btn-enroll">수강신청</a>
                {{--<a href="#" class="btn btn-preview" onclick="vod_preview('http://vod.edu-site-laravel.co.kr/76/docs/01/01_01.html')">강의 미리보기</a>--}}
                <a href="{{ route('lectures.preview', [$item]) }}" class="btn btn-preview">강의 미리보기</a>
            </div>
        </div>
    </div>
</li>
