<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyWordJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_word_job', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('key_word_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('key_word_id')->references('id')->on('key_words')
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
        Schema::dropIfExists('key_word_job');
    }
}
