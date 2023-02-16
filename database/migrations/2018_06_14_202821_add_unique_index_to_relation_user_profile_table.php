<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('region_user_profile', function (Blueprint $table) {
            $table->unique(['region_id', 'user_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('region_user_profile', function (Blueprint $table) {
            $table->dropUnique(['region_id', 'user_profile_id']);
        });
    }
};
