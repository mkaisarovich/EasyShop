<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Название компаний 1',
                'user_id'=>3,
                'iin_bin'=>"010203501203",
                'city_id'=>1,
            ],
            [
                'name'=>'Название компаний 2',
                'user_id'=>4,
                'iin_bin'=>"010203571203",
                'city_id'=>1,
            ],

        ];

        Shop::insert($inits);
    }
}
