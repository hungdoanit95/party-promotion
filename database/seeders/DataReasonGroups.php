<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataReasonGroups extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reason_groups')->insert([
            'group_name' => 'Thành công',
            'parent_id' => 0,
            'status' => 1
        ]);
        DB::table('reason_groups')->insert([
            'group_name' => 'Không thành công',
            'parent_id' => 0,
            'status' => 1
        ]);
    }
}
