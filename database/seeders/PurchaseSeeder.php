<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierIds = Supplier::pluck('id')->all();
        $userIds = User::pluck('id')->all();

        if (empty($supplierIds) || empty($userIds)) {
            return;
        }

        $purchases = [
            [
                'supplier_id' => $supplierIds[0],
                'user_id' => $userIds[0],
                'purchase_number' => 'PUR-2026-0001',
                'status' => 'received',
                'purchase_date' => now()->subDays(5)->toDateString(),
                'total' => 0,
                'notes' => 'Compra de reposicion semanal.',
            ],
            [
                'supplier_id' => $supplierIds[1] ?? $supplierIds[0],
                'user_id' => $userIds[0],
                'purchase_number' => 'PUR-2026-0002',
                'status' => 'confirmed',
                'purchase_date' => now()->subDays(2)->toDateString(),
                'total' => 0,
                'notes' => 'Compra confirmada pendiente de recepcion completa.',
            ],
            [
                'supplier_id' => $supplierIds[2] ?? $supplierIds[0],
                'user_id' => $userIds[0],
                'purchase_number' => 'PUR-2026-0003',
                'status' => 'draft',
                'purchase_date' => now()->toDateString(),
                'total' => 0,
                'notes' => 'Borrador para proxima orden.',
            ],
        ];

        foreach ($purchases as $purchase) {
            Purchase::updateOrCreate(
                ['purchase_number' => $purchase['purchase_number']],
                $purchase
            );
        }
    }
}
