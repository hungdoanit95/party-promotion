<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->integer('user_id');
            $table->string('plan_name')->nullable();
            $table->string('route_plan');
            $table->string('date_start');
            $table->string('date_end');
            $table->integer('reason_id')->nullable();
            $table->double('lat',10,8)->nullable();
            $table->double('long',11,8)->nullable();
            $table->dateTime('time_checkin')->nullable();
            $table->text('note_admin')->nullable();
            $table->text('note_employee')->nullable();
            $table->string('ip_imei')->nullable();
            $table->integer('status')->default(0); // Trạng thái: 0: Chưa làm /1: Thành công / 2: Không thành công
            $table->smallInteger('reason_deleted')->default(0);
            $table->dateTime('date_upload')->nullable();
            $table->integer('id_deleted')->default(0);
            $table->string('confirm_report')->nullable();
            $table->string('user_confirm_report')->nullable();
            $table->string('plan_qc_code')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
