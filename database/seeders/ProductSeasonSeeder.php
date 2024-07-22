<?php

namespace Database\Seeders;

use App\Models\ProductSeason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Лето',
            ],
            [
                'name'=>'Зима',
            ],
            [
                'name'=>'Осень',
            ],
            [
                'name'=>'Весна',
            ],
            [
                'name'=>'Демисезон',
            ],


        ];

        ProductSeason::insert($inits);
    }
}
