<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('forum_threads', function ($t) {
            $t->boolean('is_question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('forum_threads', function ($t) {
            $t->dropColumn('is_question');
        });
    }
};
