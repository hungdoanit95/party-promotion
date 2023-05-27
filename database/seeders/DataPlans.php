<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPlans extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'store_id'=>1,
                'user_id'=>1,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>1,
                'user_id'=>12,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>2,
                'user_id'=>1,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>2,
                'user_id'=>12,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>3,
                'user_id'=>1,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>3,
                'user_id'=>12,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>4,
                'user_id'=>1,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>4,
                'user_id'=>12,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>5,
                'user_id'=>1,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>5,
                'user_id'=>12,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>6,
                'user_id'=>20,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>6,
                'user_id'=>11,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>7,
                'user_id'=>20,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>7,
                'user_id'=>11,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>8,
                'user_id'=>20,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>8,
                'user_id'=>11,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>9,
                'user_id'=>20,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>9,
                'user_id'=>11,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>10,
                'user_id'=>20,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>10,
                'user_id'=>11,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>11,
                'user_id'=>10,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>11,
                'user_id'=>3,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>12,
                'user_id'=>10,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>12,
                'user_id'=>3,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>13,
                'user_id'=>10,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>13,
                'user_id'=>3,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>14,
                'user_id'=>10,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>14,
                'user_id'=>3,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>15,
                'user_id'=>10,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>15,
                'user_id'=>3,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>16,
                'user_id'=>13,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>16,
                'user_id'=>4,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>17,
                'user_id'=>13,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>17,
                'user_id'=>4,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>18,
                'user_id'=>13,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>18,
                'user_id'=>4,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>19,
                'user_id'=>13,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>19,
                'user_id'=>4,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>20,
                'user_id'=>13,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>20,
                'user_id'=>4,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>21,
                'user_id'=>9,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>21,
                'user_id'=>15,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>22,
                'user_id'=>9,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>22,
                'user_id'=>15,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>23,
                'user_id'=>9,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>23,
                'user_id'=>15,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>24,
                'user_id'=>9,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>24,
                'user_id'=>15,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>25,
                'user_id'=>9,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>25,
                'user_id'=>15,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>26,
                'user_id'=>14,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>26,
                'user_id'=>17,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>27,
                'user_id'=>14,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>27,
                'user_id'=>17,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>28,
                'user_id'=>14,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>28,
                'user_id'=>17,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>29,
                'user_id'=>14,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>29,
                'user_id'=>17,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>30,
                'user_id'=>14,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>30,
                'user_id'=>17,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>31,
                'user_id'=>16,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>31,
                'user_id'=>5,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>32,
                'user_id'=>16,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>32,
                'user_id'=>5,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>33,
                'user_id'=>16,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>33,
                'user_id'=>5,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>34,
                'user_id'=>16,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>34,
                'user_id'=>5,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>35,
                'user_id'=>16,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>35,
                'user_id'=>5,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>36,
                'user_id'=>8,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>36,
                'user_id'=>19,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>37,
                'user_id'=>8,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>37,
                'user_id'=>19,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>38,
                'user_id'=>8,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>38,
                'user_id'=>19,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>39,
                'user_id'=>8,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>39,
                'user_id'=>19,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>40,
                'user_id'=>8,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>40,
                'user_id'=>19,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>41,
                'user_id'=>18,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>41,
                'user_id'=>7,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>42,
                'user_id'=>18,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>42,
                'user_id'=>7,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>43,
                'user_id'=>18,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>43,
                'user_id'=>7,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>44,
                'user_id'=>18,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>44,
                'user_id'=>7,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>45,
                'user_id'=>18,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>45,
                'user_id'=>7,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>46,
                'user_id'=>6,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>46,
                'user_id'=>2,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>47,
                'user_id'=>6,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>47,
                'user_id'=>2,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>48,
                'user_id'=>6,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>48,
                'user_id'=>2,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>49,
                'user_id'=>6,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>49,
                'user_id'=>2,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>50,
                'user_id'=>6,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'store_id'=>50,
                'user_id'=>2,
                'route_plan'=>'2022-11',
                'date_start'=>'2022-11-09',
                'date_end'=>'2022-11-09',
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ];
        foreach($plans as $plan){
            DB::table('plans')->insert($plan);
        }
    }
}
