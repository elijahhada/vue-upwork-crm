<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeyWordsToFiltersTable extends Migration
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
                ->string('key_words_ids', 999)
                ->after('countries_ids')
                ->nullable();
            $table
                ->string('custom_key_words', 999)
                ->after('exseption_words')
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
            $table->dropColumn('key_words_ids');
            $table->dropColumn('custom_key_words');
        });
    }
}
