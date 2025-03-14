<?php

namespace Database\Seeders;

use App\Models\CatalogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key checks
        DB::table('catalog_categories')->truncate(); // Reset table and IDs
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Enable foreign key checks



        $inits = [
            [
                'name'=>'Одежда',
                'gender_id'=>1,
//                'shop_id'=>1,
                'image'=>'http://77.246.247.60/storage/catalog/WomanClothes.png'
            ],
            [
                'name'=>'Обувь',
                'gender_id'=>1,
//                'shop_id'=>1,
                'image'=>'http://77.246.247.60/storage/catalog/WomanShoes.png'
            ],
            [
                'name'=>'Аксессуары',
                'gender_id'=>1,
//                'shop_id'=>1,
                'image'=>'http://77.246.247.60/storage/catalog/WomanAccess.png'
            ],
            [
                'name'=>'Одежда',
                'gender_id'=>2,
//                'shop_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/d8fc7552caf370005bb5306bb92373d1.png')
            ],
            [
                'name'=>'Обувь',
                'gender_id'=>2,
//                'shop_id'=>1,
                'image'=>$this->getAvatarPath('man_shoes/213902f531f9d9ebaf4b9d6003696889.png')
            ],
            [
                'name'=>'Аксессуары',
                'gender_id'=>2,
//                'shop_id'=>1,
                'image'=>$this->getAvatarPath('man_access/01f445cf4cfe30c286eacca3dadb7874.png')
            ],
            [
                'name'=>'МАЛЬЧИКАМ',
                'gender_id'=>3,
//                'shop_id'=>1,
                'image'=>$this->getAvatarPath('boys_girls/boys/1c0fc35e9c8c9f1e32f63c97c47dd70d.png')
            ],
            [
                'name'=>'ДЕВУШКАМ',
                'gender_id'=>3,
//                'shop_id'=>1,
                'image'=>$this->getAvatarPath('boys_girls/girls/3c0b03430a4b2a49e79c3bbe53cbba53.png')
            ],
            [
                'name'=>'МАЛЫШАМ',
                'gender_id'=>3,
//                'shop_id'=>1,
                'image'=>$this->getAvatarPath('babies/813797ada4461bcddc3312e03a663313.png')
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
