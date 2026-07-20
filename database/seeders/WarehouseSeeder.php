<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            [
                'name' => 'Almacén Central',
                'code' => 'WH-001',
                'address' => 'Calle Principal 123',
                'description' => 'Almacén principal para almacenamiento general.',
            ],
            [
                'name' => 'Almacén Norte',
                'code' => 'WH-002',
                'address' => 'Avenida Norte 456',
                'description' => 'Almacén de apoyo para distribución al norte.',
            ],
            [
                'name' => 'Almacén Sur',
                'code' => 'WH-003',
                'address' => 'Boulevard Sur 789',
                'description' => 'Almacén secundario para cobertura regional.',
            ],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::updateOrCreate(
                ['code' => $warehouse['code']],
                $warehouse
            );
        }
    }
}
