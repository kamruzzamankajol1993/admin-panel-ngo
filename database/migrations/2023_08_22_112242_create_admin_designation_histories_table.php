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
        Schema::create('admin_designation_histories', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id')->nullable();
            $table->string('designation_list_id')->nullable();
            $table->string('admin_job_start_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_designation_histories');
    }
};
