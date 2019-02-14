<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddMoreProfileData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_profiles', function(Blueprint $table)
        {
            $table->date('inauguration_date')->nullable()->defaults(null);
            $table->date('resignation_date')->nullable()->defaults(null);
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
            $table->dropColumn('inauguration_date');
            $table->dropColumn('resignation_date');
        });
	}

}
