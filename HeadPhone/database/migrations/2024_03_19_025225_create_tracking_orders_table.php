<?php

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
        Schema::create('tracking_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable()->index();
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('set null');
            $table->string('name')->default('PENDING');
            $table->string('name_vn')->default('Chờ xác nhận');
            $table->timestamp('time')->default(now());
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_orders');
    }
};
