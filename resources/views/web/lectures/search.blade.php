@extends('web.lectures.index_template')

@section('list_content')
    <div class="search-result-wrap">
        <h3 class="title m-none">총 검색결과 <span class="search-total">{{ $total }}</span>건</h3>
        <ul class="search-result m-none">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('lectures.search', ['type' => $type, 'code' => $category->code, 'search' => 'title', 'keyword' => $searchData['keyword'] ?? '']) }}" >
                        {{ $category->getNumberText() }}(<span class="search-num">{{ isset($data[$category->code]) ? $data[$category->code]->count() : 0 }}</span>)
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    @foreach($categories as $category)
        @php
            $issetCode = isset($searchData['code']);
            $category = $getCategory($category->code);
            $items = $data[$category->code] ?? null;
            $items = $issetCode ? $items : (isset($items) ? $items->take(5) : null);
        @endphp
        @if(isset($items) && (!$issetCode || $category->code == $searchData['code']))
        <ul class="lecture-list-wrap">
            <div style="border-bottom:2px solid #212121; background-color:white; width:100%; padding:35px 30px; border-top:0px;font-size:18px;font-weight:600;">
                <strong style="bcolor:#212121; float:left;">
                    <a>{{ $category->getNumberText() }}({{ $items->count() }})건</a>
                </strong>

                @if(!$issetCode)
                <a href="{{ route('lectures.search', ['type' => $type, 'code' => $category->code, 'search' => 'title', 'keyword' => $searchData['keyword'] ?? '']) }}" style="color:green; float:right;">더보기</a>
                @endif
            </div>
            @foreach($items as $item)
                @include('web.lectures.index_item', ['item' => $item, 'style' => 'background-color: #eeeeee; padding:30px'])
            @endforeach
            <br/>
        @endif
        </ul>
    @endforeach
@endsection
