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
        Schema::create('secruity_checks', function (Blueprint $table) {
            $table->id();
            $table->string('n_visa_id');
            $table->string('request_id');
            $table->string('tracking_no');
            $table->string('statusName')->nullable();
            $table->string('statusId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secruity_checks');
    }
};
