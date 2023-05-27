<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSurveys extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $survey_questions = [
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
        ];
        foreach($survey_questions as $question){
            DB::table('survey_questions')->insert($question);
        }
    }
}
