<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('region_user_profile', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('region_id')->unsigned()->index();
			$table->integer('user_profile_id')->unsigned()->index();
		});
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('region_user');
    }
}
