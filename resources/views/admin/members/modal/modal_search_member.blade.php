@inject('baseViewModel', 'App\ViewModels\Common\BaseViewModel)
<form name="memberSearchForm" onsubmit="return false">
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="input-group mb-3">
                    @foreach($search as $key => $values)
                        <select class="custom-select form-control"
                                name="{{$key}}">
                            @foreach($values[$baseViewModel::KEY_SEARCH_VALUES] as $itemKey => $itemValue)
                                <option value="{{ $itemKey }}"
                                        @if(isset($searchData[$key]) && $searchData[$key] == $itemKey)
                                        selected
                                    @endif
                                >{{ $itemValue }}</option>
                            @endforeach
                        </select>
                    @endforeach
                    <input type="text" class="form-control" name="keyword" id="search_keyword"
                           value="{{ $keyword }}"
                           style="width:60%;display: inline;"
                           placeholder="검색어를 입력해주세요"
                    />
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="BTN_search"
                                style="display: inline;">
                            검색
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-2 text-right">
                <span>
                    Total : {{ number_format($total) ?? 0 }}
                </span>
            </div>
        </div>
    </div>

    <div style="overflow-y: scroll;height:750px;">
        <table class="footable table table-stripped" data-page-size="1000" data-filter=#filter>
            <thead>
            <tr>
                <th class="text-center">번호</th>
                <th class="text-center">프로필</th>
                <th class="text-center">회원정보</th>
                <th class="text-center">가입일</th>
                <th class="text-center">선택</th>
            </tr>
            </thead>
            <tbody>
            @if($isSetList)
                @foreach($list as $item)
                    <tr>
                        <td class="text-center"><span class="member_id">{{ $item->id }}</span></td>
                        <td class="text-center"><img src="{{ $item->getProfileImage() }}" style="width: 100px"/></td>
                        <td>
                            <p><span class="member_email">{{ $item->email }}</span></p>
                            <p><span class="member_realname text-gray-900">{{ $item->realname }}</span> <span class="member_nickname">{{ $item->nickname }}</span></p>
                            <p><span class="member_phone">{{ $item->phone }}</span></p>
                        </td>
                        <td class="text-center">{{ $formatDefaultDate($item->created_at) }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success" onclick="selectMember({{ $item->id }});">선택</button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</form>

<script>
    $(function () {
        $("#BTN_search").on("click", function () {
            searchMember();
        });
        $("#search_keyword").on("keyup", function () {
            enterkey();
        });

        function enterkey() {
            if (window.event.keyCode == 13) {
                searchMember();
            }
        }
    });

    function searchMember() {
        axios({
            method: 'get',
            url: "{{ route('members.modal.search') }}?" + $(memberSearchForm).serialize(),
        }).then(res => {
            $('#basicModal .modal-body').html(res.data);
        }).catch(err => {
            helper.logger.log(err);
            alert(err.response.data.message);
        });
    }

    function selectMember(id) {
        axios({
            method: 'post',
            url: "{{ route('members.modal.select') }}",
            data: {
                id: id,
            }
        }).then(res => {
            if (typeof window['onselectedMember'] != 'undefined') {
                window['onselectedMember'](res);
            } else {
                onSelected(res);
            }
            $('#basicModal').modal("hide"); //닫기
        }).catch(err => {
            helper.logger.log(err);
        });
    }

    function onSelected(res) {
        let data = res.data.data;

        result.builder.setData('id', data.id);
        result.builder.setData('nickname', data.nickname);
        result.builder.setData('realname', data.realname);
        result.builder.setData('email', data.email);
        result.builder.setData('created_at', data.created_at);
        result.builder.setImage('profile_img', data.profile_img);

        frm.member_id.value = data.id;
    }
</script>
