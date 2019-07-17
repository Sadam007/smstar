<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentUfmTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_ufm_tbs', function (Blueprint $table) {
             $table->increments('std_ufm_id');
             $table->integer('subject_id');
            $table->integer('examcode');
            $table->string('Interview_date');
            $table->string('Interview_time');
            $table->string('decision');
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
        Schema::dropIfExists('student_ufm_tbs');
    }
}
