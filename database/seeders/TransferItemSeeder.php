<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transfer;
use App\Models\TransferItem;
use Illuminate\Database\Seeder;

class TransferItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transferIds = Transfer::pluck('id')->all();
        $productIds = Product::pluck('id')->all();

        if (empty($transferIds) || empty($productIds)) {
            return;
        }

        $items = [
            [
                'transfer_id' => $transferIds[0],
                'product_id' => $productIds[0],
                'quantity' => 4,
            ],
            [
                'transfer_id' => $transferIds[0],
                'product_id' => $productIds[1] ?? $productIds[0],
                'quantity' => 2,
            ],
            [
                'transfer_id' => $transferIds[1] ?? $transferIds[0],
                'product_id' => $productIds[count($productIds) - 1],
                'quantity' => 1,
            ],
        ];

        foreach ($items as $item) {
            TransferItem::updateOrCreate(
                [
                    'transfer_id' => $item['transfer_id'],
                    'product_id' => $item['product_id'],
                ],
                [
                    'quantity' => $item['quantity'],
                ]
            );
        }
    }
}
