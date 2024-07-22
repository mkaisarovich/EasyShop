<?php

namespace Database\Seeders;

use App\Models\ProductStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Вечерний',
            ],
            [
                'name'=>'Деловой',
            ],
            [
                'name'=>'Повседневный',
            ],
            [
                'name'=>'Спортивный',
            ],


        ];

        ProductStyle::insert($inits);
    }
}
