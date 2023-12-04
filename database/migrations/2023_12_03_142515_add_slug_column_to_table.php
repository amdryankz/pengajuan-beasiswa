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
        Schema::table('donors', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('name');
        });

        Schema::table('file_requirements', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('name');
        });

        Schema::table('scholarship_data', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('list_student_file');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('name_bank');
        });

        Schema::table('admins', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            if (Schema::hasColumn('donors', 'slug')) {
                $table->dropColumn('slug');
            }
        });

        Schema::table('file_requirements', function (Blueprint $table) {
            if (Schema::hasColumn('file_requirements', 'slug')) {
                $table->dropColumn('slug');
            }
        });

        Schema::table('scholarship_data', function (Blueprint $table) {
            if (Schema::hasColumn('scholarship_data', 'slug')) {
                $table->dropColumn('slug');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'slug')) {
                $table->dropColumn('slug');
            }
        });

        Schema::table('admins', function (Blueprint $table) {
            if (Schema::hasColumn('admins', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
