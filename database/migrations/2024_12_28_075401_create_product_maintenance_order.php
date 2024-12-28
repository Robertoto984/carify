<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_maintenance_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_order_id')->constrained('maintenance_orders');
            $table->foreignId('product_id')->constrained('products');
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('total_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_maintenance_order');
    }
};
