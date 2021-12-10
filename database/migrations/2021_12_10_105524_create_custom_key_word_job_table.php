<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomKeyWordJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_key_word_job', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_key_word_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('custom_key_word_id')->references('id')->on('custom_key_words')
                ->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade');
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
        Schema::dropIfExists('custom_key_word_job');
    }
}
