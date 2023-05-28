<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPlanParty extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_plan_party = [
            [
                'store_id'=>1,
                'user_id'=>1,
            ],
            [
                'store_id'=>1,
                'user_id'=>12,
            ],
            [
                'store_id'=>2,
                'user_id'=>1,
            ],
            [
                'store_id'=>2,
                'user_id'=>12,
            ]
        ];
        foreach($data_plan_party as $plan_party){
            DB::table('plan_party')->insert($plan_party);
        }
    }
}
