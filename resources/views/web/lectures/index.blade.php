@extends('web.lectures.index_template')

@section('list_content')
    <h2 class="title"> {{ $getSelectedCategoryTitle }}</h2>

    @foreach($data as $item)
        @include('web.lectures.index_item', ['item' => $item])
    @endforeach
@endsection

@section('pagination')
    <div class="pagination">
        {{ $data->appends($searchData)->links() }}
    </div>
@endsection

@push('body_scripts')
@endpush
