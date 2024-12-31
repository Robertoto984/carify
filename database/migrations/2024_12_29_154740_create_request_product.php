<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')->on('maintenance_request')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('procedure_id')->on('maintenance_types')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('product_id')->on('products')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->float('quantity');
            $table->float('unit_price');
            $table->float('total_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_product');
    }
};
