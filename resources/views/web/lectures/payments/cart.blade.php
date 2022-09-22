@extends('web.lectures.payments.template')

@section('sub_title')
    <span>(총 {{ $data->count() }}개)</span>
@endsection

@section('content')
    @foreach($data as $item)
        @php($program = $item->lecture->normalPrograms->first())
        <div class="lec-list">
            <h2 class="title">{{ $item->lecture->title }}</h2>
            <table class="ncs-table">
                <thead class="hidden">
                <tr>
                    <th scope="col">분류</th>
                    <th scope="col">내용</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row" class="w-active">학습 기간</th>
                    <td>{{ $formatDefaultDate(now()) }}~ {{ $formatDefaultDate($program->getLearningEndDate()) }}</td>
                    <th scope="row" class="w-active">복습 기간</th>
                    <td>{{ $formatDefaultDate($program->getReviewStartDate()) }}~ {{ $formatDefaultDate($program->getReviewEndDate()) }}</td>
                </tr>
                <tr>
                    <th scope="row" class="w-active">신청 유형</th>
                    <td>일반과정</td>
                    <th scope="row" class="w-active">NCS 직무분류</th>
                    <td>{{ $item->lecture->category->getNumberText() }}</td>
                </tr>
                <tr class="last">
                    <th scope="row" class="w-active">결제 금액</th>
                    <td class="total">{{ number_format($item->lecture->price) }}원</td>
                    <th scope="row"></th>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    @endforeach
@endsection

@push('body_scripts')
    <script>
        function AddCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function payment() {

        }
    </script>
@endpush
