<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DataCameraTypes::class);
        $this->call(DataPlans::class);
        $this->call(DataProjects::class);
        $this->call(DataReasonGroups::class);
        $this->call(DataReasons::class);
        $this->call(DataStores::class);
        $this->call(DataSurveyGroups::class);
        $this->call(DataSurveys::class);
        $this->call(DataSurveyHistory::class);
        $this->call(DataUserGroups::class);
        $this->call(DataUsers::class);
        $this->call(DataAbsenceReasons::class);
        $this->call(DataParties::class);
    }
}
