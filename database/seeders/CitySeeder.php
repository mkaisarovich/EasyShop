<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Алматы',
            ],
            [
                'name'=>'Астана',
            ],
            [
                'name'=>'Караганды',
            ],
            [
                'name'=>'Актобе',
            ],
            [
                'name'=>'Шымкент',
            ],
        ];

            City::insert($inits);

    }
}
