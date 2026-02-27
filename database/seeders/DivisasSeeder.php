<?php

namespace Database\Seeders;

use App\Models\Api\Currency\Divisas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $divisas = [
            [
                'name' => 'Dolar',
                'symbol' => '$',
                'exchange_rate' => 1,
            ],
            [
                'name' => 'Euro',
                'symbol' => '€',
                'exchange_rate' => 1.5,
            ],
            [
                'name' => 'Peso Colombiano',
                'symbol' => '$',
                'exchange_rate' => 4,
            ]
        ];

        foreach ($divisas as $divisa) {
            Divisas::create($divisa);
        }
    }
}
