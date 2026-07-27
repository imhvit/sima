<?php

namespace App\Repositories;

use App\Models\Inventory;

class InventoryRepository
{

    public function getDataTable(?string $search, int $perPage)
    {
        return Inventory::query()
            ->with('warehouse:id,name,code', 'product:id,name,sku,deleted_at')
            // ->when($search, function ($query) use ($search) {
            //     $query->where(function ($query) use ($search) {
            //         $query->where('name', 'like', "{$search}%")
            //             ->orWhere('sku', 'like', "{$search}%");
            //     });
            // })
            ->select('id', 'warehouse_id', 'product_id', 'stock', 'reserved_stock')
            ->paginate($perPage)
            ->withQueryString();
    }
}
