<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStduentCertificatesTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stduent_certificates_tbs', function (Blueprint $table) {
            $table->integer('certificate_id');
            $table->integer('regno');
            $table->integer('metric');
            $table->string('metricGroup');
            $table->bigInteger('metricRollNo');
            $table->bigInteger('metricYear');
            $table->bigInteger('metricObtMarks');
            $table->bigInteger('metricTotMarks');
            $table->string('metricInstitute');
            $table->string('metricBoard');
            $table->integer('fsc');
            $table->string('fscGroup');
            $table->bigInteger('fscRollNo');
            $table->bigInteger('fscYear');
            $table->bigInteger('fscObtMarks');
            $table->bigInteger('fscTotMarks');
            $table->string('fscInstitute');
            $table->string('fscBoard');
            $table->integer('bsc')->nullable();
            $table->string('bscGroup')->nullable();
            $table->bigInteger('bscRollNo')->nullable();
            $table->bigInteger('bscYear')->nullable();
            $table->bigInteger('bscObtMarks')->nullable();
            $table->bigInteger('bscTotMarks')->nullable();
            $table->string('bscInstitute')->nullable();
            $table->string('bscBoard')->nullable();
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
        Schema::dropIfExists('stduent_certificates_tbs');
    }
}
