<?php

namespace Database\Seeders;

use App\Models\Api\Currency\Divisas;
use App\Models\Api\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dolar = Divisas::where('name', 'Dolar')->first();
        $euro = Divisas::where('name', 'Euro')->first();
        $peso = Divisas::where('name', 'Peso Colombiano')->first();

        $products = [
            [
                'name' => 'Laptop HP Pavilion',
                'description' => 'Laptop HP Pavilion 15.6" con procesador Intel Core i5, 16GB RAM, 512GB SSD',
                'price' => 799.99,
                'tax_cost' => 120.00,
                'manufacturing_cost' => 450.00,
                'divisa_id' => $dolar->id,
            ],
            [
                'name' => 'Teclado Mecánico Logitech',
                'description' => 'Teclado mecánico RGB con switches Cherry MX Red',
                'price' => 89.50,
                'tax_cost' => 13.43,
                'manufacturing_cost' => 35.00,
                'divisa_id' => $dolar->id,
            ],
            [
                'name' => 'Monitor Samsung 27"',
                'description' => 'Monitor curvo 27 pulgadas QHD 144Hz',
                'price' => 349.00,
                'tax_cost' => 52.35,
                'manufacturing_cost' => 180.00,
                'divisa_id' => $euro->id,
            ],
            [
                'name' => 'Mouse Inalámbrico Razer',
                'description' => 'Mouse ergonómico inalámbrico con sensor óptico de 20000 DPI',
                'price' => 59.99,
                'tax_cost' => 9.00,
                'manufacturing_cost' => 20.00,
                'divisa_id' => $dolar->id,
            ],
            [
                'name' => 'Audífonos Sony WH-1000XM5',
                'description' => 'Audífonos over-ear con cancelación de ruido activa y Bluetooth 5.2',
                'price' => 1500000.00,
                'tax_cost' => 225000.00,
                'manufacturing_cost' => 600000.00,
                'divisa_id' => $peso->id,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
