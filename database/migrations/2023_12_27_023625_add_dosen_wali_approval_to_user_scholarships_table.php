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
        Schema::table('user_scholarships', function (Blueprint $table) {
            $table->string('dosen_wali_approval')->nullable()->after('status_scholar');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_scholarships', function (Blueprint $table) {
            $table->dropColumn('dosen_wali_approval');
        });
    }
};
