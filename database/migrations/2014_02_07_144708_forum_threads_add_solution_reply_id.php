<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('forum_threads', function ($t) {
            $t->integer('solution_reply_id')->nullable()->defaults(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_threads', function ($t) {
            $t->dropColumn('solution_reply_id');
        });
    }
};
