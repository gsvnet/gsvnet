<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIndexToForumRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forum_replies', function(Blueprint $table)
        {
            $table->index(['thread_id', 'created_at']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('forum_replies', function(Blueprint $table)
        {
            $table->dropIndex(['thread_id', 'created_at']);
        });
	}

}
