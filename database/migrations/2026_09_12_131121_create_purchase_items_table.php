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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable();
            $table->string('product_id'); 
            $table->string('product_code'); 
            $table->string('product_name');
            $table->integer('qty')->default(0);
            $table->string('expiry_date')->nullable();
            $table->string('price');
            $table->bigInteger('purchase_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
