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
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('meta_description');
            $table->string('slug')->index();
            $table->string('location')->default('');
            $table->boolean('whole_day');
            $table->date('start_date')->index();
            $table->time('start_time');
            $table->date('end_date');
            $table->integer('type')->default(0);
            $table->string('image')->default('');
            $table->boolean('public')->default(false);
            $table->boolean('published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('events');
    }
};
