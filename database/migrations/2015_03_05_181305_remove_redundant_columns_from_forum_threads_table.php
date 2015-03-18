<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RemoveRedundantColumnsFromForumThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('forum_threads', function(Blueprint $table)
        {
            $table->dropColumn('is_question');
            $table->dropColumn('solution_reply_id');
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
            $table->boolean('is_question');
            $table->integer('solution_reply_id')->nullable()->defaults(null);
        });
	}

}
