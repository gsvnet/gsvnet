<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('comment_tag', function ($t) {
            $t->create();

            $t->increments('id');
            $t->integer('comment_id')->index();
            $t->integer('tag_id')->index();

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('comment_tag');
    }
};
