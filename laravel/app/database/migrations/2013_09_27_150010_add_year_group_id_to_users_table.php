<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddYearGroupIdToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_profiles', function(Blueprint $table) {
			$table->integer('year_group_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_profiles', function(Blueprint $table) {
			$table->dropColumn('year_group_id');
		});
	}

}
