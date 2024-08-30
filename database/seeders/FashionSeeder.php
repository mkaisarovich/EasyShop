<?php

namespace Database\Seeders;

use App\Models\Fashion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FashionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Образ номер 1',
                'style_id'=>1,
                'season_id'=>1,
                'price'=>35900,
                'discount_price'=>25100,
                'shop_id'=>1,
                'user_id'=>1,
            ],
            [
                'name'=>'Образ номер 2',
                'style_id'=>2,
                'season_id'=>2,
                'price'=>35900,
                'discount_price'=>null,
                'shop_id'=>1,
                'user_id'=>1,
            ],
            [
                'name'=>'Образ номер 3',
                'style_id'=>3,
                'season_id'=>3,
                'price'=>35900,
                'discount_price'=>null,
                'shop_id'=>1,
                'user_id'=>1,
            ],
            [
                'name'=>'Образ номер 4',
                'style_id'=>4,
                'season_id'=>4,
                'price'=>35900,
                'discount_price'=>null,
                'shop_id'=>1,
                'user_id'=>2,
            ],


        ];

        Fashion::insert($inits);
    }
}
