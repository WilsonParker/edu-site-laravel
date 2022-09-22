<table>
    <thead>
    <tr>
        <th>수강비</th>
        <th>훈련 기관 코드</th>
        <th>NCS 코드</th>
        <th>실제 훈련비</th>
        <th>수강신청 인원</th>
        <th>제목</th>
        <th>부제목</th>
        <th>훈련종료일자</th>
        <th>훈련시작일자</th>
        <th>훈련구분</th>
        <th>훈련기관ID</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
    <tr>
        <td>{{ $item->course_man }}</td>
        <td>{{ $item->inst_cd }}</td>
        <td>{{ $item->ncs_cd }}</td>
        <td>{{ $item->real_man }}</td>
        <td>{{ $item->reg_course_man }}</td>
        <td>{{ $item->title }}</td>
        <td>{{ $item->sub_title }}</td>
        <td>{{ $item->tra_end_date }}</td>
        <td>{{ $item->tra_start_date }}</td>
        <td>{{ $item->train_target }}</td>
        <td>{{ $item->trainst_cst_id }}</td>
    </tr>
    @endforeach
    </tbody>
