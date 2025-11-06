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
        // Check and add columns only if they don't exist
        if (!Schema::hasColumn('users', 'staff_num')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('staff_num')->nullable()->after('name');
            });
        }
        
        if (!Schema::hasColumn('users', 'department')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('department')->nullable()->after('staff_num');
            });
        }
        
        if (!Schema::hasColumn('users', 'branch')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('branch')->nullable()->after('department');
            });
        }
        
        if (!Schema::hasColumn('users', 'phone_num')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone_num')->nullable()->after('branch');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['staff_num', 'department', 'branch', 'phone_num']);
        });
    }
}; 