<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRecheckingTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_rechecking_tbs', function (Blueprint $table) {
            $table->increments('std_rechecking_id');
            $table->integer('subject_id');
            $table->integer('examcode');
            $table->integer('result');
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
        Schema::dropIfExists('student_rechecking_tbs');
    }
}
