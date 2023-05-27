<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_code')->unique();
            $table->string('store_code_new')->nullable(); // Dùng để định nghĩa lại nếu CPS cần
            $table->string('store_name');
            $table->string('store_phone',11);
            $table->integer('province_id')->nullable();
            $table->string('address')->nullable();
            $table->string('asm_name')->nullable();
            $table->string('asm_phone',11)->nullable();
            $table->text('store_note')->nullable();
            $table->string('survey_group_ids');
            $table->string('level',10)->nullable();
            $table->double('lat',10,8)->nullable();
            $table->double('long',11,8)->nullable();
            $table->string('region')->nullable();
            $table->string('distributor_code')->nullable();
            $table->string('distributor_name')->nullable();
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('stores');
    }
}
