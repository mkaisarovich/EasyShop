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
        Schema::create('favorite_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_id')->constrained('sizes')->cascadeOnDelete();
            $table->enum('type',['clothes','shoes','trousers']);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_sizes');
    }
};
