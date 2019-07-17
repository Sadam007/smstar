<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollNoComDetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_no_com_dets', function (Blueprint $table) {
            $table->increments('roll_no_com_det_id');
            $table->integer('rollno');
            $table->integer('examcode');
            $table->string('subcode');
            $table->integer('FicRollNo')->nullable();
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
        Schema::dropIfExists('roll_no_com_dets');
    }
}
