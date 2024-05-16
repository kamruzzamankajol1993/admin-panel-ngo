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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name');
            $table->string('admin_name_ban');
            $table->string('admin_mobile');
            $table->string('designation_list_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('admin_sign')->nullable();
            $table->string('admin_job_start_date')->nullable();
            $table->string('admin_job_end_date')->nullable();
            $table->string('admin_job_end_start_date')->nullable();
            $table->text('admin_image')->nullable();
            $table->string('email')->unique();
            $table->timestamp('admin_email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
