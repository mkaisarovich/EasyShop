<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Ожидание',
            ],
            [
                'name'=>'Принят',
            ],
            [
                'name'=>'Готово',
            ],
            [
                'name'=>'Продано',
            ],

        ];

        Status::insert($inits);
    }
}
