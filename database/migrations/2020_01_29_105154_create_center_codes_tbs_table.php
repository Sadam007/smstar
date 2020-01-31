<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterCodesTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_codes_tbs', function (Blueprint $table) {
            $table->increments('ccode_id');
            $table->integer('user_id');
            $table->integer('ccode');
            $table->integer('examcode');
            $table->string('cname',255);
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
        Schema::dropIfExists('center_codes_tbs');
    }
}
