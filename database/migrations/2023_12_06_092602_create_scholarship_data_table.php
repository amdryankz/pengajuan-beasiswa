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
        Schema::create('scholarship_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scholarships_id');
            $table->foreign('scholarships_id')->references('id')->on('scholarships');
            $table->year('year');
            $table->unsignedInteger('amount');
            $table->string('amount_period', 5);
            $table->unsignedTinyInteger('duration');
            $table->date('start_registration_at')->nullable();
            $table->date('end_registration_at')->nullable();
            $table->float('min_ipk', 3)->nullable();
            $table->json('quota')->nullable();
            $table->string('sk_number', 50)->nullable();
            $table->string('sk_file')->nullable();
            $table->date('start_scholarship')->nullable();
            $table->date('end_scholarship')->nullable();
            $table->string('slug', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_data');
    }
};
