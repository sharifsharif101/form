<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->json('selected_products');
            $table->decimal('apple_price', 8, 2)->nullable();
            $table->decimal('orange_price', 8, 2)->nullable();
            $table->decimal('tomato_price', 8, 2)->nullable();
            $table->string('other_fruit_name')->nullable();
            $table->decimal('other_fruit_price', 8, 2)->nullable();
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
