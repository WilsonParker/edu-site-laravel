@extends('web.members.index_template')

@section('sub_content')
    <div class="sub_content">
        <div class="table-responsive">
            <table class="t_style37">
                <tr>
                    <th>구분</th>
                    <th>과정명</th>
                    <th>결제금액</th>
                    <th>결제수단</th>
                    <th>주문일(결제일)</th>
                    <th>상태</th>
                    <th>비고</th>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $loop->remaining + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ $item->method->name }}</td>
                        <td>{{ $item->paid_at }}</td>
                        <td>{{ $item->getPaidStatusString() }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
            <div class="pager_box_boot">
            </div>
        </div>
    </div>
@endsection
