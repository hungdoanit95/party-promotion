<table>
    <thead>
        <tr>
            <th>
                Stt
            </th>
            <th>
                Khu vực
            </th>
            <th>
                Mã NPP
            </th>
            <th>
                Tên NPP
            </th>
            <th>
                ASM
            </th>
            <th>
                SĐT ASM
            </th>
            <th>
                Mã Sabeco
            </th>
            <th>
                Mã CPS
            </th>
            <th>
                Tên CH
            </th>
            <th>
                Số nhà
            </th>
            <th>
                Đường
            </th>
            <th>
                Phường/Xã
            </th>
            <th>
                Quận/ Huyện
            </th>
            <th>
                Tỉnh/ TP
            </th>
            <th>
                SĐT CỬA HÀNG
            </th>
            <th>
                KINH ĐỘ
            </th>
            <th>
                VĨ ĐỘ
            </th>
            <th>
                Ghi chú admin
            </th>
            <th>
                NHÂN VIÊN
            </th>
            <th>
                SDT N.VIÊN
            </th>
            <th>
                PASS
            </th>
            <th>
                Start date
            </th>
            <th>
                End date
            </th>
            <th>
                Plan name
            </th>
            <th>
                Date Checkin
            </th>
            <th>
                Time Checkin
            </th>
            <th>
                Kết quả thực hiện
            </th>
            <th>
                Ghi chú nhân viên
            </th>
            <th>
                Lý do KTC
            </th>
            <th>
                Sl thùng Special (Trước TB)
            </th>
            <th>
                Sl thùng chill (Trước TB)
            </th>
            <th>
                Sl thùng Special (Sau TB)
            </th>
            <th>
                Sl thùng chill (Sau TB)
            </th>
            <th>
                Link web
            </th>
            <th>
                Link
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($plans as $key=>$plan)
        <tr>
            <td>
                {{ ++$key }}
            </td>
            <td>
                {{ $plan['region'] }}
            </td>
            <td>
                {{ $plan['distributor_code'] }}
            </td>
            <td>
                {{ $plan['distributor_name'] }}
            </td>
            <td>
                {{ $plan['asm_name'] }}
            </td>
            <td>
                {{ $plan['asm_phone'] }}
            </td>
            <td>
                {{ $plan['store_code_new'] }}
            </td>
            <td>
                {{ $plan['store_code'] }}
            </td>
            <td>
                {{ $plan['store_name'] }}
            </td>
            <td>
            </td>
            <td>
                {{ $plan['number_address'] }}
            </td>
            <td>
                {{ $plan['street_address'] }}
            </td>
            <td>
                {{ $plan['ward_address'] }}
            </td>
            <td>
                {{ $plan['district_address'] }}
            </td>
            <td>
                {{ $plan['store_phone'] }}
            </td>
            <td>
                {{ $plan['lat'] }}
            </td>
            <td>
                {{ $plan['long'] }}
            </td>
            <td>
                {{ $plan['note_admin'] }}
            </td>
            <td>
                {{ $plan['user_name'] }}
            </td>
            <td>
                {{ $plan['user_phone'] }}
            </td>
            <td>
                123
            </td>
            <td>
                {{ $plan['date_start'] }}
            </td>
            <td>
                {{ $plan['date_end'] }}
            </td>
            <td>
                {{ $plan['plan_name'] }}
            </td>
            <td>
                {{ $plan['date_checkin'] }}
            </td>
            <td>
                {{ $plan['time_checkin'] }}
            </td>
            <td>
                {{ ($plan['result'] == 1)?'Thành công': ($plan['result'] == 2?'KTC':'') }}
            </td>
            <td>
                {{ $plan['staff_note'] }}
            </td>
            <td>
                {{ $plan['reason_name'] }}
            </td>
            <td>
                {{ $plan['data1'] }}
            </td>
            <td>
                {{ $plan['data2'] }}
            </td>
            <td>
                {{ $plan['data3'] }}
            </td>
            <td>
                {{ $plan['data4'] }}
            </td>
            <td>
                <a href="{{ 'http://omafox.com/get-info-plan/'.$plan['plan_id'] }}" >Link web</a>
            </td>
            <td>
                {{ 'http://omafox.com/get-info-plan/'.$plan['plan_id'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>