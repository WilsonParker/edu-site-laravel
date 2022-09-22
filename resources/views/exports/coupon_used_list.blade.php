<table>
    <thead>
    <tr>
        <th>코드</th>
        <th>아이디</th>
        <th>이름</th>
        <th>연락처</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
    <tr>
        <td>{{ $item->cp_id }}</td>
        <td>{{ $item->user_id }}</td>
        <td>{{ $item->member->user_name }}</td>
        <td>{{ $item->member->mobile }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
