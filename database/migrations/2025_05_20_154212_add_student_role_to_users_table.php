<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // MySQL specific way to alter enum values
            DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'operator', 'student') DEFAULT 'operator'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert back to the original enum values
            DB::statement("ALTER TABLE users MODIFY role ENUM('admin', 'operator') DEFAULT 'operator'");
        });
    }
};
