<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyRelationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('family_relations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->index();
            $table->unsignedInteger('child_id')->index();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('family_relations');
	}

}
