<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $inits = [
            [
                'name'=>'Qazaq Republic',
                'description'=>'Футболки и поло',
                'style_id'=>1,
                'struture_id'=>2,
                'season_id'=>2,
                'discount'=>0,
                'catalog_category_id'=>1,
                'product_category_id'=>2,
                'price'=>10000,
                'discount_price'=>9990,
                'shop_id'=>1,
            ],
            [
                'name'=>'Qazaq Republic 2',
                'description'=>'Футболки и поло 2',
                'style_id'=>2,
                'struture_id'=>3,
                'season_id'=>2,
                'discount'=>0,
                'product_category_id'=>2,
                'catalog_category_id'=>1,
                'price'=>10000,
                'discount_price'=>9990,
                'shop_id'=>1,
            ],
            [
                'name'=>'Qazaq Republic 3',
                'description'=>'Футболки и поло 3',
                'style_id'=>3,
                'struture_id'=>2,
                'season_id'=>2,
                'discount'=>0,
                'product_category_id'=>1,
                'catalog_category_id'=>1,
                'price'=>10000,
                'discount_price'=>9990,
                'shop_id'=>1,
            ],
            [
                'name'=>'Qazaq Republic 4',
                'description'=>'Футболки и поло 4',
                'style_id'=>4,
                'struture_id'=>2,
                'season_id'=>3,
                'discount'=>1,
                'catalog_category_id'=>1,
                'product_category_id'=>3,
                'price'=>10000,
                'discount_price'=>9990,
                'shop_id'=>2,
            ],


        ];

        Product::insert($inits);
    }
}
