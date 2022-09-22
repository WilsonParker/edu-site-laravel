@extends('web.boards.careful_template')
@section('sub_content')
    <div class="sub_content">
        <div class="program_box">
            <div class="sub_title">
                <p class="tit">동영상 실행에 필요한 프로그램을 설치합니다.</p>
            </div>
            <ul class="program_list">

                <li>
                    <div class="name">Windows Media Player9</div>
                    <div class="desc">Windows 2000이하(me/98/95)에서 사용 가능한 미디어 플레이어입니다.</div>
                    <div class="down"><a href="https://www.microsoft.com/ko-kr/download/details.aspx?id=3279"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">Windows Media Player10 (Windows XP)</div>
                    <div class="desc">Windows XP에서 사용 가능한 미디어 플레이어입니다.</div>
                    <div class="down"><a href="https://www.microsoft.com/ko-kr/download/details.aspx?id=20426"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">Windows Media Player11 (WindowsXP 이상)</div>
                    <div class="desc">Windows7/Vista/XP에서 사용 가능한 미디어 플레이어입니다.</div>
                    <div class="down"><a
                            href="http://www.microsoft.com/ko-kr/download/windows-media-player-details.aspx"
                            class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">DirectX</div>
                    <div class="desc">원활한 고화질 동영상 재생을 위한 Plug-in입니다.</div>
                    <div class="down"><a href="https://www.microsoft.com/ko-kr/download/details.aspx?id=35"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
            </ul>
        </div>

        <div class="program_box">
            <div class="sub_title">
                <p class="tit">문서관련 프로그램</p>
            </div>
            <ul class="program_list">
                <li>
                    <div class="name">MS 워드 뷰어</div>
                    <div class="desc">Microsoft Office Word로 작성된 자료파일을 보실 수 있습니다. (doc)</div>
                    <div class="down"><a href="https://www.microsoft.com/ko-kr/download/viewing-files.aspx"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">MS 엑셀 뷰어</div>
                    <div class="desc">Microsoft Office Excel로 작성된 자료파일을 보실 수 있습니다. (xls)</div>
                    <div class="down"><a href="https://www.microsoft.com/ko-kr/download/viewing-files.aspx"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">MS 파워포인트 뷰어</div>
                    <div class="desc">Microsoft Office Power Point로 작성된 자료파일을 보실 수 있습니다. (ppt)</div>
                    <div class="down"><a href="https://www.microsoft.com/ko-kr/download/viewing-files.aspx"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">한글2007</div>
                    <div class="desc">한글로 작성된 자료파일을 보실 수 있습니다. (hwp)</div>
                    <div class="down"><a href="http://www.hancom.com/cs_center/csDownload.do" class="program_btn"
                                         target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">훈민정음 뷰어</div>
                    <div class="desc">훈민정음으로 작성된 자료파일을 보실 수 있습니다. (gul)</div>
                    <div class="down"><a href="http://www.jungum.com/ReNew/Kr/Download/EtcDownload.html"
                                         class="program_btn" target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">Acrobat Reader9</div>
                    <div class="desc">PDF 형식의 자료파일을 보실 수 있습니다. (pdf)</div>
                    <div class="down"><a href="http://get.adobe.com/kr/reader/" class="program_btn"
                                         target="_blank">다운로드</a></div>
                </li>
            </ul>
        </div>

        <div class="program_box">
            <p class="tit">기타 프로그램</p>
            <ul class="program_list">
                <li>
                    <div class="name">Flash player 10</div>
                    <div class="desc">플래시가 브라우저에서 실행되기 위한 ActiceX Plug-in입니다.</div>
                    <div class="down"><a href="https://get.adobe.com/flashplayer/?loc=kr" class="program_btn"
                                         target="_blank">다운로드</a></div>
                </li>
                <li>
                    <div class="name">Shockwave player11</div>
                    <div class="desc">플래시가 브라우저에서 실행되기 위한 ActiceX Plug-in입니다.</div>
                    <div class="down"><a
                            href="https://www.adobe.com/kr/shockwave/download/triggerpages_mmcom/default.html"
                            target="_blank" class="program_btn">다운로드</a></div>
                </li>
                <li>
                    <div class="name">알집</div>
                    <div class="desc">첨부자료가 압축되어 있을 경우 압축을 풀어줍니다. (zip,alx,egg,rar 등)</div>
                    <div class="down"><a href="https://www.altools.co.kr/download/alzip.aspx" class="program_btn"
                                         target="_blank">다운로드</a></div>
                </li>
            </ul>
        </div>
    </div>
@endsection
