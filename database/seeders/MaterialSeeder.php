<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials =  [
            ['name' => 'Mato'],
            ['name' => 'Ip'],
            ['name' => 'Tugma'],
            ['name' => 'Zamok']
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
