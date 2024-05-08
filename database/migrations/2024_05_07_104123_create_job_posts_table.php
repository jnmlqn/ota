<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('sub_company');
            $table->string('office');
            $table->string('department');
            $table->string('recruiting_category');
            $table->enum('status', ['unpublished', 'published', 'spam'])->default('unpublished');
            $table->enum('employment_type', ['permanent', 'contractual', 'project_based']);
            $table->enum('seniority', ['entry_level', 'junior', 'mid', 'senior', 'experienced']);
            $table->enum('schedule', ['full_time', 'part_time']);
            $table->smallInteger('years_of_exp');
            $table->json('keywords');
            $table->string('occupation');
            $table->string('occupation_category');
            $table->bigInteger('submitted_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
