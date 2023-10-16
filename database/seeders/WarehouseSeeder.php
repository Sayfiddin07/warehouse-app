<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            [
                'material_id' => 1,
                'reminder' => 12,
                'price' => 1500
            ],
            [
                'material_id' => 1,
                'reminder' => 200,
                'price' => 1600
            ],
            [
                'material_id' => 2,
                'reminder' => 40,
                'price' => 500
            ],
            [
                'material_id' => 2,
                'reminder' => 300,
                'price' => 550
            ],
            [
                'material_id' => 3,
                'reminder' => 500,
                'price' => 300
            ],
            [
                'material_id' => 4,
                'reminder' => 1000,
                'price' => 2000
            ],


        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }
}
