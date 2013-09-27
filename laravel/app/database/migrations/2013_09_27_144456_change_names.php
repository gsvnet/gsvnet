<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeNames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('year_group', 'year_groups');
		Schema::rename('user_profile', 'user_profiles');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('year_groups', 'year_group');
		Schema::rename('user_profiles', 'user_profile');
	}

}
