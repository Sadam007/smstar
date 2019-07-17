<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_tbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->string('name');
            $table->string('mobile')->unique();
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
        Schema::dropIfExists('teacher_tbs');
    }
}
