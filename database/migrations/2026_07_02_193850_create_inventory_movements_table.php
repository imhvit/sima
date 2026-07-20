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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->restrictOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();

            $table->enum('type', [
                'entry',
                'exit',
                'transfer_in',
                'transfer_out',
                'adjustment',
            ])->default('entry');
            $table->decimal('quantity', 12, 2);
            $table->decimal('stock_before', 12, 2);
            $table->decimal('stock_after', 12, 2);
            $table->morphs('reference');
            $table->enum('reason', [
                'purchase_received',
                'sale',
                'transfer_dispatch',
                'transfer_received',
                'adjustment',
                'customer_return',
                'purchase_return',
            ])->nullable();
            $table->text('notes')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
