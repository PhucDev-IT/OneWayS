<?php

use App\Models\PaymentMethod;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id')->primary();
            $table->dateTime('orderdate')->default(now());
            $table->double('total');
            $table->float('feeship');
            $table->double('totalmoney');
            $table->text('customer_receive');
            $table->integer('voucher_id')->references('voucher_id')->on('vouchers');
            $table->string('status');
            $table->timestamps();

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PaymentMethod::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
