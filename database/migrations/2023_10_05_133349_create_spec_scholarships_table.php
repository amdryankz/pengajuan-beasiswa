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
        Schema::create('spec_scholarships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scholarship_data_id');
            $table->foreign('scholarship_data_id')->references('id')->on('scholarship_data');
            $table->string('list_students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spec_scholarships');
    }
};
