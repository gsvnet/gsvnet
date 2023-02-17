<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('malfonds_invites', function (Blueprint $table) {
            $table->unsignedInteger('guest_id');
            $table->unsignedInteger('host_id');
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->dateTime('invited_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('malfonds_invites');
    }
};
