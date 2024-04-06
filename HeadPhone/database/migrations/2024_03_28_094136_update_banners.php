<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
            $table->decimal('width')->nullable()->change();
            $table->decimal('height')->nullable()->change();
            $table->tinyInteger('published')->nullable()->change();
            $table->tinyInteger('ordering')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};