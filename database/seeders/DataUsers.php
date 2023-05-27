<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'group_id'=>10,
                'username'=>'NGUYỄN TRÚC VI NA',
                'password'=>Hash::make(123),
                'telephone'=>'0399834770',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'TRẦN THỊ HỒNG DUYÊN',
                'password'=>Hash::make(123),
                'telephone'=>'0978181314',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'BÙI THỊ THÚY AN',
                'password'=>Hash::make(123),
                'telephone'=>'0965222667',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'LÊ NGỌC QUỲNH NHƯ',
                'password'=>Hash::make(123),
                'telephone'=>'0948281706',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN NGỌC HUỲNH NHƯ',
                'password'=>Hash::make(123),
                'telephone'=>'0799553006',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'HỒ THỊ THU THUỶ',
                'password'=>Hash::make(123),
                'telephone'=>'0779277772',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN ANH THƯ',
                'password'=>Hash::make(123),
                'telephone'=>'0794640875',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN THI NGỌC PHƯỢNG',
                'password'=>Hash::make(123),
                'telephone'=>'0964308980',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'TRẦN THỊ KIM NGÂN',
                'password'=>Hash::make(123),
                'telephone'=>'0763836399',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'TRẦN THỊ NGỌC MAI',
                'password'=>Hash::make(123),
                'telephone'=>'0389095382',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'TRẦN THỊ KIM NGÂN',
                'password'=>Hash::make(123),
                'telephone'=>'0868047712',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN THỊ THUỲ TRINH',
                'password'=>Hash::make(123),
                'telephone'=>'0763570191',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'HỒ THỊ NGỌC HÀ',
                'password'=>Hash::make(123),
                'telephone'=>'0782828556',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'CAO THỊ NGỌC HƯƠNG',
                'password'=>Hash::make(123),
                'telephone'=>'0976915997',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN VÕ HUỲNH VÂN',
                'password'=>Hash::make(123),
                'telephone'=>'0977599734',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN THỊ MỸ HƯƠNG',
                'password'=>Hash::make(123),
                'telephone'=>'0772008021',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'TRẦN NGỌC LAN ANH',
                'password'=>Hash::make(123),
                'telephone'=>'0868755803',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'BÙI THỊ THANH HOA',
                'password'=>Hash::make(123),
                'telephone'=>'0338799651',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN THỊ ĐÔNG NGÂN',
                'password'=>Hash::make(123),
                'telephone'=>'0934456138',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'VƯƠNG THỊ HOÀI THU',
                'password'=>Hash::make(123),
                'telephone'=>'0911520998',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'ĐỖ NGỌC MINH PHƯƠNG',
                'password'=>Hash::make(123),
                'telephone'=>'0966166584',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'ĐINH THỊ BÍCH NGỌC',
                'password'=>Hash::make(123),
                'telephone'=>'0379168365',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_id'=>10,
                'username'=>'NGUYỄN THỊ VIỆT KIỀU',
                'password'=>Hash::make(123),
                'telephone'=>'0357893198',
                'province_id'=> 1,
                'status'=> 1,
                'remember_token'=> 'eIrDXwgBs8ndPzCkkVKhVKsN',
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ];
        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}