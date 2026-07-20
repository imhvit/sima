<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use App\Repositories\InventoryMovementRepository;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        private readonly InventoryMovementRepository $inventoryMovementRepo
    ) {}
    public function stock(Request $request)
    {
        return inertia('app/inventory/Stock');
    }

    public function movements(Request $request)
    {
        $perPage = $this->getPerPage($request);
        $paginator = $this->inventoryMovementRepo->getDataTable($perPage);
        return inertia('app/inventory/Movements', [
            'movements' => $paginator->items(),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'next_page_url' => $paginator->nextPageUrl(),
                'total' => $paginator->total(),
            ],
            'initialSearch' => $request->input('search'),
        ]);
    }

    private function getPerPage(Request $request): int
    {
        return max(1, min((int) $request->input('per_page', 20), 100));
    }
}
