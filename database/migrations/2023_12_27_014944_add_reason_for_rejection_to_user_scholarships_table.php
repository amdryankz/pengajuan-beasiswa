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
            $table->text('reason_for_rejection')->nullable()->after('status_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_scholarships', function (Blueprint $table) {
            $table->dropColumn('reason_for_rejection');
        });
    }
};
