<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->increments('survey_id');
            $table->integer('group_id');
            $table->integer('parent_id')->default(0);
            $table->string('survey_name',255);
            $table->integer('target');
            $table->string('survey_type','10');
            $table->integer('survey_sort')->unsigned()->default(0);
            $table->smallInteger('survey_deleted')->default(0);
            $table->integer('id_deleted')->nullable();
            $table->integer('is_required')->default(0);
            $table->text('survey_answers')->nullable();
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
        Schema::dropIfExists('survey_questions');
    }
}
