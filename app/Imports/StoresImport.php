<?php

namespace App\Imports;

use App\Models\Store;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StoresImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check_duplicate = Store::where('store_code',trim($row[7]))->first();
        if(empty($check_duplicate) && !empty($row[7])){
            return new Store([
                'store_code'=>$row[7]?trim($row[7]):'.',
                'store_code_new'=>'',
                'store_name'=>$row[8]?$row[8]:'.',
                'store_phone'=>$row[14]?trim($row[14]):'.',
                'lat'=>$row[15]?$row[15]:0,
                'long'=>$row[16]?$row[16]:0,
                'province_id'=>1,
                'address'=>($row[9]?$row[9]:'.').' '.($row[10]?$row[10]:'.').','.($row[11]?$row[11]:'.').','.($row[12]?$row[12]:'.').','.($row[13]?$row[13]:'.'),
                'asm_name'=>($row[4]?$row[4]:'.'),
                'asm_phone'=>($row[5]?$row[5]:'.'),
                'survey_group_ids'=>1,
                'store_note'=>($row[17]?$row[17]:'.'),
                'distributor_name'=>($row[2]?$row[2]:'.'),
                'region'=>($row[1]?$row[1]:'.'),
                'status'=>1,
                'level'=> '',
                'created_at'=>date('Y-m-d H:i:s')
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
