<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Unidad', 'symbol' => 'u', 'description' => 'Unidad de medida individual'],
            ['name' => 'Kilogramo', 'symbol' => 'kg', 'description' => 'Unidad de masa'],
            ['name' => 'Litro', 'symbol' => 'l', 'description' => 'Unidad de volumen'],
            ['name' => 'Metro', 'symbol' => 'm', 'description' => 'Unidad de longitud'],
            ['name' => 'Gramo', 'symbol' => 'g', 'description' => 'Unidad de masa'],
            ['name' => 'Mililitro', 'symbol' => 'ml', 'description' => 'Unidad de volumen'],
            ['name' => 'Centímetro', 'symbol' => 'cm', 'description' => 'Unidad de longitud'],
        ];

        foreach ($units as $unit) {
            Unit::updateOrCreate(
                ['symbol' => $unit['symbol']],
                $unit
            );
        }
    }
}
