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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('style_id')->constrained('product_styles')->cascadeOnDelete();
            $table->foreignId('struture_id')->constrained('product_structures')->cascadeOnDelete();
            $table->foreignId('season_id')->constrained('product_seasons')->cascadeOnDelete();
            $table->boolean('discount')->default(0);
            $table->foreignId('catalog_category_id')->constrained('catalog_categories')->cascadeOnDelete();
            $table->foreignId('product_category_id')->constrained('product_categories')->cascadeOnDelete();
            $table->integer('price');
            $table->integer('discount_price')->nullable();
            $table->foreignId('shop_id')->constrained('shops')->cascadeOnDelete();
            $table->enum('type',['hat','t_shirt','hoody','trousers','bag','shoes','accessory'])->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
