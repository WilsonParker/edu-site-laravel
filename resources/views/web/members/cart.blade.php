@extends('web.members.index_template')

@section('sub_content')
    <form action="{{ route('lectures.payments.cart') }}" method="get">
        <div class="table-responsive">
            <table class="t_style37">
                <tr>
                    <th>선택</th>
                    <th>강의명</th>
                    <th>학습기간</th>
                    <th>금액</th>
                    <th></th>
                </tr>

                @foreach($data as $item)
                    <tr>
                        <td><input type="checkbox" class="cart_no" name="idx[]" value="{{ $item->idx }}" data-price="{{ $item->lecture->price }}"/></td>
                        <td class="tit">{{ $item->lecture->title }}</td>
                        <td><span>{{ $formatDefaultDate(now()) }}</span> ~ <span>{{ $formatDefaultDate($item->lecture->normalPrograms->first()->getLearningEndDate()) }}</span></td>
                        <td><span class="cart_price">{{ number_format($item->lecture->price) }}</span></td>
                        <td>
                            <button class="text_icon02" style="padding:7px; cursor:pointer" onclick="deleteCart('{{ route('members.carts.destroy', $item) }}')">삭제</button>
                        </td>
                    </tr>
                @endforeach
            </table>

            <div id="sum" style="text-align:center">상품주문합계 : <span id="total">0</span> 원</div>
            <div style="text-align:center">
                <input type="button" class="text_icon01" value="선택삭제" style="padding:7px; cursor:pointer" onclick="deleteCarts()"/>
                <input type="submit" class="text_icon02" value="주문하기" style="padding:7px; cursor:pointer"/>
            </div>
        </div>
    </form>
@endsection
@push('body_scripts')
    <script>
        $(function() {
            $(".cart_no").on('change', function() {
                let totalPrice = 0;
                $('.cart_no:checked').each(function(index, item) {
                    totalPrice += Number($(item).attr('data-price'));
                });
                $('#total').html(numberWithCommas(totalPrice));
            });
        })

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function deleteCart(url) {
            axios.delete(url)
                .then((result) => {
                    location.reload();
                }).catch((error) => {
                    modal.setContent(error.response.data.message);
                    modal.show();
                });
        }

        function deleteCarts() {
            let checked = $('.cart_no:checked').map((index, item) => $(item).val()).toArray();
            axios({
                method : 'delete',
                url : '{{ route('members.carts.deletes') }}',
                data : { carts : checked}
            }).then((result) => {
                location.reload();
            }).catch((error) => {
                modal.setContent(error.response.data.message);
                modal.show();
            });
        }
    </script>
@endpush
