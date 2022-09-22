@extends('admin.layouts.index_template')

@section('sub_content')
    <x-table-search class="row" :title="$title" :header="$tableHeader" :search="$search" :link="$data" :searchData="$searchData">
        @foreach($data as $member)
                <tr>
                    <td width="10%">
                        <a href="#" onclick="loading.locateUrl('{{ route('members.show', ['member' => $member->id]) }}')">
                            {{ $member->id }}
                        </a>
                    </td>
                    <td width="10%">{{ $member->email }}</td>
                    <td width="10%">{{ $member->nickname }}</td>
                    <td width="10%">{{ $member->realname }}</td>
                    <td width="10%">{{ $member->age }}</td>
                    <td width="10%">{{ $member->getGenderString() }}</td>
                    <td width="10%">{{ $member->phone }}</td>
                    <td width="10%">{{ $member->getJobString() }}</td>
                    <td>{{ $formatDefaultDate($member->created_at) }}</td>
                </tr>
        @endforeach
    </x-table-search>
@endsection

@push('body_scripts')
    <script>

    </script>
@endpush
