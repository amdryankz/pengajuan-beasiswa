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
            $table->foreign('scholarship_data_id')->references('id')->on('scholarship_data')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('file_requirement_id')->nullable();
            $table->foreign('file_requirement_id')->references('id')->on('file_requirements')->onDelete('set null');
            $table->string('file_path')->nullable();
            $table->boolean('file_status')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->boolean('scholarship_status')->nullable();
            $table->string('supervisor_approval_file')->nullable();
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
