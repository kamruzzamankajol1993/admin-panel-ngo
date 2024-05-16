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
        Schema::create('nothi_details', function (Blueprint $table) {
            $table->id();
            $table->string('noteId');
            $table->string('nothId');
            $table->string('dakId');
            $table->string('dakType');
            $table->string('sender');
            $table->string('receiver');
            $table->string('back_status')->nullable();
            $table->string('permission_status')->nullable();
            $table->string('zari_permission_status')->nullable();
            $table->string('potroPdf')->nullable();
            $table->string('onumodon_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nothi_details');
    }
};
