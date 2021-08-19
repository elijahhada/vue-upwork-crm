<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsFromUpworkToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('upwork_id');
            $table->string('category2');
            $table->string('subcategory2');
            $table->string('job_type');
            $table->string('budget')->nullable();
            $table->string('duration')->nullable();
            $table->string('workload')->nullable();
            $table->string('status');
            $table->timestamp('date_created')->nullable();
            $table->string('client_country');
            $table->double('client_feedback');
            $table->double('client_reviews_count');
            $table->double('client_jobs_posted');
            $table->double('client_past_hires');
            $table->double('client_score')->nullable();
            $table->string('client_payment_verification')->nullable();
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
            $table->dropColumn([
                'upwork_id',
                'category2',
                'subcategory2',
                'job_type',
                'budget',
                'duration',
                'workload',
                'status',
                'date_created',
                'client_country',
                'client_feedback',
                'client_reviews_count',
                'client_jobs_posted',
                'client_past_hires',
                'client_payment_verification',
                'client_score',
            ]);
        });
    }
}
