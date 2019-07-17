<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPracticalGroupingTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_practical_grouping_tbs', function (Blueprint $table) {
            $table->increments('prac_grouping_id');
            $table->integer('subject_id');
            $table->integer('examcode');
            $table->integer('rollno');
            $table->integer('PracCentercode');
            $table->integer('groupno');
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
        Schema::dropIfExists('student_practical_grouping_tbs');
    }
}
