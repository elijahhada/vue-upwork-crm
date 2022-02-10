<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasAnswerUserIdToBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->string('title')->after('id')->nullable();
            $table->unsignedBigInteger('user_id')->after('job_id')->nullable();
            $table->boolean('has_answer')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropColumn('has_answer');
            $table->dropColumn('user_id');
            $table->dropColumn('title');
        });
    }
}
