<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->string('party_code')->unique(); //Mã tiệc
            $table->string('introducer_name')->nullable(); // tên người giới thiệu 
            $table->string('introducer_phone')->nullable(); // Số điện thoại người giới thiệu
            $table->string('party_host_name'); // Tên chủ tiệc
            $table->string('party_host_phone'); // Số điện thoại chủ tiệc
            $table->string('party_type')->nullable(); // Loại tiệc
            $table->string('party_level')->nullable(); // Mức tiệc
            $table->string('beer_type')->nullable(); // Loại bia
            $table->string('organization_date')->nullable(); // Ngày diễn ra tiệc
            $table->string('organization_time')->nullable(); // Thời gian tổ chức
            $table->string('province')->nullable(); // Tỉnh thành phố
            $table->string('district')->nullable(); // Quận huyện
            $table->string('ward')->nullable(); // Xã phường
            $table->string('street')->nullable(); // Tên đường
            $table->string('home_number')->nullable(); // Số nhà
            $table->string('notes')->nullable(); // Ghi chú
            $table->string('distributor')->nullable(); // Mã nhà phân phối
            $table->string('point_of_salename')->nullable(); // Điểm bán
            $table->string('point_of_salephone')->nullable(); // Số điện thoại điểm bán
            $table->integer('user_id');
            $table->integer('status')->default(1); // Trạng thái
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parties');
    }
}
