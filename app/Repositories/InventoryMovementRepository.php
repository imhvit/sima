<?php

namespace App\Repositories;

use App\Models\InventoryMovement;

class InventoryMovementRepository
{
    public function getDataTable(int $perPage)
    {
        return InventoryMovement::with('warehouse', 'product', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }
}
