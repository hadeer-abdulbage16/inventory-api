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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable();
            $table->string('product_code'); 
            $table->string('product_name');
            $table->string('unit');  
            $table->string('expiry_date')->nullable();   
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 15, 5);
            $table->integer('min_purchase_quantity')->default(1);
            $table->integer('min_sale_quantity')->default(1);
            $table->integer('alert_quantity')->default(1);
            $table->unsignedBigInteger('opining_stock')->default(1);
            $table->decimal('sale_price', 15, 5)->default(0);
            $table->decimal('purchase_price', 15, 5)->default(0);
            $table->decimal('discount', 15, 5)->default(0);
            $table->decimal('tax', 15, 5)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
    }
};
