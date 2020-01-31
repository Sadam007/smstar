<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tbs', function (Blueprint $table) {
            $table->increments('news_id');
            $table->string('title',255);
            $table->longText('body');
            $table->text('attachment')->nullable();
            $table->timestamp('published_on')->useCurrent = true;
            $table->integer('is_active')->default(0);
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
        Schema::dropIfExists('news_tbs');
    }
}
