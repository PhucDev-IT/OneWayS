<?php

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('province_id');
            $table->string('province_name');
            $table->string('district_id');
            $table->string('district_name');
            $table->string('ward_id');
            $table->string('ward_name');
            $table->string('details');
            $table->string('isOpen')->default(1);
            $table->timestamps();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
