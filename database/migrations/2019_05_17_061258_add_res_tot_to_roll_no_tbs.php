<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResTotToRollNoTbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roll_no_tbs', function (Blueprint $table) {

            $table->integer('result')->after('colcode')->nullable();
            $table->integer('resultStatus')->after('result')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roll_no_tbs', function (Blueprint $table) {
            $table->dropColumn(['result', 'resultStatus']);
        });
    }
}
