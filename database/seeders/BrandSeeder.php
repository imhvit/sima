<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Samsung', 'description' => 'Marca líder en electrónica y tecnología'],
            ['name' => 'Apple', 'description' => 'Dispositivos y accesorios premium'],
            ['name' => 'Sony', 'description' => 'Electrónica y entretenimiento de alta calidad'],
            ['name' => 'LG', 'description' => 'Electrodomésticos y pantallas', 'is_active' => false],
            ['name' => 'Nike', 'description' => 'Artículos deportivos y ropa deportiva'],
            ['name' => 'Adidas', 'description' => 'Equipos y prendas deportivas', 'is_active' => false],
            ['name' => 'Philips', 'description' => 'Dispositivos de salud y bienestar'],
            ['name' => 'Bosch', 'description' => 'Herramientas y electrodomésticos profesionales'],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrCreate(
                ['name' => $brand['name']],
                $brand
            );
        }
    }
}
