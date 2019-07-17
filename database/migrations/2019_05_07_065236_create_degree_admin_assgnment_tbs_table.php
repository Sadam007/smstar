<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegreeAdminAssgnmentTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degree_admin_assgnment_tbs', function (Blueprint $table) {
            $table->increments('admin_assign_id');
            $table->integer('specialuser_id');
            $table->integer('department_id');
            $table->integer('degree_id');
            $table->integer('degree_admin_id');
            $table->unsignedTinyInteger('is_assigned')->default(0);
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
        Schema::dropIfExists('degree_admin_assgnment_tbs');
    }
}
