<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataAbsenceReasons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $absence_reasons = [
            [
                'reason_name' => 'Ngày có phép',
                'sort_order' => 1,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'reason_name' => 'Bận việc gia đình',
                'sort_order' => 2,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'reason_name' => 'Sự cố đột ngột',
                'sort_order' => 3,
                'created_at'=>date('Y-m-d H:i:s')
            ],
            [
                'reason_name' => 'Lý do khác (ghi note)',
                'sort_order' => 4,
                'created_at'=>date('Y-m-d H:i:s')
            ],
        ];
        foreach($absence_reasons as $reason){
            DB::table('absence_reasons')->insert($reason);
        }
    }
}
