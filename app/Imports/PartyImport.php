<?php

namespace App\Imports;

use App\Models\Parties;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PartyImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check_duplicate = Parties::where('party_code',trim($row[2]))->where('route_plan',trim($row[1]))->first();
        if(empty($check_duplicate)){
            return new Parties([
              'route_plan' => isset($row[1])?$row[1]:'',
              'party_code' => isset($row[2])?$row[2]:'',
              'introducer_name' => isset($row[3])?$row[3]:'',
              'avatar' => '',
              'introducer_phone' => isset($row[4])?$row[4]:'',
              'party_host_name' => isset($row[5])?$row[5]:'',
              'party_host_phone' => isset($row[6])?$row[6]:'',
              'party_type' => isset($row[7])?$row[7]:'',
              'party_level' => isset($row[8])?$row[8]:'',
              'beer_type' => isset($row[9])?$row[9]:'',
              'organization_date' => isset($row[10])?$row[10]:'',
              'organization_time' => isset($row[11])?$row[11]:'',
              'province' => isset($row[12])?$row[12]:'',
              'district' => isset($row[13])?$row[13]:'',
              'ward' => isset($row[14])?$row[14]:'',
              'street' => isset($row[15])?$row[15]:'',
              'home_number' => isset($row[16])?$row[16]:'',
              'notes' => isset($row[17])?$row[17]:'',
              'distributor' => isset($row[18])?$row[18]:'',
              'point_of_salename' => isset($row[19])?$row[19]:'',
              'point_of_salephone' => isset($row[20])?$row[20]:'',
              'status' =>  1
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
