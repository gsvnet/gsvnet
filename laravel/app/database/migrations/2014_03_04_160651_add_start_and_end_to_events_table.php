<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStartAndEndToEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('events', function(Blueprint $table) {
			$table->date('start_date');
			$table->date('end_date')->nullable();
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::table('events', function(Blueprint $table) {
			$table->dropColumn('start_date');
			$table->dropColumn('end_date');
            
        });
	}

}
