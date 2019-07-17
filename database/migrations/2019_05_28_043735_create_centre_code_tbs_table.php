<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentreCodeTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centre_code_tbs', function (Blueprint $table) {
            $table->increments('center_id');
            $table->integer('user_id');
            $table->integer('ccode');
            $table->integer('examcode');
            $table->string('name_of_centre');
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
        Schema::dropIfExists('centre_code_tbs');
    }
}
