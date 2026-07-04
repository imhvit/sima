<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\InventoryMovement;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Database\Seeder;

class InventoryMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inventories = Inventory::query()
            ->orderBy('id')
            ->limit(3)
            ->get();
        $user = User::first();

        if ($inventories->isEmpty() || !$user) {
            return;
        }

        $purchase = Purchase::first();
        $transfer = Transfer::first();

        foreach ($inventories as $inventory) {
            $entryQuantity = 5;
            $stockBefore = $inventory->stock;
            $stockAfter = $stockBefore + $entryQuantity;

            $entryReferenceType = $purchase ? Purchase::class : self::class;
            $entryReferenceId = $purchase?->id ?? $inventory->id;

            InventoryMovement::updateOrCreate(
                [
                    'warehouse_id' => $inventory->warehouse_id,
                    'product_id' => $inventory->product_id,
                    'user_id' => $user->id,
                    'type' => 'entry',
                    'reference_type' => $entryReferenceType,
                    'reference_id' => $entryReferenceId,
                    'reason' => 'purchase_received',
                ],
                [
                    'quantity' => $entryQuantity,
                    'stock_before' => $stockBefore,
                    'stock_after' => $stockAfter,
                    'notes' => 'Ingreso de stock por compra.',
                ]
            );

            $exitQuantity = 2;
            $exitType = $transfer ? 'transfer_out' : 'adjustment';
            $exitReferenceType = $transfer ? Transfer::class : self::class;
            $exitReferenceId = $transfer?->id ?? $inventory->id;
            $exitReason = $transfer ? 'transfer_dispatch' : 'manual_adjustment';

            InventoryMovement::updateOrCreate(
                [
                    'warehouse_id' => $inventory->warehouse_id,
                    'product_id' => $inventory->product_id,
                    'user_id' => $user->id,
                    'type' => $exitType,
                    'reference_type' => $exitReferenceType,
                    'reference_id' => $exitReferenceId,
                    'reason' => $exitReason,
                ],
                [
                    'quantity' => $exitQuantity,
                    'stock_before' => $stockAfter,
                    'stock_after' => $stockAfter - $exitQuantity,
                    'notes' => 'Salida de stock para transferencia.',
                ]
            );
        }
    }
}
