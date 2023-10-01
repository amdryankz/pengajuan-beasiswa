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
        Schema::create('user_scholarships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scholarship_data_id');
            $table->foreign('scholarship_data_id')->references('id')->on('scholarship_data');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('file_requirement_id');
            $table->foreign('file_requirement_id')->references('id')->on('file_requirements');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_scholarships');
    }
};
