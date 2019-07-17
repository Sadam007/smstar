<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamCodeTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_code_tbs', function (Blueprint $table) {
            $table->increments('exam_id');
            $table->integer('user_id');
            $table->integer('examcode');
            $table->text('description');
            $table->string('type');
            $table->string('session');
            $table->unsignedTinyInteger('is_active')->default(0);
            $table->unsignedTinyInteger('is_odd')->default(1);
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
        Schema::dropIfExists('exam_code_tbs');
    }
}
