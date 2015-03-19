<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameLikesColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forum_threads', function(Blueprint $table)
        {
            $table->renameColumn('likes', 'like_count');
        });

        Schema::table('forum_replies', function(Blueprint $table)
        {
            $table->renameColumn('likes', 'like_count');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('forum_threads', function(Blueprint $table)
        {
            $table->renameColumn('like_count', 'likes');
        });

        Schema::table('forum_replies', function(Blueprint $table)
        {
            $table->renameColumn('like_count', 'likes');
        });
	}

}
