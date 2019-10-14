<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYearColumnToDegreeTbs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('degree_tbs', function (Blueprint $table) {
            $table->integer('degYears')->after('DegCode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('degree_tbs', function (Blueprint $table) {
             $table->dropColumn('degYears');
        });
    }
}
