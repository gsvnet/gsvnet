<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpecialMenuToAprilFoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('april_fools', function(Blueprint $table) {
            $table->boolean('special_menu')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('april_fools', function (Blueprint $table) {
            $table->dropColumn('special_menu');
        });
    }
}