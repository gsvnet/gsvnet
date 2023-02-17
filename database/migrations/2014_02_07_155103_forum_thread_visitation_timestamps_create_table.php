<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('forum_thread_visitations', function ($t) {
            $t->create();
            $t->increments('id');
            $t->integer('user_id');
            $t->integer('thread_id');
            $t->timestamp('visited_at');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('forum_thread_visitations');
    }
};
