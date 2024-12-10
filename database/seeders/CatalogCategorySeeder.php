<?php

namespace Database\Seeders;

use App\Models\CatalogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Одежда',
                'gender_id'=>1,
//                'shop_id'=>1,
            ],
            [
                'name'=>'Обувь',
                'gender_id'=>1,
//                'shop_id'=>1,
            ],
            [
                'name'=>'Аксессуары',
                'gender_id'=>1,
//                'shop_id'=>1,
            ],
            [
                'name'=>'Одежда',
                'gender_id'=>2,
//                'shop_id'=>1,
            ],
            [
                'name'=>'Обувь',
                'gender_id'=>2,
//                'shop_id'=>1,
            ],
            [
                'name'=>'Аксессуары',
                'gender_id'=>2,
//                'shop_id'=>1,
            ],
            [
                'name'=>'МАЛЬЧИКАМ',
                'gender_id'=>3,
//                'shop_id'=>1,
            ],
            [
                'name'=>'ДЕВУШКАМ',
                'gender_id'=>3,
//                'shop_id'=>1,
            ],
            [
                'name'=>'МАЛЫШАМ',
                'gender_id'=>3,
//                'shop_id'=>1,
            ],
        ];

        CatalogCategory::insert($inits);
    }


    public function getAvatarPath($filename)
    {
        // Assuming the image is stored in `storage/app/public/shops/`
//        if (Storage::disk('public')->exists("shops/{$filename}")) {
        return config('app.url') . "/storage/category/category/{$filename}";
//        }

        // Fallback in case the image is missing
//        return null; // or return a default placeholder image path
    }
}
