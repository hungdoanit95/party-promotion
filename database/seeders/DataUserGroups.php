<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataUserGroups extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_groups = [
            [
                'group_name'=>'Developer',
                'group_code'=>'IT',
                'parent_id'=>0,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Project Leader',
                'group_code'=>'PL',
                'parent_id'=>0,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Project Admin',
                'group_code'=>'PA',
                'parent_id'=>1,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Quality Controller',
                'group_code'=>'QC',
                'parent_id'=>1,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Data Controller',
                'group_code'=>'DC',
                'parent_id'=>1,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'QC auditor',
                'group_code'=>'QCA',
                'parent_id'=>3,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Region Manager',
                'group_code'=>'RM',
                'parent_id'=>1,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Field Leader',
                'group_code'=>'FL',
                'parent_id'=>6,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'Supervisor',
                'group_code'=>'Sup',
                'parent_id'=>7,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'group_name'=>'PG-PB',
                'group_code'=>'Staff',
                'parent_id'=>8,
                'status'=>1,
                'created_at'=>date('Y-m-d H:i:s')
            ]
        ];
        foreach($user_groups as $group){
            DB::table('user_groups')->insert($group);
        }
    }
}
