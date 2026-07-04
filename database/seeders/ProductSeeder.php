<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use function count;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id')->all();
        $brandIds = Brand::pluck('id')->all();
        $unitIds = Unit::pluck('id')->all();

        if (empty($categoryIds) || empty($brandIds) || empty($unitIds)) {
            return;
        }

        $lastCategoryId = $categoryIds[count($categoryIds) - 1];
        $lastBrandId = $brandIds[count($brandIds) - 1];
        $lastUnitId = $unitIds[count($unitIds) - 1];

        $products = [
            [
                'category_id' => $categoryIds[0],
                'brand_id' => $brandIds[0],
                'unit_id' => $unitIds[0],
                'sku' => 'PRD-0001',
                'name' => 'Producto de ejemplo 1',
                'description' => 'Descripción del producto de ejemplo 1',
                'sale_price' => 25.00,
                'minimum_stock' => 5,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $lastCategoryId,
                'brand_id' => $lastBrandId,
                'unit_id' => $lastUnitId,
                'sku' => 'PRD-0002',
                'name' => 'Producto de ejemplo 2',
                'description' => 'Descripción del producto de ejemplo 2',
                'sale_price' => 49.90,
                'minimum_stock' => 10,
                'image' => null,
                'is_active' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'brand_id' => $lastBrandId,
                'unit_id' => $unitIds[0],
                'sku' => 'PRD-0003',
                'name' => 'Producto de ejemplo 3',
                'description' => 'Descripción del producto de ejemplo 3',
                'sale_price' => 15.75,
                'minimum_stock' => 8,
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
