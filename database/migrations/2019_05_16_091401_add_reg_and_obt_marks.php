<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegAndObtMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roll_no_com_dets', function (Blueprint $table) {
            $table->string('obt40')->after('FicRollNo')->nullable();
            $table->string('obt60')->after('obt40')->nullable();
            $table->string('obtPrac')->after('obt60')->nullable();
            $table->string('obtTot')->after('obtPrac')->nullable();
            $table->integer('resStatus')->after('obtTot')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roll_no_com_dets', function (Blueprint $table) {
            $table->dropColumn(['obt40', 'obt60','obtPrac','obtTot','resStatus']);
        });
    }
}
