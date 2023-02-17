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
        Schema::table('forum_threads', function (Blueprint $table) {
            $table->renameColumn('likes', 'like_count');
        });

        Schema::table('forum_replies', function (Blueprint $table) {
            $table->renameColumn('likes', 'like_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_threads', function (Blueprint $table) {
            $table->renameColumn('like_count', 'likes');
        });

        Schema::table('forum_replies', function (Blueprint $table) {
            $table->renameColumn('like_count', 'likes');
        });
    }
};
