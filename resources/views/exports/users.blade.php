<table>
    <thead>
        <tr>
            <th>
                Stt
            </th>
            <th>
                Tên Nhân Viên
            </th>
            <th>
                Số điện thoại
            </th>
            <th>
                Mật khẩu
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key=>$user)
        <tr>
            <td>{{++$key}}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->telephone }}</td>
            <td>{{ '123' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>