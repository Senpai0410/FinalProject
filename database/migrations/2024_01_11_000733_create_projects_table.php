<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('system_name');
        $table->string('project_type');
        $table->unsignedBigInteger('business_unit_id');
        $table->string('lead_developer')->nullable();
        $table->string('developers')->nullable();
        $table->string('system_owner');
        $table->string('system_pic')->nullable();
        $table->date('project_start_date')->nullable();
        $table->integer('project_duration')->comment('Duration in days')->nullable();
        $table->date('project_end_date')->nullable();
        $table->string('project_status');
        $table->string('development_methodology')->nullable();
        $table->string('system_platform')->nullable();
        $table->string('deployment_type')->nullable();
        $table->timestamps();


        $table->foreign('business_unit_id')->references('id')->on('business_units');

    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
    Schema::dropIfExists('projects');
}
}
