<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataParties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
      $parties = [
        [
          'party_code' => 'VC-HCM000001', //Mã tiệc
          'introducer_name' => 'Đoàn Anh Lê Hưng', // tên người giới thiệu 
          'introducer_phone' => '0979 289 479', // Số điện thoại người giới thiệu
          'party_host_name' => 'Đoàn Hưng Anh Lê', // Tên chủ tiệc
          'party_host_phone' => '037 628 5051', // Số điện thoại chủ tiệc
          'party_type' => 'Sinh Nhật', // Loại tiệc
          'party_level' => '1', // Mức tiệc
          'beer_type' => 'Blanc', // Loại bia
          'organization_date' => '24-01-2023', // Ngày diễn ra tiệc
          'organization_time' => '14:30:00', // Thời gian tổ chức
          'province' => 'Hồ Chí Minh', // Tỉnh thành phố
          'district' => 'Bình Thạnh', // Quận huyện
          'ward' => 'Phường 4', // Xã phường
          'street' => 'Điện Biên Phủ', // Tên đường
          'home_number' => '8', // Số nhà
          'notes' => 'Có thể đặt thêm bia Sài Gòn', // Ghi chú
          'distributor' => 'NPP 1', // Mã nhà phân phối
          'point_of_salename' => 'Bình Thạnh', // Điểm bán
          'point_of_salephone' => '0949 683 558', // Số điện thoại điểm bán
          'user_id' => 1,
          'status' => 1
        ]
      ];
      foreach($parties as $party){
          DB::table('parties')->insert($party);
      }
    }
}
