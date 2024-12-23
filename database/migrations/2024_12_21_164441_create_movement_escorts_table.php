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
        Schema::create('movement_escorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mov_command_id')->on('movement_commands')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->foreignId('escort_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement_escorts');
    }
};
