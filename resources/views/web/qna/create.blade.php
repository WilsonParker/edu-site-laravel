@extends('web.layouts.app')
@php
    use App\Services\Auth\AuthService;
    $member = AuthService::getAuthMember()
@endphp
@section('content')
    <div id="section" class="page-qna">
        <div class="sub_navi">
            <ul>
                <li class="home"><a href="/">
                        <x-image src="images/common/icon_home.png" alt="홈으로"/>
                    </a></li>
                <li><span>학습지원센터</span>@include('web.layouts.includes.sub_menu')</li>
                <li><span>1:1상담</span>@include('web.boards.sub_menu_board')</li>
            </ul>
        </div>
        <div class="sub_banner">
            <div class="top_banner">
                <div class="txt">
                    <h2>학습지원센터</h2>
                    <p>이러닝 원격교육원에서 궁금증을 해결해드리겠습니다!</p>
                </div>
            </div>
            <h3>1:1상담</h3>
        </div>
        <div class="sub_content">

            <form name="counsel" method="post" action="{{ route('qna.store') }}" onSubmit="return Submit_Counsel();"
                  enctype="multipart/form-data">
                @csrf
                <table class="t_style33">
                    <tr>
                        <th>이름</th>
                        <td>{{ $member->id }}</td>
                    </tr>
                    <tr>
                        <th>제목</th>
                        <td><input type="text" name="title" maxlength="100" required value="{{ old('title', '') }}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>파일첨부</th>
                        <td>
                            <input type="file" id="file-input" name="file" value="첨부파일"/>
                            <label for="file-input" class="file-submit">첨부하기</label>
                            <div id="preview"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><textarea name="contents" required>{{ old('contents', '') }}</textarea></td>
                    </tr>
                </table>

                <div class="btn_box">
                    <input type="submit" class="btn_type02" value="완료"/>
                    <a href="{{ route('qna.index') }}" class="btn_type01 mr3">목록</a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('body_scripts')
    <script>
        function Submit_Counsel() {
            f = document.counsel;
            if (!TrimString(f.sp_title.value)) {
                alert('제목을 입력하세요');
                f.sp_title.focus();
                return false;
            }
            if (!TrimString(f.sp_memo.value)) {
                alert('내용을 입력하세요');
                f.sp_memo.focus();
                return false;
            }
            return true;
        }

        const handler = {
            init() {
                const fileInput = document.querySelector('#file-input');
                const preview = document.querySelector('#preview');
                const fileSubmit = document.querySelector('.file-submit')
                fileInput.addEventListener('change', () => {
                        console.dir(fileInput)
                        const files = Array.from(fileInput.files)
                        files.forEach(file => {
                            preview.innerHTML += `
					<p id="${file.lastModified}" class="file-text">
						${file.name}
						<button data-index='${file.lastModified}' class='file-remove'></button>
					</p>`;
                        });
                        fileSubmit.style.display = 'none'


                    },
                );
            },

            removeFile: () => {
                document.addEventListener('click', (e) => {
                    if (e.target.className !== 'file-remove') return;
                    const removeTargetId = e.target.dataset.index;
                    const removeTarget = document.getElementById(removeTargetId);
                    const files = document.querySelector('#file-input').files;
                    const dataTranster = new DataTransfer();
                    const fileSubmit = document.querySelector('.file-submit')


                    Array.from(files)
                        .filter(file => file.lastModified != removeTargetId)
                        .forEach(file => {
                            dataTranster.items.add(file);
                        });

                    document.querySelector('#file-input').files = dataTranster.files;

                    removeTarget.remove();
                    fileSubmit.style.display = 'inline-block'

                })
            }
        }

        handler.init()
        handler.removeFile()
    </script>
@endpush
