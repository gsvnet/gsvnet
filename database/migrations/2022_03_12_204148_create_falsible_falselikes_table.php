<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFalsibleFalselikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('falsible_falselikes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('falsible_id', 36);
            $table->string('falsible_type', 100);
            $table->string('user_id', 36)->index();
            $table->timestamps();
            $table->unique(['falsible_id', 'falsible_type', 'user_id'], 'likeable_likes_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('falsible_falselikes');
    }
}
