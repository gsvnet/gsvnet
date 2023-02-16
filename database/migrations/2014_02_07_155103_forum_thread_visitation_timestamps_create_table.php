<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_thread_visitations');
    }
};
