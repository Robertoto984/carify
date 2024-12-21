<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movement_escorts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mov_command_id')->constrained();
            $table->foreignId('escort_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movement_escorts');
    }
};
