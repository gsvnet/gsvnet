<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPropertiesToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->datetime('start_date_rug')->nullable();
			$table->string('adress')->nullable();
			$table->string('zip_code')->nullable();
			$table->string('location')->nullable();
			$table->string('parent_adress')->nullable();
			$table->string('parent_zip_code')->nullable();
			$table->string('parent_location')->nullable();
			$table->string('parent_telephone')->nullable();
			$table->string('study')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('church')->nullable();
			$table->enum('gender', array('male', 'female'))->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('start_date_rug');
			$table->dropColumn('adress');
			$table->dropColumn('zip_code');
			$table->dropColumn('location');
			$table->dropColumn('parent_adress');
			$table->dropColumn('parent_zip_code');
			$table->dropColumn('parent_location');
			$table->dropColumn('parent_telephone');
			$table->dropColumn('study');
			$table->dropColumn('birthdate');
			$table->dropColumn('church');
			$table->dropColumn('gender');
		});
	}

}
