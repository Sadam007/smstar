<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortalStaffModelTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_staff_model_tbs', function (Blueprint $table) {
            $table->increments('pstaff_id');
            $table->string('title',255);
            $table->string('name',255);
            $table->string('email',255);
            $table->string('designation',255);
            $table->longText('message')->nullable();
            $table->longText('avatar')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('user_id');
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
        Schema::dropIfExists('portal_staff_model_tbs');
    }
}
