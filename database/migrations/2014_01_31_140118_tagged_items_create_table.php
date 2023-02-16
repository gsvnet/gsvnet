<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tagged_items', function ($t) {
            $t->create();

            $t->increments('id');
            $t->integer('thread_id');
            $t->integer('tag_id');

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('tagged_items');
    }
};
