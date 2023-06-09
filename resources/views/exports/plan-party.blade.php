<table>
    <thead>
        <tr>
            <th>
                Stt
            </th>
            <th>
                Mã tiệc
            </th>
            <th>
                Mã nhân viên
            </th>
            <th>
                Ghi chú
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($plan_parties as $key=>$plan_party)
        <tr>
            <td>
                {{ ++$key }}
            </td>
            <td>
                {{ $plan_party['party_code'] }}
            </td>
            <td>
                {{ $plan_party['usercode'] }}
            </td>
            <td>
                {{ $plan_party['note_admin'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>