<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('escorts', function (Blueprint $table) {
           $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->date('license_expiration_date')->nullable();
            $table->enum('license_type', \App\Enums\LicenseTypes::values())->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escorts');
    }
};
