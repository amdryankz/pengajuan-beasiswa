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
            $table->bigInteger('nim')->unique();
            $table->string('password');
            $table->string('name');
            $table->string('prodi');
            $table->string('fakultas');
            $table->string('jk');
            $table->float('ipk')->nullable();
            $table->integer('total_sks')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('address')->nullable();
            $table->string('name_parent')->nullable();
            $table->string('job_parent')->nullable();
            $table->string('income_parent')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('name_rek')->nullable();
            $table->string('name_bank')->nullable();
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
