<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => "Ko'ylak",
                'code' => str()->random(5)
            ],
            [
                'name' => "Shim",
                'code' => str()->random(5)
            ],

        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
