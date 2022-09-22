@inject('baseViewModel', "LaravelSupports\ViewModels\BaseViewModel")
@extends('web.layouts.app')

@push('first_styles')
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
@endpush
@push('styles')
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-content {
            visibility: hidden;
            width: 350px;
            height: 100px;
            background-color: #eaeaea;
            padding: 0;
            margin-top: 10px;
            color: black;
            text-align: center;
            position: fixed;
            z-index: 1;
        }

        .tooltip:hover .tooltip-content {
            visibility: visible;
        }

        .ncs-popup .popup-cont p:before {
            top: 6px;
        }

        .pagination {
            width: fit-content;
            margin: 0px auto;
        }
    </style>
@endpush

@section('content')
    <div id="ncs-section">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li>
                    <span>{{ $getCategoryTitle }}</span>
                    @include('web.layouts.includes.sub_menu')
                </li>
                <li>
                    <span>{{ $getSelectedCategoryTitle }}</span>
                    <ul class="one_menu">
                        @foreach($categories as $category)
                            <li><a href="{{ route('lectures.index', ['code' => $category, 'type' => $type]) }}">{{ $category->getNumberText() }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div><!-- class="sub_navi" -->

        <div class="inner">
            <div class="ncs-side-menu m-none">

                <div class="banner">
                    <a href="http://www.edu-site-laravel.co.kr/edu/hrd51.html?p=1&amp;keyfield=&amp;keyword=&amp;gubun=2&amp;no=7">
                        <x-image src="data/banner/배너01_220x96_01.png"/>
                    </a>
                </div>
                <div class="banner">
                    <a href="http://edu-site-laravel.co.kr/custom/news.html?gubun=3">
                        <x-image src="data/banner/cou(1)배너02_220x96_02.png"/>
                    </a>
                </div>
                <!-- 2020-12-03 추가 -->

                <div class="lec-link-wrap">
                    <h3 class="title">NCS 직무코드</h3>
                    <ul class="lec-link">
                        @foreach($categories as $category)
                            <li><a href="{{ route('lectures.index', ['code' => $category, 'type' => $type]) }}">
                                @if($selectedCategory?->code == $category->code)
                                    <strong style='color:#339900'>{{ $category->getNumberText() }}</strong>
                                @else
                                    {{ $category->getNumberText() }}
                                @endif
                            </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if($hasFilter)
            <div class="ncs-cont-wrap">
                <form action="{{ route('lectures.search') }}" method="get" name="searchForm">
                    <div class="ncs-cont ncs-management ncs-search">
                        <div class="title-area">
                            <h1 class="main-title">{{ $getCategoryTitle }}</h1>
                            <div class="search_box">
                                <div class="input-wrap">
                                    <input type="hidden" name="type" value="{{ $type }}"/>
                                    <input type="hidden" name="search" value="title"/>
                                    <input type="text" name="keyword" value="{{ $searchData['keyword'] ?? ''}}" placeholder="검색어를 입력하세요."/>
                                    <x-image src="images/sub/ncs/ic-search.png" alt="검색" attribute="class=btn-search onclick=searchForm.submit()"/>
                                </div>
                            </div>

                            <div class="banner-wrap m-show">
                                <div class="banner">
                                    <a href="http://www.edu-site-laravel.co.kr/edu/hrd51.html?p=1&amp;keyfield=&amp;keyword=&amp;gubun=2&amp;no=7"><img src="/data/banner/배너01_220x96_01.png"></a>
                                </div>
                                <div class="banner">
                                    <a href="http://edu-site-laravel.co.kr/custom/news.html?gubun=3"><img src="/data/banner/cou(1)배너02_220x96_02.png"></a>
                                </div>
                            </div>
                        </div>

                        <div class="filter_area">
                            <div class="filter_box">
                                <div class="filter_box_label" style="font-weight: 700">
                                    정렬기준
                                </div>
                                @foreach($sort['sort'][$baseViewModel::KEY_SORT_VALUES] as $itemKey => $itemValue)
                                    <div class="form-check">
                                        <input type="radio" style="cursor:pointer;" name='sort'
                                               value='{{ $itemKey }}' class="form-check-input"
                                               id="{{ $itemKey }}"
                                               @if(isset($searchData['sort']) && $searchData['sort'] == $itemKey)
                                               checked
                                            @endif
                                        />
                                        <label for="{{ 'sort' }}"
                                               onclick="sort('{{ $itemKey }}')">{{ $itemValue }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="filter_box">
                                <div class="filter_box_label" style="font-weight: 700">
                                    조건 검색
                                </div>
                                @foreach($filters['filters'][$baseViewModel::KEY_FILTER_VALUES] as $itemKey => $itemValue)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $itemKey }}"
                                               id='checkbox_{{ $itemKey }}' name='filters[]' onclick='filter()'
                                               @if(isset($searchData['filters']) && in_array($itemKey, $searchData['filters']))
                                               checked
                                            @endif
                                        />
                                        <label class="form-check-label"
                                               for='checkbox_{{ $itemKey }}'><span>{{ $itemValue[0] }}</span></label>
                                        <span title="{{ $itemValue[1] }}"><i class="question-circle"></i></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="content-area">
                            @yield('list_content')
                        </div>
                    </div>
                </form>
            </div>
            @endif
            @yield('pagination')

            @yield('show_content')
        </div>
    </div><!-- id="section" -->
