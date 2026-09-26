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
            $table->string('barcode')->nullable()->unique();  
            $table->string('code')->unique();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description')->nullable();
            $table->string('expiry_date')->nullable();
            $table->decimal('price',15,5)->default(0);
            $table->decimal('tax_value',15,5)->default(0);
            $table->decimal('tax_percent', 5, 2)->default(0);
            $table->decimal('discount_value',15,5)->default(0);
            $table->decimal('discount_percent', 5, 2)->default(0);
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
