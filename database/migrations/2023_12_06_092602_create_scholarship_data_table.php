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
            $table->string('value');
            $table->string('status_value');
            $table->integer('duration');
            $table->date('start_regis_at')->nullable();
            $table->date('end_regis_at')->nullable();
            $table->float('min_ipk')->nullable();
            $table->json('kuota')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('file_sk')->nullable();
            $table->date('start_scholarship')->nullable();
            $table->date('end_scholarship')->nullable();
            $table->string('list_student_file')->nullable();
            $table->string('slug', 255)->nullable();
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
