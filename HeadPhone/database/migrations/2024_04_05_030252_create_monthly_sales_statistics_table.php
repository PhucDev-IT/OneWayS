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
        Schema::create('monthly_sales_statistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('month');
            $table->unsignedSmallInteger('year');
            $table->decimal('total_revenue', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_sales_statistics');
    }
};
