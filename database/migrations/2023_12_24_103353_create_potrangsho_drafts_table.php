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
        Schema::create('potrangsho_drafts', function (Blueprint $table) {
            $table->id();
            $table->integer('adminId');
            $table->integer('nothiId');
            $table->integer('sarokId')->nullable();
            $table->integer('noteId')->nullable();
            $table->integer('receiverId')->nullable();
            $table->integer('SentStatus')->nullable();
            $table->string('status')->nullable();
            $table->text('office_subject');
            $table->text('office_sutro')->nullable();
            $table->longText('description');
            $table->text('extra_text')->nullable();
            $table->text('sarok_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potrangsho_drafts');
    }
};
