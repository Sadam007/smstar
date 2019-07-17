<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreeAdminTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degree_admin_tbs', function (Blueprint $table) {
            $table->increments('degree_admin_id');
            $table->integer('create_user_id');
            $table->integer('department_id');
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
        Schema::dropIfExists('degree_admin_tbs');
    }
}
