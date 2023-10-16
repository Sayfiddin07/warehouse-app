<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_materials =  [
            [
                'product_id' => 1,
                'material_id' => 1,
                'quantity' => 0.8
            ],
            [
                'product_id' => 1,
                'material_id' => 3,
                'quantity' => 5
            ],
            [
                'product_id' => 1,
                'material_id' => 2,
                'quantity' => 10
            ],

            [
                'product_id' => 2,
                'material_id' => 1,
                'quantity' => 1.4
            ],
            [
                'product_id' => 2,
                'material_id' => 2,
                'quantity' => 15
            ],
            [
                'product_id' => 2,
                'material_id' => 4,
                'quantity' => 1
            ],


        ];

        foreach ($product_materials as $product_material) {
            DB::table('product_materials')->insert($product_material);
        }
    }
}
