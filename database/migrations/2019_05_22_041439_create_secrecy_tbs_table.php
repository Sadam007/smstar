<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecrecyTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secrecy_tbs', function (Blueprint $table) {
            $table->increments('sec_user_id');
            $table->integer('user_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('secrecy_tbs');
    }
}
