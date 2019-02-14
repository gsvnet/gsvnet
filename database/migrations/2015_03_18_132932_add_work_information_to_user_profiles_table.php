<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddWorkInformationToUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('user_profiles', function(Blueprint $table)
        {
            $table->string('company');
            $table->string('profession');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('user_profiles', function(Blueprint $table)
        {
            $table->dropColumn('company');
            $table->dropColumn('profession');
        });
	}

}
