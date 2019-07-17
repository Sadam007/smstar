<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreesInCollegeTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degrees_in_college_tbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('college_id');
            $table->integer('degree_id');
            $table->bigInteger('regStart');
            $table->string('sets')->default(40);
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
        Schema::dropIfExists('degrees_in_college_tbs');
    }
}
