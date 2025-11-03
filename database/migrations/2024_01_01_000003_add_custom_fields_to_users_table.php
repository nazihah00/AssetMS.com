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
        Schema::table('users', function (Blueprint $table) {
            $table->string('staff_num')->nullable()->after('name');
            $table->string('department')->nullable()->after('staff_num');
            $table->string('branch')->nullable()->after('department');
            $table->string('phone_num')->nullable()->after('branch');
        });
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