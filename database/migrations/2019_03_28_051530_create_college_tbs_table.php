<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_tbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('college_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('district');
            $table->string('regStart');
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
        Schema::dropIfExists('college_tbs');
    }
}
