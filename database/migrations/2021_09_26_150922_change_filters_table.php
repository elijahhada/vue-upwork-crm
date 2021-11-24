<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFiltersTable extends Migration
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
                ->string('countries_ids', 999)
                ->after('user_id')
                ->nullable();
            $table
                ->string('categories_ids', 999)
                ->after('user_id')
                ->nullable();
            $table
                ->string('exseption_words', 3500)
                ->after('user_id')
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
            $table->dropColumn('countries_ids');
            $table->dropColumn('categories_ids');
            $table->dropColumn('exseption_words');
        });
    }
}
