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
        Schema::create('designation_steps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('designation_list_id')->unsigned();
            $table->foreign('designation_list_id')->references('id')->on('designation_lists')->onDelete('cascade');
            $table->string('designation_step')->nullable();
            $table->string('designation_serial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designation_steps');
    }
};
