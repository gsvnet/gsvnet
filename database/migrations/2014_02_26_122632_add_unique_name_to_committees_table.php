<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUniqueNameToCommitteesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('committees', function(Blueprint $table) {
			$table->string('unique_name', 100)->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('committees', function(Blueprint $table) {
			$table->dropColumn('unique_name');
		});
	}

}
