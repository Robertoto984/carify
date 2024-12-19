<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('truck_deliver_cards', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('manufacturer');
            $table->year('year');
            $table->year('register');
            $table->year('model');
            $table->string('plate_number');
            $table->string('chassis_number');
            $table->string('engine_number');
            $table->string('traffic_license_number');
            $table->date('demarcation_date');
            $table->enum('color', \App\Enums\Color::values());
            $table->enum('fuel_type', \App\Enums\FuelTypes::values());
            $table->string('passengers_number');
            $table->string('gross_weight');
            $table->string('empty_weight');
            $table->string('load');
            $table->integer('kilometer_number')->default('0');
            $table->string('technical_status');
            $table->string('legal_status');
            $table->date('receipt_date');
            $table->date('deliver_date');
            $table->foreignId('truck_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('truck_deliver_cards');
    }
};
