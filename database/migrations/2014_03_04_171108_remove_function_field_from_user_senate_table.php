<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveFunctionFieldFromUserSenateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('user_senate', function(Blueprint $table) {
            $table->dropColumn('function');
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
            $table->text('function');
        });
	}

}
