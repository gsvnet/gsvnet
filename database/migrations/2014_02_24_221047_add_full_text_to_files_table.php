<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFullTextToFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('files', function(Blueprint $table) {
        //  	$table->engine = 'MyISAM'; // means you can't use foreign key constraints
        // });

        //   	Schema::table('events', function(Blueprint $table) {
        // 	$table->boolean('public')->default(false);
        // 	$table->boolean('published')->default(false);
        // });

        DB::statement('ALTER TABLE files ADD FULLTEXT search(name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function ($table) {
            $table->dropIndex('search');
        });
    }
}
