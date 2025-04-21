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
            $table->string('name')->nullable();
            $table->string('code_product')->nullable();
            $table->text('description')->nullable();
            $table->double('price');
            $table->double('discount')->nullable();
            $table->double('final_price')->nullable();
            $table->unsignedBigInteger('stock')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('size')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
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