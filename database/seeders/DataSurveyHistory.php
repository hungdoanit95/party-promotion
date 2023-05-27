<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSurveyHistory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_json = json_encode([
            [
                'survey_id'=>1,
                'group_id'=>1,
                'survey_name'=>'SL Set SG Special',
                'target'=> 0,
                'survey_type'=>'number',
                'survey_sort' => 1,
                'survey_deleted'=>0
            ],
            [
                'survey_id'=>2,
                'group_id'=>1,
                'survey_name'=>'SL Set SG Chill',
                'target'=> 0,
                'survey_type'=>'number',
                'survey_sort' => 2,
                'survey_deleted'=>0
            ]
        ]);
        $history = [
            'route_plan' => '2022-11',
            'group_id' => 1,
            'questions' => $data_json,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('survey_history')->insert($history);
    }
}
