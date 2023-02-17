<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tags', function ($t) {
            $t->boolean('forum')->defaults(0);
            $t->boolean('articles')->defaults(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function ($t) {
            $t->dropColumn('forum');
            $t->dropColumn('articles');
        });
    }
};
