<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('truck_driver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('truck_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('set null');
            $table->date('receipt_date');
            $table->date('deliver_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('truck_driver');
    }
};
