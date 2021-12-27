<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHourlyFixedMinMaxToFiltersTable extends Migration
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
                ->boolean('is_fixed')
                ->after('countries_ids')
                ->default(false)
                ->nullable();
            $table
                ->string('fixed_min')
                ->after('is_fixed')
                ->nullable();
            $table
                ->string('fixed_max')
                ->after('fixed_min')
                ->nullable();
            $table
                ->boolean('is_hourly')
                ->after('fixed_max')
                ->default(false)
                ->nullable();
            $table
                ->string('hourly_min')
                ->after('is_hourly')
                ->nullable();
            $table
                ->string('hourly_max')
                ->after('hourly_min')
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
