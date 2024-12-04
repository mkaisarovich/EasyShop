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
        Schema::create('fashions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('style_id')->nullable();
            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('price');
            $table->boolean('discount')->default(0);
            $table->integer('discount_price')->nullable();
            $table->foreignId('shop_id')->constrained('shops')->cascadeOnDelete();
            $table->boolean('status')->default(1);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fashions');
    }
};
