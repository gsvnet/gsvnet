<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveIsQuestionAndLaravelVersionFromForumThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forum_threads', function(Blueprint $table) {
            $table->dropColumn('is_question');
            $table->dropColumn('laravel_version');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::table('forum_threads', function(Blueprint $table) {
            $table->('is_question');
            $table->('laravel_version');
        });
	}

}
