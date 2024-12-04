<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $inits = [
            [
                'name'=>'БРЮКИ С АБСТРАКТНЫМ ПРИНТОМ',
                'description'=>'
ВНЕШНЯЯ ЧАСТЬ
100% органический хлопок, сертифицированный OCS',
                'style_id'=>1,
                'color_id'=>1,
                'struture_id'=>2,
                'season_id'=>2,
                'discount'=>0,
                'catalog_category_id'=>1,
                'product_category_id'=>1,
                'price'=>35990,
                'discount_price'=>29500,
                'shop_id'=>1,
                'type'=>'hoody',
                'subcatalog_id'=>9
//                'count'=>10/
            ],
            [
                'name'=>'ЦВЕТНЫЕ БРЮКИ С ВОЩЕНЫМ ПОКРЫТИЕМ',
                'description'=>'СОСТАВ, УХОД И ПРОИСХОЖДЕНИЕ
СОСТАВ
Мы работаем с программами мониторинга, чтобы гарантировать соблюдение наших стандартов, касающихся социальных и экологических ',
                'style_id'=>2,
                'struture_id'=>3,
                'color_id'=>2,
                'season_id'=>2,
                'discount'=>1,
                'product_category_id'=>1,
                'catalog_category_id'=>1,
                'price'=>10000,
                'discount_price'=>9990,
                'shop_id'=>1,
                'type'=>'hoody',
                'subcatalog_id'=>2
//                'count'=>10
            ],
            [
                'name'=>'Футболка H&M',
                'description'=>'Футболка H&M',
                'style_id'=>3,
                'struture_id'=>2,
                'season_id'=>2,
                'color_id'=>3,
                'discount'=>1,
                'product_category_id'=>2,
                'catalog_category_id'=>1,
                'price'=>6454,
                'discount_price'=>6261,
                'shop_id'=>2,
                'type'=>'t_shirt',
                'subcatalog_id'=>5
//                'count'=>10
            ],
            [
                'name'=>'Худи H&M',
                'description'=>'Худи H&M',
                'style_id'=>4,
                'struture_id'=>2,
                'season_id'=>3,
                'color_id'=>4,
                'discount'=>1,
                'catalog_category_id'=>1,
                'product_category_id'=>1,
                'price'=>7051,
                'discount_price'=>6156,
                'shop_id'=>2,
                'type'=>'t_shirt',
                'subcatalog_id'=>14
//                'count'=>10
            ],


        ];

        Product::insert($inits);



        $in = [
            [
                'product_id'=>1,
                'image'=>$this->getAvatarPath('6788549124.webp'),

            ],
            [
                'product_id'=>2,
                'image'=>$this->getAvatarPath('09632901122-p.jpg'),
            ],
            [
                'product_id'=>3,
                'image'=>$this->getAvatarPath('6788549124.webp'),

            ],
            [
                'product_id'=>4,
                'image'=>$this->getAvatarPath('00706190711-p.jpg'),
            ],


        ];

        ProductImage::insert($in);


    }



    public function getAvatarPath($filename)
    {
        // Assuming the image is stored in `storage/app/public/shops/`
//        if (Storage::disk('public')->exists("shops/{$filename}")) {
            return config('app.url') . "/storage/products/image/{$filename}";
//        }

        // Fallback in case the image is missing
//        return null; // or return a default placeholder image path
    }
}
