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
        Schema::create('forwarding_letter_onulipis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('forwarding_letter_id')->unsigned();
            $table->foreign('forwarding_letter_id')->references('id')->on('forwarding_letters')->onDelete('cascade');
            $table->string('onulipi_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forwarding_letter_onulipis');
    }
};
