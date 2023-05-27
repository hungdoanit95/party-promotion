<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataProjects extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'id' => 1,
            'name' => 'Project 1',
            'logo' => 'https://quatangtinhtuy.com.vn/wp-content/uploads/2019/10/SABECO-thuong-hieu-do-uong-Viet-Nam.jpg',
            'link' => 'https://www.sabeco.com.vn/',
            'description' => 'Description of project 1',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
