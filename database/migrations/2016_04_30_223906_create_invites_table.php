<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('malfonds_invites');
    }
}
