<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Черный',
            ],
            [
                'name'=>'Белый',
            ],
            [
                'name'=>'Розовый',
            ],
            [
                'name'=>'Синий',
            ],
        ];

        Color::insert($inits);
    }
}
