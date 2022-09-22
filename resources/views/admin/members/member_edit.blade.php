@extends('admin.layouts.index_template')

@section('sub_content')
    @php
        $member = $data['member'];
        $plusMember = $member->plusMember;
        $isRequestRecommendBook = isset($plusMember) ? $plusMember->requestRecommendBook()->exists() : false;
        $requestRecommendedBook = $plusMember->requestRecommendBook;
        if($isRequestRecommendBook) {
            $requestRecommendBook = $plusMember->requestRecommendBook->recommendableBook->recommendBook->book;
        }
    @endphp

    <form id="frm" method="post" action="{{ route('members.update', ['member' => $member->id]) }}">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">회원 정보</h6>
            </div>
            <div class="card-body">
                <div class="input-group mb-3"
                     onclick="loading.locateUrl('{{ route('members.show', ['member' => $member->id]) }}')">
                    <img src="{{ $member->getProfileImage() }}" width="150"/>
                </div>

                @foreach($data['form']['member'] as $items)
                    <div class="form-group">
                        <label for="{{ $items['key'] }}">{{ $items['name'] }}</label>
                        <input type="text" class="form-control" id="{{ $items['key'] }}" name="{{ $items['key'] }}"
                               value="{{ $items['value'] }}"/>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">회원 정보</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered scrollable-table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>직업</th>
                            <th>성별</th>
                            <th>연애 상태</th>
                            <th>관심사</th>
                            <th>기분</th>
                            <th>선호 장르</th>
                            <th>분량</th>
                            <th>난이도</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $member->getJobString() }}</td>
                            <td>{{ $member->getGenderString() }}</td>
                            <td>{{ $member->getLoveString() }}</td>
                            <td>
                                @foreach($getInterestNames($member->interests) as $interest)
                                    {!! $buildBadge($interest) !!}
                                @endforeach
                            </td>
                            <td>
                                @foreach($getFeelingNames($member->feelings) as $feeling)
                                    {!! $buildBadge($feeling) !!}
                                @endforeach
                            </td>
                            <td>{{ $member->getGenreString() }}</td>
                            <td>{{ $member->getBookDifficultyString() }}</td>
                            <td>{{ $member->getBookSizeString() }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @isset($plusMember)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">플러스 발송 정보</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_send_from_office"
                                   id="is_send_from_office"
                                   @if($plusMember->is_send_from_office)
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="is_send_from_office">
                                사무실 발송 여부
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="has_plus_cs" id="has_plus_cs"
                                   @if($isRequestRecommendBook)
                                   checked
                                @endif
                            >
                            <label class="form-check-label" for="has_plus_cs">
                                플러스 CS 문의 여부
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-load-url="{{ route('recommend.book.modal.recommendable.index', ['memberID' => $plusMember->member_id, 'plusMemberID' => $plusMember->id]) }}"
                                data-target="#basicModal">검색
                        </button>
                    </div>
                    <div class="form-group" id="recommendable_book">
                        <input type="hidden" name="ref_recommendable_book_id" data-name="ref_recommendable_book_id"
                               value="{{ $isRequestRecommendBook ? $requestRecommendedBook->ref_recommendable_book_id : 0 }}"/>
                        <p>제목 : <span
                                data-name="title">{{ $isRequestRecommendBook ? $requestRecommendBook->title : '' }}</span>
                        </p>
                        <p>ISBN : <span
                                data-name="isbn">{{ $isRequestRecommendBook ? $requestRecommendBook->isbn : '' }}</span>
                        </p>
                        <p>저자 : <span
                                data-name="author">{{ $isRequestRecommendBook ? $requestRecommendBook->author : '' }}</span>
                        </p>
                        <p>출판사 : <span
                                data-name="publisher">{{ $isRequestRecommendBook ? $requestRecommendBook->publisher : '' }}</span>
                        </p>
                        <p>장르 : <span
                                data-name="genre">{{ $isRequestRecommendBook ? $requestRecommendBook->genre : '' }}</span>
                        </p>
                        <p>이미지 : <img data-name="image"
                                      src="{{ $isRequestRecommendBook ? $requestRecommendBook->book_img : '' }}"/>
                        </p>
                    </div>

                    <label for="reason">추천 이유</label>
                    <input type="text" class="form-control col-sm-6" id="reason" name="reason" value="{{ $isRequestRecommendBook ? $requestRecommendedBook->recommended_reason : '' }}">
                    <br/>

                    <label for="interests">관심사</label>
                    <div class="row">
                        @foreach($interests as $interest)
                            <div class="input-group col-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" aria-label="Checkbox for following interest"
                                               name="recommend_reason" value="{{ $interest->interest_name }}"
                                            {{ $isRequestRecommendBook && $requestRecommendedBook->recommended_reason == $interest->interest_name ? 'checked' : '' }}
                                        >
                                    </div>
                                </div>
                                <span class="form-control"
                                      aria-label="Interest text with checkbox">{{ $interest->interest_name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <br/>

                    <label for="evaluation">기분</label>
                    <div class="row">
                        @foreach($feelings as $feeling)
                            <div class="input-group col-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" aria-label="Checkbox for following feeling"
                                               name="recommend_reason" value="{{ $feeling->feeling_name }}"
                                            {{ $isRequestRecommendBook && $requestRecommendedBook->recommended_reason == $feeling->feeling_name ? 'checked' : '' }}
                                        ></div>
                                </div>
                                <span class="form-control"
                                      aria-label="Feeling text with checkbox">{{ $feeling->feeling_name }}</span>
                            </div>
                        @endforeach
                    </div>
                    <br/>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">플러스 회원 정보</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="membership_num">멤버십 번호</label>
                        <input type="text" class="form-control" id="membership_num" name="membership_num"
                               value="{{ $plusMember->membership_num }}"/>
                    </div>

                    <div class="form-group">
                        <label for="ref_membership_code">멤버십 타입</label>
                        <select class="custom-select form-control" name="ref_membership_code">
                            @foreach($membershipList as $membership)
                                <option value="{{ $membership->code }}"
                                        @if($membership->code == $plusMember->ref_membership_code)
                                        selected
                                    @endif
                                >
                                    {{ $membership->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="available_date">시작일</label>
                        <input type="text" class="form-control" id="available_date" name="available_date"
                               value="{{ $plusMember->available_date }}"/>
                        <small id="expiration_date_help" class="form-text text-muted">Y-m-d ex) 2020-10-23</small>
                    </div>

                    <div class="form-group">
                        <label for="expiration_date">종료일</label>
                        <input type="text" class="form-control" id="expiration_date" name="expiration_date"
                               value="{{ $plusMember->available_date }}"/>
                        <small id="expiration_date_help" class="form-text text-muted">Y-m-d ex) 2020-10-23</small>
                    </div>
                </div>
            </div>
        @endisset

        <div class="card shadow mb-4">
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">수정</button>
                <button type="button" class="btn btn-danger"
                        onclick="loading.locateUrl('{{ route('members.show', ['member' => $member->id]) }}')">취소
                </button>
            </div>
        </div>
    </form>
@endsection
@push('body_scripts')
    <script>
        $(function () {
            $('input[name="recommend_reason"]').on('click', function () {
                $('#reason')[0].value = this.value;
            });
        });

        function onSelectedBook(res) {
            let data = res.data.data;
            let book = data.recommend_book.book;
            let recommendableBook = modelBuilder.selector.getModel('#recommendable_book');
            modelBuilder.attribute.setHtml(recommendableBook, 'title', book.title);
            modelBuilder.attribute.setHtml(recommendableBook, 'isbn', book.isbn);
            modelBuilder.attribute.setHtml(recommendableBook, 'author', book.author);
            modelBuilder.attribute.setHtml(recommendableBook, 'publisher', book.publisher);
            modelBuilder.attribute.setHtml(recommendableBook, 'genre', book.genre);
            modelBuilder.attribute.setValue(recommendableBook, 'ref_recommendable_book_id', data.id);
            modelBuilder.attribute.setAttribute(recommendableBook, 'image', 'src', book.book_img);
        }
    </script>
@endpush
