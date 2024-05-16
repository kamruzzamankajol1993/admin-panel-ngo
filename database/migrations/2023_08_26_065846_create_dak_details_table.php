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
        Schema::create('dak_details', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id')->nullable();
         

            $table->string('comment')->nullable();
            $table->string('main_file')->nullable();
            $table->string('access_id')->nullable();

            $table->string('decision_list')->nullable();
            $table->string('decision_list_detail')->nullable();
            $table->string('priority_list')->nullable();
            $table->string('secret_list')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dak_details');
    }
};
