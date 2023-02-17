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
        Schema::table('forum_thread_visitations', function (Blueprint $table) {
            $table->index(['thread_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_thread_visitations', function (Blueprint $table) {
            $table->dropIndex(['thread_id', 'user_id']);
        });
    }
};
