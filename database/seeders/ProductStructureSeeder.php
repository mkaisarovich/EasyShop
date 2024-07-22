<?php

namespace Database\Seeders;

use App\Models\ProductStructure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Хлопок',
            ],
            [
                'name'=>'Лен',
            ],
            [
                'name'=>'Лайкра',
            ],
            [
                'name'=>'Кожа',
            ],


        ];

        ProductStructure::insert($inits);
    }
}
