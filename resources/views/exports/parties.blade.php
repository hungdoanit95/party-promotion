<table>
    <thead>
        <tr>
            <th>
                Stt
            </th>
            <th>
                Tháng
            </th>
            <th>
                Mã tiệc
            </th>
            <th>
                Tên người giới thiệu
            </th>
            <th>
                Sdt người giới thiệu
            </th>
            <th>
                Tên chủ tiệc
            </th>
            <th>
                Sdt chủ tiệc
            </th>
            <th>
                Loại tiệc
            </th>
            <th>
                Mức trả thưởng
            </th>
            <th>
                Loại bia
            </th>
            <th>
                Ngày tổ chức
            </th>
            <th>
                Giờ tổ chức
            </th>
            <th>
                Số nhà
            </th>
            <th>
                Tên đường
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
                Nhà phân phối
            </th>
            <th>
                Điểm bán
            </th>
            <th>
                SDT điểm bán
            </th>
            <th>
                Ghi chú
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($parties as $key=>$party)
        <tr>
            <td>
                {{ ++$key }}
            </td>
            <td>
                {{ $party['route_plan'] }}
            </td>
            <td>
                {{ $party['party_code'] }}
            </td>
            <td>
                {{ $party['introducer_name'] }}
            </td>
            <td>
                {{ $party['introducer_phone'] }}
            </td>
            <td>
                {{ $party['party_host_name'] }}
            </td>
            <td>
                {{ $party['party_host_phone'] }}
            </td>
            <td>
                {{ $party['party_type'] }}
            </td>
            <td>
                {{ $party['party_level'] }}
            </td>
            <td>
                {{ $party['beer_type'] }}
            </td>
            <td>
                {{ $party['organization_date'] }}
            </td>
            <td>
                {{ $party['organization_time'] }}
            </td>
            <td>
                {{ $party['home_number'] }}
            </td>
            <td>
                {{ $party['street'] }}
            </td>
            <td>
                {{ $party['ward'] }}
            </td>
            <td>
                {{ $party['district'] }}
            </td>
            <td>
                {{ $party['province'] }}
            </td>
            <td>
                {{ $party['distributor'] }}
            </td>
            <td>
                {{ $party['point_of_salename'] }}
            </td>
            <td>
                {{ $party['point_of_salephone'] }}
            </td>
            <td>
                {{ $party['notes'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>