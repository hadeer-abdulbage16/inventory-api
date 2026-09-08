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
        Schema::create('stock_movements', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('ref_id');
            $table->enum('movement', ['in', 'out']);
            $table->unsignedBigInteger('qty');
            $table->unsignedBigInteger('qty_store_wise')->nullable();
            $table->string('ref_number')->nullable();
            $table->string('ref_type'); // purchase, sale, transfer, adjustment, return
            $table->decimal('before_qty', 15, 2)->default(0);
            $table->decimal('after_qty', 15, 2)->default(0);
            $table->decimal('before_qty_store_wise', 15, 2)->default(0);
            $table->decimal('after_qty_store_wise', 15, 2)->default(0);
            $table->decimal('cost_price', 15, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
