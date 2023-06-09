<?php

namespace App\Imports;

use App\Models\Parties;
use App\Models\PlanParty;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PlanPartyImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        $party_info = Parties::where('party_code',trim($row[2]))->select('id')->first();
        if(isset($party_info)){
            $party_id = $party_info->id;
        }else{
            $party_id = 0;
        }
        $user_info = User::where('usercode',trim($row[1]))->select('id')->first();
        if(isset($user_info)){
            $user_id = $user_info->id;
        }else{
            $user_id = 0;
        }
        $message_error = '';
        $status = 0; 
        if($party_id != 0 && $user_id != 0){
            if(empty($check_duplicate) && !empty($user_id)){
                return new PlanParty([
                  'party_id' => $party_id,
                  'user_id' => $user_id
                ]);
            }else{
                $message_error = 'Không tồn tại: <br />';
                if($party_id == 0){
                    $message_error .= ' Mã tiệc: '. $row[2] . '<br />';
                }
                if($user_id == 0){
                    $message_error .= ' Mã nhân viên: '. $row[1] . '<br />';
                }
                return $message_error;
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
