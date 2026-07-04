<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Distribuidora Andina SAC',
                'document_number' => '20123456789',
                'email' => 'ventas@andina.test',
                'phone' => '+51 900 100 100',
                'address' => 'Av. Comercio 245, Lima',
                'contact_name' => 'Luis Rojas',
                'is_active' => true,
                'notes' => 'Proveedor principal de tecnologia.',
            ],
            [
                'name' => 'Importaciones Pacifico EIRL',
                'document_number' => '20987654321',
                'email' => 'contacto@pacifico.test',
                'phone' => '+51 900 200 200',
                'address' => 'Jr. Industria 512, Arequipa',
                'contact_name' => 'Maria Salas',
                'is_active' => true,
                'notes' => 'Manejo de entregas de 24 a 48 horas.',
            ],
            [
                'name' => 'Proveedora Norte SRL',
                'document_number' => '20654321987',
                'email' => 'soporte@norte.test',
                'phone' => '+51 900 300 300',
                'address' => 'Calle Norte 88, Trujillo',
                'contact_name' => 'Jorge Perez',
                'is_active' => false,
                'notes' => 'Proveedor alterno para picos de demanda.',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::updateOrCreate(
                ['document_number' => $supplier['document_number']],
                $supplier
            );
        }
    }
}
