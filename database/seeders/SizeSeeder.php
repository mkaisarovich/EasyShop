<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'XS',
                'type'=>'clothes'
            ],
            [
                'name'=>'S',
                'type'=>'clothes'
            ],
            [
                'name'=>'M',
                'type'=>'clothes'
            ],
            [
                'name'=>'XL',
                'type'=>'clothes'
            ],
            [
                'name'=>'2XL',
                'type'=>'clothes'
            ],
            [
                'name'=>'3XL',
                'type'=>'clothes'
            ],
            [
                'name'=>'4XL',
                'type'=>'clothes'
            ],
            [
                'name'=>'5XL',
                'type'=>'clothes'
            ],
            [
                'name'=>'6XL',
                'type'=>'clothes'
            ],
        ];

        Size::insert($inits);
    }
}
