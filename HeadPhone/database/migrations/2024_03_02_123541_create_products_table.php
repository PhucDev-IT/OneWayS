<?php

use App\Models\Supplier;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->double('price');
            $table->text('img_preview');
            $table->float('guarantee_time');
            $table->float('sale')->default(0);
            $table->float('rate')->default(5);
            $table->tinyInteger('published')->default(true);
            $table->date('createdat')->default(date('Y-m-d'));
            $table->timestamps();
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->cascadeOnDelete();

            $table->index('id');
            $table->index('published');
            $table->index('name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
