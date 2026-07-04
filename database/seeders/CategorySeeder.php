<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electrónica', 'description' => 'Dispositivos electrónicos y gadgets'],
            ['name' => 'Ropa', 'description' => 'Prendas de vestir y artículos de moda'],
            ['name' => 'Hogar y Cocina', 'description' => 'Productos para el hogar y la cocina'],
            ['name' => 'Libros', 'description' => 'Libros y literatura', 'is_active' => false],
            ['name' => 'Deportes y Aire Libre', 'description' => 'Artículos deportivos y equipos para exteriores'],
            ['name' => 'Juguetes', 'description' => 'Juguetes y juegos para niños', 'is_active' => false],
            ['name' => 'Salud y Belleza', 'description' => 'Productos de cuidado personal y belleza'],
            ['name' => 'Tecnología', 'description' => 'Accesorios y dispositivos tecnológicos'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
