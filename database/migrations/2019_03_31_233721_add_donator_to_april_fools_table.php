<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDonatorToAprilFoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return voidp
     */
    public function up()
    {
        Schema::table('april_fools', function(Blueprint $table) {
            $table->boolean('donator')->default(false);
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
            $table->dropColumn('donator');
        });
    }
}
