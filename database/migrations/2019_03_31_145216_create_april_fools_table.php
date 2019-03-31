<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAprilFoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('april_fools', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('credits_earned');
            $table->integer('credits_spent')->unsigned();
            $table->string('profile_background');
            $table->string('profile_text');
            $table->integer('ban_vote_user_id')->unsigned()->index();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('april_fools');
    }
}
