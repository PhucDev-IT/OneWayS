<?php

use App\Models\Category;
use App\Models\Product;
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
        Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->boolean('published')->default(true);
        $table->timestamps();
    });

    Schema::create('category_product', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
        $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
        $table->timestamps();

        $table->index('id');
        $table->index('product_id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('categories');
    }
};
