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
        Schema::create('seal_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('noteId')->nullable();
            $table->string('nothiId')->nullable();
            $table->string('childId')->nullable();
            $table->string('receiver')->nullable();
            $table->string('status')->nullable();
            $table->string('seal_status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seal_statuses');
    }
};
