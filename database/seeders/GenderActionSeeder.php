<?php

namespace Database\Seeders;

use App\Models\GenderAction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'gender_id'=>3,
                'shop_id'=>1,
            ],

        ];

        GenderAction::insert($inits);
    }
}
