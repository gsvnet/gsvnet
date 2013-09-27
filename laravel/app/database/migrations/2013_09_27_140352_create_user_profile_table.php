<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_profile', function(Blueprint $table) {
			$table->integer('id', true);
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('phone');
			$table->string('adress')->nullable();
			$table->string('zip_code')->nullable();
			$table->string('town')->nullable();
			$table->string('study')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('church')->nullable();
			$table->enum('gender', array('male', 'female'))->nullable();
			$table->datetime('start_date_rug')->nullable();
			$table->boolean('reunist')->default(0);
			
			$table->string('parent_adress')->nullable();
			$table->string('parent_zip_code')->nullable();
			$table->string('parent_town')->nullable();
			$table->string('parent_telephone')->nullable();
			
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_profile');
	}

}
