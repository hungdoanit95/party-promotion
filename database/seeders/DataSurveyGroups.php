<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSurveyGroups extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey_groups = [
            [
                'group_name'=>'Nhập liệu nhân viên',
                'parent_id'=>0,
                'status'=>1,
                'sort_order' => 0,
                'created_at'=>date('Y-m-d H:i:s')
            ]
        ];
        foreach($survey_groups as $group){
            DB::table('survey_groups')->insert($group);
        }
    }
}
