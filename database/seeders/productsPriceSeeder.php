<?php

namespace Database\Seeders;

use App\Models\Api\Currency\Divisas;
use App\Models\Api\Detail\ProductPrice;
use App\Models\Api\Product;
use Illuminate\Database\Seeder;

class ProductsPriceSeeder extends Seeder
{
    public function run(): void
    {
        //
        $divisas = Divisas::all();
        $products = Product::all();

        foreach ($products as $product) {
            foreach ($divisas as $divisa) {
                $convertedPrice = $product->price * $divisa->exchange_rate;

                ProductPrice::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'divisa_id' => $divisa->id,
                    ],
                    [
                        'price' => $convertedPrice,
                    ]
                );
            }
        }
    }
}
