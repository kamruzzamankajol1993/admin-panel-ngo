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
        Schema::create('fd9_forwarding_letter_edits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('forwarding_letter_id')->unsigned();
            $table->foreign('forwarding_letter_id')->references('id')->on('forwarding_letters')->onDelete('cascade');
            $table->text('pdf_part_one');
            $table->text('pdf_part_two');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fd9_forwarding_letter_edits');
    }
};
