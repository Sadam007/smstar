<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_tbs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('department_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('password_change_at')->nullable();
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
        Schema::dropIfExists('staff_tbs');
    }
}
