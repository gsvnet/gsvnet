<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTimestampsToCommitteeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('committee_user', function(Blueprint $table) {
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('committee_user', function(Blueprint $table) {
			$table->dropColumn('created_at');
			$table->dropColumn('updated_at');
		});
	}

}
