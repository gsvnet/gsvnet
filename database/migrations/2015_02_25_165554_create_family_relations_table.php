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
        Schema::create('family_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->index();
            $table->unsignedInteger('child_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('family_relations');
    }
};
