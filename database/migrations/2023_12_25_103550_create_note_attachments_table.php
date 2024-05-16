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
        Schema::create('note_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('noteId')->nullable();
            $table->integer('nothiId')->nullable();
            $table->integer('dakId')->nullable();
            $table->string('status')->nullable();
            $table->integer('child_id')->nullable();
            $table->text('title')->nullable();
            $table->longText('link',)->nullable();
            $table->integer('admin_id')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_attachments');
    }
};
