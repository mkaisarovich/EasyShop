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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('iin_bin');
            $table->string('document')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('mall_id')->nullable();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->boolean('moderate')->default(false);
            $table->string('whatsapp')->nullable();
            $table->string('phone_call')->nullable();
            $table->unsignedBigInteger('numeration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
