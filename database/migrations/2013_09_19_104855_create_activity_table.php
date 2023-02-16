<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('activity', function ($t) {
            $t->create();

            $t->increments('id');
            $t->integer('user_id');
            $t->integer('activity_type');
            $t->integer('activity_id');
            $t->text('description');

            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('activity');
    }
};
