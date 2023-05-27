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
                GHI CHÚ CỬA HÀNG
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
                Kết quả TC/KTC
            </th>
            <th>
                Kết quả Đạt/Rớt
            </th>
            <th>
                Ghi chú nhân viên
            </th>
            <th>
                Lý do KTC
            </th>
            <th>
                Bia Sài Gòn Special (Trước TB)
            </th>
            <th>
                Bia Sài Gòn Chill (Trước TB)
            </th>
            <th>
                Bia Sài Gòn 333 (Trước TB)
            </th>
            <th>
                Bia Sài Gòn export (Trước TB)
            </th>
            <th>
                Bia Sài Gòn Lạc Việt (Trước TB)
            </th>
            <th>
                Bia Sài Gòn Gold (Trước TB)
            </th>
            <th>
                Bia Sài Gòn Lager (Trước TB)
            </th>
            <th>
                Bia Sài Gòn Chill (Sau TB)
            </th>
            <th>
                Bia Sài Gòn Special (Sau TB)
            </th>
            <th>
                Bia Sài Gòn 333 (Sau TB)
            </th>
            <th>
                Bia Sài Gòn export (Sau TB)
            </th>
            <th>
                Bia Sài Gòn Lạc Việt (Sau TB)
            </th>
            <th>
                Bia Sài Gòn Gold (Sau TB)
            </th>
            <th>
                Bia Sài Gòn Lager (Sau TB)
            </th>
            <th>
                QC / Chưa QC
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
        @foreach($data_plans as $key=>$plan)
        <tr>
            <td>
                {{ ++$key }}
            </td>
            <td>
                {{ $plan->region }}
            </td>
            <td>
                {{ $plan->distributor_code }}
            </td>
            <td>
                {{ $plan->distributor_name }}
            </td>
            <td>
                {{ $plan->asm_name }}
            </td>
            <td>
                {{ $plan->asm_phone }}
            </td>
            <td>
                {{ $plan->store_code_new }}
            </td>
            <td>
                {{ $plan->store_code }}
            </td>
            <td>
                {{ $plan->store_name }}
            </td>
            <td>
                {{ $plan->number_address }}
            </td>
            <td>
                {{ $plan->street_address }}
            </td>
            <td>
                {{ $plan->ward_address }}
            </td>
            <td>
                {{ $plan->district_address }}
            </td>
            <td>
                {{ $plan->province_address }}
            </td>
            <td>
                {{ $plan->store_phone }}
            </td>
            <td>
                {{ $plan->lat }}
            </td>
            <td>
                {{ $plan->long }}
            </td>
            <td>
                {{ $plan->note_admin }}
            </td>
            <td>
                {{ $plan->user_name }}
            </td>
            <td>
                {{ $plan->user_phone }}
            </td>
            <td>
                123
            </td>
            <td>
                {{ $plan->date_start }}
            </td>
            <td>
                {{ $plan->date_end }}
            </td>
            <td>
                {{ $plan->plan_name }}
            </td>
            <td>
                {{ $plan->date_checkin }}
            </td>
            <td>
                {{ $plan->time_checkin }}
            </td>
            <td>
                {{ ($plan->plan_status == 1)?'Thành công': ($plan->plan_status == 2?'KTC':'Chưa làm') }}
            </td>
            <td>
                {{ (isset($plan->status_result) || !empty($plan->plan_status))?(($plan->status_result == 'Đạt' && $plan->plan_status == 1)?'Đạt':'Rớt'):''}}
            </td>
            <td>
                {{ $plan->staff_note }}
            </td>
            <td>
                {{ $plan->reason_name }}
            </td>
            <td>
                {{ !empty($plan->data_survey[1])?$plan->data_survey[1]:'' }}
            </td>
            <td>
                {{ !empty($plan->data_survey[2])?$plan->data_survey[2]:'' }}
            </td>
            <td>
                {{ !empty($plan->data_survey[3])?$plan->data_survey[3]:'' }}
            </td>
            <td>
                {{ !empty($plan->data_survey[4])?$plan->data_survey[4]:'' }}
            </td>
            <th>
                {{ !empty($plan->data_survey[5])?$plan->data_survey[5]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[6])?$plan->data_survey[6]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[7])?$plan->data_survey[7]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[8])?$plan->data_survey[8]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[9])?$plan->data_survey[9]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[10])?$plan->data_survey[10]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[11])?$plan->data_survey[11]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[12])?$plan->data_survey[12]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[13])?$plan->data_survey[13]:'' }}
            </th>
            <th>
                {{ !empty($plan->data_survey[14])?$plan->data_survey[14]:'' }}
            </th>
            <td>
                {{ !empty($plan->user_qc_id)?'Đã Qc': 'Chưa Qc' }}
            </td>
            <td>
                <a href="{{ 'http://omafox.com/get-info-plan/'.$plan->plan_id }}" >Link web</a>
            </td>
            <td>
                {{ 'http://omafox.com/get-info-plan/'.$plan->plan_id }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>