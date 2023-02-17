<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('committee_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('committee_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            // $table->foreign('committee_id')->references('id')->on('committees')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();

            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('committee_user');
    }
};
