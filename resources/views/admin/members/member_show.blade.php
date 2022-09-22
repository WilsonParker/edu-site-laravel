@extends('admin.layouts.index_template')

<style>
    .scrollable-table th, td {
        white-space: nowrap;
    }
</style>

@section('sub_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">기능</h6>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal"
                    data-load-url="{{ route('members.modal.point', ['member_id' => $data->id]) }}"
                    data-target="#basicModal">
                <i class="fas fa-coins"></i> 포인트 지급/차감
            </button>
            <button type="button" class="btn btn-primary" onclick="loading.locateUrl('{{ route('members.index') }}')">목록</button>
            <button type="button" class="btn btn-primary" onclick="loading.locateUrl('{{ route('members.edit', ['member' => $data->id]) }}')">수정</button>
            <button type="button" class="btn btn-primary">삭제</button>
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
                        <th>회원 번호</th>
                        <th>프로필</th>
                        <th>이름</th>
                        <th>닉네임</th>
                        <th>이메일</th>
                        <th>연락처</th>
                        <th>나이</th>
                        <th>주소</th>
                        <th>직업</th>
                        <th>성별</th>
                        <th>연애 상태</th>
                        <th>관심사</th>
                        <th>기분</th>
                        <th>선호 장르</th>
                        <th>분량</th>
                        <th>난이도</th>
                        <th>평균 독서량</th>
                        <th>포인트</th>
                        <th>가입일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td><img src="{{ $data->getProfileImage() }}" width="150"/></td>
                        <td>{{ $data->realname }}</td>
                        <td>{{ $data->nickname }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->age }}</td>
                        <td>
                            <p>{{ $data->address }}</p>
                            <p>{{ $data->address_detail }}</p>
                        </td>
                        <td>{{ $data->getJobString() }}</td>
                        <td>{{ $data->getGenderString() }}</td>
                        <td>{{ $data->getLoveString() }}</td>
                        <td>
                            @foreach($getInterestNames($data->interests) as $interest)
                                {!! $buildBadge($interest) !!}
                            @endforeach
                        </td>
                        <td>
                            @foreach($getFeelingNames($data->feelings) as $feeling)
                                {!! $buildBadge($feeling) !!}
                            @endforeach
                        </td>
                        <td>{{ $data->getGenreString() }}</td>
                        <td>{{ $data->getBookDifficultyString() }}</td>
                        <td>{{ $data->getBookSizeString() }}</td>
                        <td>{{ $data->avg_book_read_cnt }}</td>
                        <td>{{ $data->point }}</td>
                        <td>{{ $formatDefaultDate($data->created_at) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="accordion" id="memberDetail">

        <div class="card">
            <div class="card-header" id="headingMembership">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#detailMembership" aria-expanded="true" aria-controls="detailMembership">
                        <b><i class="fas fa-paper-plane"></i> 멤버십</b>
                    </button>
                </h2>
            </div>
            <div id="detailMembership" class="collapse" aria-labelledby="headingMembership" data-parent="#memberDetail">
                <div class="card-body">
                    @include('admin.members.includes.member_detail_membership', ['data' => $data])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingPoint">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#detailPoint" aria-expanded="false" aria-controls="detailPoint">
                        <b><i class="fas fa-coins"></i> 포인트 내역</b>
                    </button>
                </h2>
            </div>
            <div id="detailPoint" class="collapse" aria-labelledby="headingPoint" data-parent="#memberDetail">
                <div class="card-body">
                    @include('admin.members.includes.member_detail_point', ['data' => $data])
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingBookPayment">
                <h2 class="mb-0">
                    <a href="{{ route('book.payment.index', ['search' => 'ref_member_id', 'keyword' => $data->id]) }}" target="_blank" class="btn btn-link btn-block text-left collapsed">
                        <b><i class="fas fa-book"></i> 도서 구매 내역</b>
                    </a>
                </h2>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingBookRental">
                <h2 class="mb-0">
                    <a href="{{ route('book.loan.payment.index', ['search' => 'ref_member_id', 'keyword' => $data->id]) }}" target="_blank" class="btn btn-link btn-block text-left collapsed">
                        <b><i class="fas fa-shopping-bag"></i> 집대여 내역</b>
                    </a>
                </h2>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingBookRental">
                <h2 class="mb-0">
                    <a href="{{ route('offline.loan.index', ['search' => 'member_id', 'keyword' => $data->id]) }}" target="_blank" class="btn btn-link btn-block text-left collapsed">
                        <b><i class="fas fa-store"></i> 오프라인 대여 내역</b>
                    </a>
                </h2>
            </div>
        </div>
    </div>
@endsection

@push('body_scripts')
    <script>
        $(document).ready(function () {
            $('.collapse').on('shown.bs.collapse', function () {
                let dataTable = $(this).find('.data-table');
                if (dataTable.hasClass('dataTable') == false) {
                    dataTable.DataTable({
                        "scrollX": true,
                        order: [[0, "desc"]]
                    });
                }
            });
        });
    </script>
@endpush
