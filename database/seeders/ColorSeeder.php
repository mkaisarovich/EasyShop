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
                'hex'=>'#000000',
            ],
            [
                'name'=>'Белый',
                'hex'=>'#FFFFFF',
            ],
            [
                'name'=>'Розовый',
                'hex'=>'#FFC0CB',
            ],
            [
                'name'=>'Синий',
                'hex'=>'#ADD8E6',
            ],
        ];

        Color::insert($inits);
    }
}
