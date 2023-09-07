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
        Schema::create('require_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scholarship_data_id');
            $table->foreign('scholarship_data_id')->references('id')->on('scholarship_data');
            $table->unsignedBigInteger('filerequirements_id');
            $table->foreign('filerequirements_id')->references('id')->on('filerequirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('require_files');
    }
};
