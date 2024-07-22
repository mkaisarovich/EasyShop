<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Брюки',
            ],
            [
                'name'=>'Верхняя одежда',
            ],[
                'name'=>'Джемперы,свитеры и кардиганы',
            ],
        ];

        ProductCategory::insert($inits);
    }
}
