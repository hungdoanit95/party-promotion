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
                'parent_id' => 0,
                'survey_name'=>'Cập nhật lại thông ngày tổ chức không?',
                'target'=> 0,
                'survey_type'=>'date',
                'survey_sort' => 1,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => ''
            ],
            [
                'survey_id'=>2,
                'group_id'=>1,
                'parent_id' => 0,
                'survey_name'=>'Cập nhật lại thông tin Chủ tiệc không?',
                'target'=> 0,
                'survey_type'=>'select',
                'survey_sort' => 2,
                'is_required' => 1,
                'survey_deleted'=>0,
                'survey_answers' => json_encode([
                    [
                        'name' => 'Không',
                        'value' => 0
                    ],
                    [
                        'name' => 'Có',
                        'value' => 1
                    ]
                ]),
            ],
            [
                'survey_id'=>3,
                'group_id'=>1,
                'parent_id' => 2,
                'survey_name'=>'Tên chủ tiệc',
                'target'=> 0,
                'survey_type'=>'text',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => ''
            ],
            [
                'survey_id'=>4,
                'group_id'=>1,
                'parent_id' => 2,
                'survey_name'=>'SĐT chủ tiệc',
                'target'=> 0,
                'survey_type'=>'number',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => ''
            ],
            [
                'survey_id'=>5,
                'group_id'=>1,
                'parent_id' => 0,
                'survey_name'=>'Cập nhật lại thông tin Người giới thiệu không?',
                'target'=> 0,
                'survey_type'=>'select',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => json_encode([
                    [
                        'name' => 'Không',
                        'value' => 0
                    ],
                    [
                        'name' => 'Có',
                        'value' => 1
                    ]
                ]),
            ],
            [
                'survey_id'=>6,
                'group_id'=>1,
                'parent_id' => 5,
                'survey_name'=>'Tên Người giới thiệu',
                'target'=> 0,
                'survey_type'=>'text',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0
            ],
            [
                'survey_id'=>7,
                'group_id'=>1,
                'parent_id' => 5,
                'survey_name'=>'SĐT Người giới thiệu',
                'target'=> 0,
                'survey_type'=>'number',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0
            ],
            [
                'survey_id'=>8,
                'group_id'=>1,
                'parent_id' => 0,
                'survey_name'=>'Cập nhật lại thông tin Loại bia không?',
                'target'=> 0,
                'survey_type'=>'select',
                'survey_sort' => 2,
                'is_required' => 1,
                'survey_deleted'=>0,
                'survey_answers' => json_encode([
                    [
                        'name' => 'Không',
                        'value' => 0
                    ],
                    [
                        'name' => 'Có',
                        'value' => 1
                    ]
                ]),
            ],
            [
                'survey_id'=>9,
                'group_id'=>1,
                'parent_id' => 8,
                'survey_name'=>'Loại bia thực tế',
                'target'=> 0,
                'survey_type'=>'select',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => json_encode([
                    [
                        'name' => 'Chill',
                        'value' => 1
                    ],
                    [
                        'name' => 'Special',
                        'value' => 2
                    ],
                    [
                        'name' => '333',
                        'value' => 3
                    ],
                    [
                        'name' => 'Lager',
                        'value' => 4
                    ],
                    [
                        'name' => 'Lạc Việt',
                        'value' => 5
                    ],
                    [
                        'name' => 'Export',
                        'value' => 6
                    ],
                ]),
            ],
            [
                'survey_id'=> 10,
                'group_id'=> 1,
                'parent_id' => 8,
                'survey_name'=>'Số lượng bia thực tế',
                'target'=> 0,
                'survey_type'=>'number',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => '',
            ],
            [
                'survey_id'=> 11,
                'group_id'=> 1,
                'parent_id' => 8,
                'survey_name'=>'Loại tiệc',
                'target'=> 0,
                'survey_type'=>'select',
                'survey_sort' => 2,
                'is_required' => 0,
                'survey_deleted'=>0,
                'survey_answers' => json_encode([
                    [
                        'name' => 'Tiệc sinh nhật/ Thôi nôi/ Đầy tháng/ Mừng thọ',
                        'value' => 1
                    ],
                    [
                        'name' => 'Tiệc cưới (Vu Quy/ Tân Hôn/ Thành Hôn)',
                        'value' => 2
                    ],
                    [
                        'name' => 'Đính hôn/ Đám hỏi/Đám nói',
                        'value' => 3
                    ],
                    [
                        'name' => 'Đám giỗ/ Ma chay',
                        'value' => 4
                    ],
                    [
                        'name' => 'Liên hoan/ Hội Thảo/ Họp mặt',
                        'value' => 5
                    ],
                    [
                        'name' => 'Tân gia/ Khai trương',
                        'value' => 6
                    ],
                    [
                        'name' => 'Khác',
                        'value' => 7
                    ],
                ]),
            ]
        ];
        foreach($survey_questions as $question){
            DB::table('survey_questions')->insert($question);
        }
    }
}
