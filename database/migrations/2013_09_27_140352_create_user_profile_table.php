<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id', false);
            $table->integer('year_group_id')->nullable();
            $table->integer('region');

            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('town')->nullable();

            $table->string('study')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('church')->nullable();
            $table->boolean('gender')->nullable();
            $table->datetime('start_date_rug')->nullable();
            $table->boolean('reunist')->default(0);

            $table->string('parent_address')->nullable();
            $table->string('parent_zip_code')->nullable();
            $table->string('parent_town')->nullable();
            $table->string('parent_phone')->nullable();

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
        Schema::drop('user_profiles');
    }
};
