<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFunctionFieldFromUserSenateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('user_senate', function(Blueprint $table) {
            $table->smallInteger('function');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::table('user_senate', function(Blueprint $table) {
            $table->dropColumn('function');
        });
	}

}
