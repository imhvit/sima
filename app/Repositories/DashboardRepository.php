<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function getStatistics(): array
    {
        return [
            "totalProducts" =>  $this->totalProducts(),
            "totalWarehouses" =>  $this->totalWarehouses(),
            "totalInventoryValue" => $this->totalInventoryValue(),
        ];
    }

    public function totalProducts(): int
    {
        return Product::count();
    }

    public function totalWarehouses(): int
    {
        return Warehouse::count();
    }

    public function totalInventoryValue(): string
    {
        return DB::table('inventories')
            ->join('products', 'inventories.product_id', '=', 'products.id')
            ->sum(DB::raw('inventories.stock * products.sale_price'));
    }
}
