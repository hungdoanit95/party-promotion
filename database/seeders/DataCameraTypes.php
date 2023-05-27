<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataCameraTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camera_types = [
            [
                'type_name' => 'Selfie',
                'limit' => 1,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 0,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Overview bên ngoài',
                'limit' => 1,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình sản phẩm',
                'limit' => 5,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 2,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình khách dùng bia',
                'limit' => 2,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình chủ tiệc nhận thưởng',
                'limit' => 1,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình voucher của chủ tiệc',
                'limit' => 2,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình trả thưởng người giới thiệu',
                'limit' => 1,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình voucher của người giới thiệu',
                'limit' => 1,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'type_name' => 'Hình biên bản trả thưởng',
                'limit' => 1,
                'type_option' => 'tc-ktc',
                'is_require' => 1,
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ];
        foreach($camera_types as $camera){
            DB::table('camera_types')->insert($camera);
        }
    }
}
