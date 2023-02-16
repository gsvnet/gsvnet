<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_threads', function (Blueprint $t) {
            $t->create();
            $t->increments('id');
            $t->integer('author_id');
            $t->string('subject');
            $t->text('body');
            $t->string('slug', 150)->unique();
            $t->integer('most_recent_reply_id');
            $t->integer('reply_count');
            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('forum_threads');
    }
};
