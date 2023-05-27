<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataReasons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            [
                'group_id' => 2,
                'reason_name' => 'CH tạm đóng cửa',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ],
            [
                'group_id' => 2,
                'reason_name' => 'CH ngừng kinh doanh',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ],
            [
                'group_id' => 2,
                'reason_name' => 'CH chuyển đổi kinh doanh',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ],
            [
                'group_id' => 2,
                'reason_name' => 'CH không tìm thấy',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ],
            [
                'group_id' => 2,
                'reason_name' => 'CH từ chối hợp tác',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ],
            [
                'group_id' => 2,
                'reason_name' => 'CH trùng',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ],
            [
                'group_id' => 2,
                'reason_name' => 'CH tham gia trưng bày',
                'reason_description' => '',
                'reason_deleted' => 0,
                'id_deleted' => 0
            ]
        ];
        foreach($reasons as $reason){
            DB::table('reasons')->insert($reason);
        }
    }
}
