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
        Schema::create('fc_one_office_saroks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_note_for_fc_one_id')->unsigned();
            $table->foreign('parent_note_for_fc_one_id')->references('id')->on('parent_note_for_fc_ones')->onDelete('cascade');
            $table->text('office_subject')->nullable();
            $table->text('office_sutro')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('fc_one_office_saroks');
    }
};
