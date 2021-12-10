<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filters', function (Blueprint $table) {
            $table
                ->string('exception_words_ids', 999)
                ->after('user_id')
                ->nullable();
            $table
                ->string('custom_key_words_ids', 999)
                ->after('exception_words_ids')
                ->nullable();
            $table
                ->string('key_words_ids', 999)
                ->after('custom_key_words_ids')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filters', function (Blueprint $table) {
            //
        });
    }
}
