<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_tbs', function (Blueprint $table) {
            $table->increments('subject_id');
            $table->integer('user_id');
            $table->string('code');
            $table->string('Na');
            $table->integer('Marks');
            $table->string('sname');
            $table->integer('hours')->nullable();
            $table->integer('Pmarks')->nullable();
            $table->string('sname2')->nullable();
            $table->integer('degree_id')->default(1);
            $table->integer('semester_id')->default(1);
            $table->unsignedTinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('subject_tbs');
    }
}
