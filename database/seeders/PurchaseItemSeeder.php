<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Database\Seeder;

class PurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchaseIds = Purchase::pluck('id')->all();
        $productIds = Product::pluck('id')->all();

        if (empty($purchaseIds) || empty($productIds)) {
            return;
        }

        $lastProductId = $productIds[count($productIds) - 1];

        $items = [
            [
                'purchase_id' => $purchaseIds[0],
                'product_id' => $productIds[0],
                'quantity' => 10,
                'unit_price' => 18.50,
            ],
            [
                'purchase_id' => $purchaseIds[0],
                'product_id' => $lastProductId,
                'quantity' => 5,
                'unit_price' => 32.00,
            ],
            [
                'purchase_id' => $purchaseIds[1] ?? $purchaseIds[0],
                'product_id' => $productIds[1] ?? $productIds[0],
                'quantity' => 8,
                'unit_price' => 24.90,
            ],
            [
                'purchase_id' => $purchaseIds[2] ?? $purchaseIds[0],
                'product_id' => $productIds[0],
                'quantity' => 3,
                'unit_price' => 20.00,
            ],
        ];

        foreach ($items as $item) {
            $subtotal = round((float) $item['quantity'] * (float) $item['unit_price'], 2);

            PurchaseItem::updateOrCreate(
                [
                    'purchase_id' => $item['purchase_id'],
                    'product_id' => $item['product_id'],
                ],
                [
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $subtotal,
                ]
            );
        }

        $totalsByPurchase = PurchaseItem::query()
            ->selectRaw('purchase_id, SUM(subtotal) as total')
            ->groupBy('purchase_id')
            ->pluck('total', 'purchase_id');

        foreach ($totalsByPurchase as $purchaseId => $total) {
            Purchase::whereKey($purchaseId)->update(['total' => $total]);
        }
    }
}
