<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSubjectAssgnmentTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subject_assgnment_tbs', function (Blueprint $table) {
            $table->increments('teach_assign_id');
            $table->integer('deg_admin_id');
            $table->integer('subject_code');
            $table->integer('examcode');
            $table->integer('teacher_id');
            $table->integer('department_id');
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
        Schema::dropIfExists('teacher_subject_assgnment_tbs');
    }
}
