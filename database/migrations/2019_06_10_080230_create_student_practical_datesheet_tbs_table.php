<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPracticalDatesheetTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_practical_datesheet_tbs', function (Blueprint $table) {
            $table->increments('std_prac_datesheet_id');
            $table->integer('subject_id');
            $table->integer('examcode');
            $table->integer('PracCentercode');
            $table->integer('groupno');
            $table->string('date');
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
        Schema::dropIfExists('student_practical_datesheet_tbs');
    }
}
