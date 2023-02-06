<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUniqueIndexToRelationUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('region_user_profile', function (Blueprint $table) {
            $table->unique(['region_id', 'user_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('region_user_profile', function (Blueprint $table) {
            $table->dropUnique(['region_id', 'user_profile_id']);
        });
    }
}
