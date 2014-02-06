<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotCommitteeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('committee_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('committee_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			// $table->foreign('committee_id')->references('id')->on('committees')->onDelete('cascade');
			// $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->timestamps();

			$table->datetime('start_date');
			$table->datetime('end_date');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('committee_user');
	}

}
