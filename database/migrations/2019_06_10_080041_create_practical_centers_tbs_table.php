<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticalCentersTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practical_centers_tbs', function (Blueprint $table) {
            $table->increments('prac_centre_id');
            $table->integer('examcode');
            $table->integer('PracCentercode');
            $table->string('centername');
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
        Schema::dropIfExists('practical_centers_tbs');
    }
}
