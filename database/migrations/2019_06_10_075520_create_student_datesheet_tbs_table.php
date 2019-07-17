<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDatesheetTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_datesheet_tbs', function (Blueprint $table) {
            $table->increments('std_datesheet_id');
            $table->string('subcode');
            $table->integer('examcode');
            $table->string('ds_date');
            $table->string('ds_day');
            $table->string('ds_time');
            $table->integer('ordr');
            $table->string('part')->nullable();
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
        Schema::dropIfExists('student_datesheet_tbs');
    }
}
