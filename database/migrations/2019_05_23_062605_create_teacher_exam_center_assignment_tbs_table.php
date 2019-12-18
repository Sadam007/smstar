<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherExamCenterAssignmentTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_exam_center_assignment_tbs', function (Blueprint $table) {
            $table->increments('teach_center_id');
            $table->integer('examcode');
            $table->string('subcode');
            $table->integer('ccode');
            $table->integer('examiner_id');
            $table->integer('sec_user_id');
            $table->unsignedTinyInteger('is_assigned')->default(0);
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
        Schema::dropIfExists('teacher_exam_center_assignment_tbs');
    }
}
