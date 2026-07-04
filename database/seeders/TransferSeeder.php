<?php

namespace Database\Seeders;

use App\Models\Transfer;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class TransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouseIds = Warehouse::pluck('id')->all();
        $userIds = User::pluck('id')->all();

        if (count($warehouseIds) < 2 || empty($userIds)) {
            return;
        }

        $transfers = [
            [
                'origin_warehouse_id' => $warehouseIds[0],
                'destination_warehouse_id' => $warehouseIds[1],
                'user_id' => $userIds[0],
                'status' => 'completed',
                'transfer_date' => now()->subDays(1)->toDateString(),
                'notes' => 'Rebalanceo de stock entre almacenes.',
            ],
            [
                'origin_warehouse_id' => $warehouseIds[1],
                'destination_warehouse_id' => $warehouseIds[2] ?? $warehouseIds[0],
                'user_id' => $userIds[0],
                'status' => 'pending',
                'transfer_date' => now()->toDateString(),
                'notes' => 'Transferencia pendiente de salida.',
            ],
        ];

        foreach ($transfers as $transfer) {
            if ($transfer['origin_warehouse_id'] === $transfer['destination_warehouse_id']) {
                continue;
            }

            Transfer::updateOrCreate(
                [
                    'origin_warehouse_id' => $transfer['origin_warehouse_id'],
                    'destination_warehouse_id' => $transfer['destination_warehouse_id'],
                    'transfer_date' => $transfer['transfer_date'],
                ],
                $transfer
            );
        }
    }
}
