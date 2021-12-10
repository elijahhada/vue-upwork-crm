<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExceptionWordJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exception_word_job', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exception_word_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('exception_word_id')->references('id')->on('exception_words')
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
        Schema::dropIfExists('exception_word_job');
    }
}
