<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        $check_duplicate = User::where('telephone', trim($row['so_dien_thoai']))->get();
        if(empty($check_duplicate) || !isset($check_duplicate) || count($check_duplicate) == 0){
            return new User([
                'group_id'=>10,
                'usercode'=>$row['ma_nhan_vien'],
                'username'=>$row['ten_nhan_vien'],
                'password'=>Hash::make($row['mat_khau']),
                'telephone'=>trim($row['so_dien_thoai']),
                'email'=> 'no-email@example.com',
                'address'=> '',
                'province_id'=> 1,
                'id_number'=> '123',
                'description'=> '',
                'avatar'=> '',
                'bank_number'=> '',
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ]);
        }
    }

    public function startRow(): int
    {
        return 1;
    }
}
