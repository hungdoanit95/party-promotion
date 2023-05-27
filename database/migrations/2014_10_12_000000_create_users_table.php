<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('usercode')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->default('123');
            $table->string('telephone',11)->unique();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->integer('province_id')->default(1);
            $table->string('id_number',12)->nullable();
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('type_account')->default('nhanvien');
            $table->string('bank_number')->nullable();
            $table->smallInteger('status')->default(1);
            $table->rememberToken()->default('eIrDXwgBs8ndPzCkkVKhVKsN');
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
        Schema::dropIfExists('users');
    }
}
