<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddIndexToForumThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forum_threads', function(Blueprint $table)
        {
            $table->index(['updated_at', 'deleted_at']);
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
            $table->dropIndex(['updated_at', 'deleted_at']);
        });
	}

}
