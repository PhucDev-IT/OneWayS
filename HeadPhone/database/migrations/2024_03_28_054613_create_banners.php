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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('banners_categories')->cascadeOnDelete();
            $table->text('name');
            $table->string('image');
            $table->decimal('width');
            $table->decimal('height');
            $table->timestamps();
            $table->tinyInteger('published');
            $table->tinyInteger('ordering');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};