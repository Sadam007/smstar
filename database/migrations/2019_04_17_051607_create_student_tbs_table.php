<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_tbs', function (Blueprint $table) {
            $table->increments('student_id');
            $table->integer('regno');
            $table->integer('department_id');
            $table->integer('session_id');
            $table->integer('degree_id');
            $table->string('stdName');
            $table->string('stdfName');
            $table->string('dob');
            $table->string('domicile');
            $table->text('photo');
            $table->text('address');
            $table->string('email');
            $table->string('contact');
            $table->string('password');
            $table->unsignedTinyInteger('is_active')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('student_tbs');
    }
}
