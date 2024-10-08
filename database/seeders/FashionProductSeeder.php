<?php

namespace Database\Seeders;

use App\Models\FashionProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FashionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'product_id'=>1,
                'fashion_id'=>1,
            ],
            [
                'product_id'=>2,
                'fashion_id'=>2,
            ],
            [
                'product_id'=>3,
                'fashion_id'=>3,
            ],
            [
                'product_id'=>4,
                'fashion_id'=>4,
            ],


        ];

        FashionProduct::insert($inits);
    }
}
