<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->enum('type', \App\Enums\MaintenanceTypes::values());
            $table->string('created_by')->nullable();
            $table->foreignId('maintenance_type_id')->on('maintenance_types')->cascadeOnUpdate()->nullable();
            $table->foreignId('truck_id')->constrained('trucks')->onDelete('set null');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('set null');
            $table->integer('odometer_number')->default('0');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_orders');
    }
};
