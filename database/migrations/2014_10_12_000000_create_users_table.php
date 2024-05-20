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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('npm')->unique();
            $table->string('password');
            $table->string('name', 50);
            $table->string('major', 50);
            $table->string('faculty', 50);
            $table->string('gender', 9);
            $table->float('ipk', 3);
            $table->unsignedTinyInteger('total_sks');
            $table->string('active_status', 11)->default('Aktif');
            $table->string('graduate_status', 11)->default('Belum Lulus');
            $table->date('birthdate');
            $table->string('birthplace', 25);
            $table->string('address', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('parent_name', 50)->nullable();
            $table->string('parent_job', 35)->nullable();
            $table->string('parent_income', 50)->nullable();
            $table->unsignedBigInteger('phone_number')->nullable();
            $table->unsignedBigInteger('bank_account_number')->nullable();
            $table->string('account_holder_name', 50)->nullable();
            $table->string('bank_name', 35)->nullable();
            $table->string('slug', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
