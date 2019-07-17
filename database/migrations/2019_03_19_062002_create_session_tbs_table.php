<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_tbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('sessionCode');
            $table->string('session');
            $table->string('status')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
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
        Schema::dropIfExists('session_tbs');
    }
}
