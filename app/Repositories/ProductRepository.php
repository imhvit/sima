<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getDataTable(?string $search, int $perPage)
    {
        return Product::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "{$search}%")
                        ->orWhere('sku', 'like', "{$search}%");
                });
            })
            ->select('id', 'sku', 'name', 'sale_price', 'minimum_stock', 'is_active')
            ->paginate($perPage)
            ->withQueryString();
    }
}
