<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use Illuminate\Http\Request;

class InventoryMovementController extends Controller
{
    public function show(InventoryMovement $movement)
    {
        $movement->load(['warehouse', 'product', 'user']);
        return response()->json($movement);
    }
}
