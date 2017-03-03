<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotFileLabelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file_label', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('file_id')->unsigned()->index();
			$table->integer('label_id')->unsigned()->index();
			// $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
			// $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('file_label');
	}

}
