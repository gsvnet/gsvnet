<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
     */
    public function down(): void
    {
        Schema::table('files', function ($table) {
            $table->dropIndex('search');
        });
    }
};
