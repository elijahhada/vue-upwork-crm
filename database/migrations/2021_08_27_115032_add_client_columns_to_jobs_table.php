<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientColumnsToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->float('client_total_charge')->nullable();
            $table->longText('client_assignments')->nullable();
            $table->float('client_avg_rate')->nullable();
            $table->float('client_avg_charge')->nullable();
            $table->float('client_bad_feedbacks_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['client_total_charge', 'client_assignments', 'client_avg_rate', 'client_avg_charge', 'client_bad_feedbacks_count']);
        });
    }
}