@endsection

@push('body_scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
            crossorigin="anonymous"></script>
    <script>
        // 지원금 상세보기 버튼 클릭 팝업 스트립트 입니다.
        $(function () {
            $('.popup-open').click(function () { // 팝업 열기 버튼 클릭시 동작하는 이벤트입니다.

                var targeted_popup_class = $(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
            });


            $('.popup-close').click(function () { // 팝업 닫기 버튼 클릭시 동작하는 이벤트입니다.
                var targeted_popup_class = $(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            });
        });

        //강좌미리보기
        function vod_preview(url) {
            //console.log('51 idx=',idx, ' id=',id);
            //브라우저의 크기를 기준으로 중앙에 창띄우기
            var popupX = (document.body.offsetWidth / 2) - (1010 / 2);
            var popupY = (document.body.offsetHeight / 2) - (690 / 2);

            window.open(url, '동영상 미리보기', 'width=1010, height=690, left=' + popupX + ',top=' + popupY + ', menubar=no,status=no, toolbar=no');
        }

        function sort(value) {
            let searchParams = new URLSearchParams(location.search);
            searchParams.set('sort', value);
            location.href = "?" + searchParams.toString();
        }

        function filter() {
            let checkboxCount = $('.filter_box input[type="checkbox"]').length;
            let checkedList = $('.filter_box input[type="checkbox"]:checked');
            let searchParams = new URLSearchParams(location.search);

            // remove all filter[] parameter
            searchParams.delete('filters[]');
            for (let i = 0; i < checkboxCount; i++) {
                searchParams.delete(`filters[${i}]`);
            }
            checkedList.toArray().forEach(function (ele, index) {
                searchParams.append('filters[]', ele.value);
            })
            location.href = "?" + searchParams.toString();
        }

        /**
         * filter checkbox
         * @author  dev9163
         * @added   2021/07/29
         * @updated 2021/07/29
         */
        $(function () {
            let filterBox = $('.filter_box input[type="checkbox"]');
            let filterBoxAllCheckBox = $("#checkbox_all");

            filterBoxAllCheckBox.on('click', function () {
                let checkedList = $('.filter_box input[type="checkbox"]').filter(function (index, selector) {
                    return selector.id != "checkbox_all";
                });
                checkedList.prop('checked', false);
            });

            filterBox.on('click', function () {
                if (this.id != "checkbox_all") {
                    filterBoxAllCheckBox.prop('checked', false);
                }
            });
        })
    </script>
@endpush
