<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataStores extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
            [
                'store_code'=>'HCMQ02-001',
                'store_code_new'=>'',
                'store_name'=>'HAI TÍN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'60 Trần Não, P. Bình An, Quận 2, Hồ Chí Minh',
                'asm_name'=>'Chị Lan',
                'asm_phone'=>'0389392372',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ02-002',
                'store_code_new'=>'',
                'store_name'=>'DÊ HƯƠNG SƠN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'81/1, Trần Não, P. Bình An, Quận 2, Hồ Chí Minh',
                'asm_name'=>'Chị Lan',
                'asm_phone'=>'0389392372',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ02-003',
                'store_code_new'=>'',
                'store_name'=>'HKD VỊT QUANG MINH',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'54 Đường 36, P. An Phú, Quận 2, Hồ Chí Minh',
                'asm_name'=>'Chị Lan',
                'asm_phone'=>'0389392372',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ02-004',
                'store_code_new'=>'',
                'store_name'=>'LÃO TRƯ',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'12-14, Song Hành, P. An Phú, Quận 2, Hồ Chí Minh',
                'asm_name'=>'Chị Lan',
                'asm_phone'=>'0389392372',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ02-005',
                'store_code_new'=>'',
                'store_name'=>'ĐẦM TÔM 2',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'19 Song Hành, P. An Phú, Quận 2, Hồ Chí Minh',
                'asm_name'=>'Chị Lan',
                'asm_phone'=>'0389392372',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ10-001',
                'store_code_new'=>'',
                'store_name'=>'VƯỜN ỐC WONGNAI',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'268	Tô Hiến Thành, P. 15, Quận 10, Hồ Chí Minh',
                'asm_name'=>'Chị Hằng',
                'asm_phone'=>'0982294298',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ10-002',
                'store_code_new'=>'',
                'store_name'=>'HKD VÕ TRẦN MINH TÂN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'35/2-4 Đồng Nai, P. 15, Quận 10, Hồ Chí Minh',
                'asm_name'=>'Chị Hằng',
                'asm_phone'=>'0982294298',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ10-003',
                'store_code_new'=>'',
                'store_name'=>'CÒNG GIÓ QUÁN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'Hẻm 796	Sư Vạn Hạnh, P. 12, Quận 10, Hồ Chí Minh',
                'asm_name'=>'Chị Hằng',
                'asm_phone'=>'0982294298',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ10-004',
                'store_code_new'=>'',
                'store_name'=>'XÓM CHÀI ÔNG NẨU',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'30-32 Đồng Nai, P. 15, Quận 10, Hồ Chí Minh',
                'asm_name'=>'Chị Hằng',
                'asm_phone'=>'0982294298',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ10-005',
                'store_code_new'=>'',
                'store_name'=>'CẠN LY',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'Số 7 Nguyễn Giản Thanh, P. 15, Quận 10, Hồ Chí Minh',
                'asm_name'=>'Chị Hằng',
                'asm_phone'=>'0982294298',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQGV-001',
                'store_code_new'=>'',
                'store_name'=>'QUÁN 10 EM',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'50 Phạm Văn Đồng, P. 3, Gò Vấp, Hồ Chí Minh',
                'asm_name'=>'Trần Thị Hoa',
                'asm_phone'=>'0934159200',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQGV-002',
                'store_code_new'=>'',
                'store_name'=>'TÁ LẢ QUÁN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'339	Phạm Văn Đồng, P. 1, Gò Vấp, Hồ Chí Minh	',
                'asm_name'=>'Trần Thị Hoa',
                'asm_phone'=>'0934159200',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQGV-003',
                'store_code_new'=>'',
                'store_name'=>'HKD NƯỚNG NGÓI SÀI GÒN (CN2)',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'201	Phạm Văn Đồng, P. 1, Gò Vấp, Hồ Chí Minh',
                'asm_name'=>'Trần Thị Hoa',
                'asm_phone'=>'0934159200',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQGV-004',
                'store_code_new'=>'',
                'store_name'=>'PANDA BBQ',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'151	Phạm Văn Đồng, P. 3, Gò Vấp, Hồ Chí Minh',
                'asm_name'=>'Trần Thị Hoa',
                'asm_phone'=>'0934159200',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQGV-005',
                'store_code_new'=>'',
                'store_name'=>'TÀI VƯỢNG',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'35 Phạm Văn Đồng, P. 3, Gò Vấp, Hồ Chí Minh	',
                'asm_name'=>'Trần Thị Hoa',
                'asm_phone'=>'0934159200',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ12-001',
                'store_code_new'=>'',
                'store_name'=>'QUÁN MỘC',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'79, Phan Văn Hớn, P. Tân Thới Nhất, Quận 12, Hồ Chí Minh',
                'asm_name'=>'Huỳnh Thị Lý',
                'asm_phone'=>'0908934878',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ12-002',
                'store_code_new'=>'',
                'store_name'=>'NẬM NƯỚNG',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'58 Phan Văn Hớn, P. Tân Thới Nhất, Quận 12, Hồ Chí Minh	',
                'asm_name'=>'Huỳnh Thị Lý',
                'asm_phone'=>'0908934878',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ12-003',
                'store_code_new'=>'',
                'store_name'=>'BA MAO',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'13/1 Nguyễn Văn Quá, P. Đông Hưng Thuận, Quận 12, Hồ Chí Minh',
                'asm_name'=>'Huỳnh Thị Lý',
                'asm_phone'=>'0908934878',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ12-004',
                'store_code_new'=>'',
                'store_name'=>'QUÁN 74',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'39 Song Hành, P. Tân Hưng Thuận, Quận 12, Hồ Chí Minh',
                'asm_name'=>'Huỳnh Thị Lý',
                'asm_phone'=>'0908934878',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ12-005',
                'store_code_new'=>'',
                'store_name'=>'QUÁN PHÚ GIA',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'154/3 Trường Chinh, P. Tân Hưng Thuận, Quận 12, Hồ Chí Minh',
                'asm_name'=>'Huỳnh Thị Lý',
                'asm_phone'=>'0908934878',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMHBC-001',
                'store_code_new'=>'',
                'store_name'=>'HKD TƯ KẾ',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'E1 KDC Hồ Bắc Ấp 3, X. Tân Kiên, Bình chánh, Hồ Chí Minh',
                'asm_name'=>'Nguyễn Thị Thảo',
                'asm_phone'=>'0906633861',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMHBC-002',
                'store_code_new'=>'',
                'store_name'=>'NGỌC NGHIỆP',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'A11/10B	Hưng Nhơn Ấp 1, X. Tân Kiên, Bình chánh, Hồ Chí Minh',
                'asm_name'=>'Nguyễn Thị Thảo',
                'asm_phone'=>'0906633861',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMHBC-003',
                'store_code_new'=>'',
                'store_name'=>'BỜ KÈ',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'E8/14H Nguyễn Hữu Trí, Tt. Tân Túc, Bình chánh, Hồ Chí Minh',
                'asm_name'=>'Nguyễn Thị Thảo',
                'asm_phone'=>'0906633861',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMHBC-004',
                'store_code_new'=>'',
                'store_name'=>'LẨU DÊ TÀI KÝ',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'B1/7D Ấp 2 Nguyễn Hữu Trí, Tt. Tân Túc, Bình chánh, Hồ Chí Minh',
                'asm_name'=>'Nguyễn Thị Thảo',
                'asm_phone'=>'0906633861',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMHBC-005',
                'store_code_new'=>'',
                'store_name'=>'DÊ 135',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'E8/15A Nguyễn Hữu Trí, Tt. Tân Túc, Bình chánh, Hồ Chí Minh',
                'asm_name'=>'Nguyễn Thị Thảo',
                'asm_phone'=>'0906633861',
                'survey_group_ids'=>1,
                'store_note'=>'',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ03-001',
                'store_code_new'=>'',
                'store_name'=>'ỐC NHƯ TÂM',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'103	Rạch Bùng Binh, P. 9, Quận 3, Hồ Chí Minh',
                'asm_name'=>'Lê Thị Thủy',
                'asm_phone'=>'0967145642',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ03-002',
                'store_code_new'=>'',
                'store_name'=>'GIÓ BIỂN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'112B Rạch Bùng Binh, P. 9, Quận 3, Hồ Chí Minh',
                'asm_name'=>'Lê Thị Thủy',
                'asm_phone'=>'0967145642',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ03-003',
                'store_code_new'=>'',
                'store_name'=>'XIÊN KHÈ 2 ( XIÊN KHÈ KOOZI)',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'782	Trường Sa, P. 14, Quận 3, Hồ Chí Minh',
                'asm_name'=>'Lê Thị Thủy',
                'asm_phone'=>'0967145642',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ03-004',
                'store_code_new'=>'',
                'store_name'=>'XIÊN KHÈ BLISS',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'801	Hoàng Sa, P. 11, Quận 3, Hồ Chí Minh',
                'asm_name'=>'Lê Thị Thủy',
                'asm_phone'=>'0967145642',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ03-005',
                'store_code_new'=>'',
                'store_name'=>'ỐC CHILL (BACK UP: PHƯỚC ĐẠT)',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'55 (84)	Rạch Bùng Binh (Nguyễn Thông), P. 9, Quận 3, Hồ Chí Minh',
                'asm_name'=>'Lê Thị Thủy',
                'asm_phone'=>'0967145642',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                
                
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_code'=>'HCMQ08-001',
                'store_code_new'=>'',
                'store_name'=>'QUÁN ÔNG TIÊN',
                'store_phone'=>'',
                'province_id'=>1,
                'address'=>'225 Phạm Thế Hiển, P. 3, Quận 8, Hồ Chí Minh',
                'asm_name'=>'Nguyễn Ngọc Thùy Trân',
                'asm_phone'=>'0908733687',
                'survey_group_ids'=>1,
                'store_note'=>'5 tặng 1',
                'level'=>'',
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ];
        foreach($stores as $store){
            DB::table('stores')->insert($store);
        }
    }
}
