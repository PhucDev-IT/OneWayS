<?php

use App\Models\Address;
use App\Models\Order;
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
            $table->double('feeship');
            $table->double('totalmoney');
            $table->string('voucher_id')->nullable()->index();
            $table->string('method_payment');
            $table->timestamps();
            $table->foreignIdFor(Address::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreign('voucher_id')->references('voucher_id')->on('vouchers')->onDelete('set null');
        });
        
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('order_id')->references('order_id')->on('orders');
            $table->timestamp('time')->default(now());
            $table->string('reason')->nullable();
            $table->timestamps();
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
