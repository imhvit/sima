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

        $products = [];

        for ($i = 1; $i <= 50; $i++) {
            $skuNumber = str_pad($i, 4, '0', STR_PAD_LEFT);
            $categoryId = $categoryIds[$i % count($categoryIds)];
            $brandId = $brandIds[$i % count($brandIds)];
            $unitId = $unitIds[$i % count($unitIds)];

            $products[] = [
                'category_id' => $categoryId,
                'brand_id' => $brandId,
                'unit_id' => $unitId,
                'sku' => 'PRD-' . $skuNumber,
                'name' => 'Producto de ejemplo ' . $i,
                'description' => 'Descripción del producto de ejemplo ' . $i,
                'sale_price' => round(rand(1000, 9999) / 100, 2),
                'minimum_stock' => rand(5, 20),
                'image' => null,
            ];
        }

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
