<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );

        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            UnitSeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            SupplierSeeder::class,
            PurchaseSeeder::class,
            PurchaseItemSeeder::class,
            TransferSeeder::class,
            TransferItemSeeder::class,
            InventorySeeder::class,
            InventoryMovementSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
