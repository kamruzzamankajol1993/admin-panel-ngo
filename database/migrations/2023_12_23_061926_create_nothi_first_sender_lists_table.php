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
        Schema::create('nothi_first_sender_lists', function (Blueprint $table) {
            $table->id();
            $table->string('noteId');
            $table->string('nothId');
            $table->string('dakId');
            $table->string('dakType');
            $table->string('sender',11)->nullable();
            $table->string('receiver',11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nothi_first_sender_lists');
    }
};
