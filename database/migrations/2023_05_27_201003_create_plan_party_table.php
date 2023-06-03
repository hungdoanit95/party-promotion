<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanPartyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_party', function (Blueprint $table) {
            $table->id();
            $table->integer('party_id');
            $table->integer('user_id');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('time_checkin')->nullable();
            $table->smallInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_party');
    }
}
