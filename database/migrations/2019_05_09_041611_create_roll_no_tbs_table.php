<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollNoTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_no_tbs', function (Blueprint $table) {
            $table->increments('roll_no_id');
            $table->integer('regno');
            $table->integer('rollno');
            $table->integer('examcode');
            $table->string('part');
            $table->integer('ccode');
            $table->integer('colcode');
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
        Schema::dropIfExists('roll_no_tbs');
    }
}
