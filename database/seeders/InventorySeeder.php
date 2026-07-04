<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouseIds = Warehouse::pluck('id')->all();
        $productIds = Product::pluck('id')->all();

        if (empty($warehouseIds) || empty($productIds)) {
            return;
        }

        foreach ($warehouseIds as $warehouseId) {
            foreach ($productIds as $index => $productId) {
                Inventory::updateOrCreate(
                    [
                        'warehouse_id' => $warehouseId,
                        'product_id' => $productId,
                    ],
                    [
                        'stock' => 20 + ($index * 5),
                        'reserved_stock' => $index % 2 === 0 ? 2 : 0,
                    ]
                );
            }
        }
    }
}
