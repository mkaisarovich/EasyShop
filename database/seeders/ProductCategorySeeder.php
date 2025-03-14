<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key checks
        DB::table('product_categories')->truncate(); // Reset table and IDs
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Enable foreign key checks

        $inits = [
            [
                'name'=>'Брюки',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/image.png'),
            ],
            [
                'name'=>'Верхняя одежда',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-1.png'),
            ],
            [
                'name'=>'Джемперы,свитеры и кардиганы',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-1.png'),
            ],
            [
                'name'=>'Джинсы',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-2.png'),
            ],
            [
                'name'=>'Домашняя одежда',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-3.png'),
            ],
            [
                'name'=>'Комбинезоны',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-5.png'),
            ],
            [
                'name'=>'Майки',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-6.png'),
            ],
            [
                'name'=>'Нижнее белье',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-7.png'),
            ],
            [
                'name'=>'Носки и гетры',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-8.png'),
            ],
            [
                'name'=>'Одежда больших размеров',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-9.png'),
            ],
            [
                'name'=>'Пиджаки и костюмы',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-10.png'),
            ],
            [
                'name'=>'Плавки и шорты для плавания',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-11.png'),
            ],
            [
                'name'=>'Рубашки',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-12.png'),
            ],
            [
                'name'=>'Спортивные костюмы',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-13.png'),
            ],
            [
                'name'=>'Термобелье',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-14.png'),
            ],
            [
                'name'=>'Футболки и поло',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-15.png'),
            ],
            [
                'name'=>'Худи и свитшоты',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-16.png'),
            ],
            [
                'name'=>'Шорты',
                'catalog_category_id'=>1,
                'image'=>$this->getAvatarPath('man_clothes/Photo-17.png'),
            ],






            [
                'name'=>'Ботинки',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo.png'),
            ],
            [
                'name'=>'Домашняя обувь',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-1.png'),
            ],
            [
                'name'=>'Кроссовки и кеды',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-2.png'),
            ],
            [
                'name'=>'Мокасины и топсайдеры',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-3.png'),
            ],
            [
                'name'=>'Резиновая обувь',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-4.png'),
            ],
            [
                'name'=>'Сабо',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-6.png'),
            ],
            [
                'name'=>'Сандалии',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-7.png'),
            ],
            [
                'name'=>'Сапоги',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-8.png'),
            ],
            [
                'name'=>'Слипоны',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-9.png'),
            ],
            [
                'name'=>'Туфли',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-10.png'),
            ],
            [
                'name'=>'Экспадрильи',
                'catalog_category_id'=>2,
                'image'=>$this->getAvatarPath('man_shoes/Photo-11.png'),
            ],



            [
                'name'=>'Галстуки и запонки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo.png'),
            ],
            [
                'name'=>'Головные уборы',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-1.png'),
            ],
            [
                'name'=>'Зонты',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-2.png'),
            ],
            [
                'name'=>'Кошельки и брелоки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-3.png'),
            ],
            [
                'name'=>'Очки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-4.png'),
            ],
            [
                'name'=>'Перчатки и варежки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-6.png'),
            ],
            [
                'name'=>'Ремни и подтяжки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-7.png'),
            ],
            [
                'name'=>'Рюкзаки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-8.png'),
            ],
            [
                'name'=>'Сумки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-9.png'),
            ],
            [
                'name'=>'Украшения',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-10.png'),
            ],
            [
                'name'=>'Шарфы и платки',
                'catalog_category_id'=>3,
                'image'=>$this->getAvatarPath('man_access/Photo-11.png'),
            ],




            [
                'name'=>'Блузы и рубашки',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo.png'),
            ],
            [
                'name'=>'Боди',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-1.png'),
            ],
            [
                'name'=>'Брюки',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-2.png'),
            ],
            [
                'name'=>'Верхняя одежда',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-3.png'),
            ],
            [
                'name'=>'Джемперы, свитеры и кардиганы',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-4.png'),
            ],
            [
                'name'=>'Джинсы',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-6.png'),
            ],
            [
                'name'=>'Комбинезоны',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-7.png'),
            ],
            [
                'name'=>'Купальники и пляжная одежда',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-8.png'),
            ],
            [
                'name'=>'Нижнее белье',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-9.png'),
            ],
            [
                'name'=>'Носки, чулки и колготки',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-10.png'),
            ],
            [
                'name'=>'Одежда для беременных',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-11.png'),
            ],
            [
                'name'=>'Пиджаки и костюмы',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-12.png'),
            ],
            [
                'name'=>'Платья и сарафаны',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-13.png'),
            ],
            [
                'name'=>'Топы и майки',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-14.png'),
            ],
            [
                'name'=>'Футболка и поло',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-15.png'),
            ],
            [
                'name'=>'Худи и свитшоты',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-16.png'),
            ],
            [
                'name'=>'Шорты',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-17.png'),
            ],
            [
                'name'=>'Юбки',
                'catalog_category_id'=>4,
                'image'=>$this->getAvatarPath('woman_clothes/Photo-18.png'),
            ],



            [
                'name'=>'Балетки',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo.png'),
            ],
            [
                'name'=>'Босоножки',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-1.png'),
            ],
            [
                'name'=>'Ботильоны',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-2.png'),
            ],
            [
                'name'=>'Ботинки',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-3.png'),
            ],
            [
                'name'=>'Вечерняя обувь',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-4.png'),
            ],
            [
                'name'=>'Домашняя обувь',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-6.png'),
            ],
            [
                'name'=>'Дутая обувь',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-7.png'),
            ],
            [
                'name'=>'Кроссовки и кеды',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-8.png'),
            ],
            [
                'name'=>'Мокасины и топсайдеры',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-9.png'),
            ],
            [
                'name'=>'Резиновая обувь',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-10.png'),
            ],
            [
                'name'=>'Сабо и мюли',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-11.png'),
            ],
            [
                'name'=>'Сандалии',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-12.png'),
            ],
            [
                'name'=>'Сапоги',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-13.png'),
            ],
            [
                'name'=>'Слипоны',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-14.png'),
            ],
            [
                'name'=>'Туфли',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-15.png'),
            ],
            [
                'name'=>'Экспадрильи',
                'catalog_category_id'=>5,
                'image'=>$this->getAvatarPath('woman_shoes/Photo-16.png'),
            ],




            [
                'name'=>'Галстуки и запонки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo.png'),
            ],
            [
                'name'=>'Головные уборы',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-1.png'),
            ],
            [
                'name'=>'Зонты',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-2.png'),
            ],
            [
                'name'=>'Кошельки и брелоки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-3.png'),
            ],
            [
                'name'=>'Очки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-4.png'),
            ],
            [
                'name'=>'Перчатки и варежки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-6.png'),
            ],
            [
                'name'=>'Ремни и подтяжки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-7.png'),
            ],
            [
                'name'=>'Рюкзаки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-8.png'),
            ],
            [
                'name'=>'Сумки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-9.png'),
            ],
            [
                'name'=>'Украшения',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-10.png'),
            ],
            [
                'name'=>'Шарфы и платки',
                'catalog_category_id'=>6,
                'image'=>$this->getAvatarPath('woman_access/Photo-11.png'),
            ],


            [
                'name'=>'Аксессуары',
                'catalog_category_id'=>7,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-1.png'),
            ],
            [
                'name'=>'Обувь',
                'catalog_category_id'=>7,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-2.png'),
            ],
            [
                'name'=>'Одежда',
                'catalog_category_id'=>7,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-3.png'),
            ],
            [
                'name'=>'Спорт',
                'catalog_category_id'=>7,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-4.png'),
            ],


            [
                'name'=>'Аксессуары',
                'catalog_category_id'=>8,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-1.png'),
            ],
            [
                'name'=>'Обувь',
                'catalog_category_id'=>8,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-2.png'),
            ],
            [
                'name'=>'Одежда',
                'catalog_category_id'=>8,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-3.png'),
            ],
            [
                'name'=>'Спорт',
                'catalog_category_id'=>8,
                'image'=>$this->getAvatarPath('boys_girls/girls/Photo-4.png'),
            ],




            [
                'name'=>'Аксессуары',
                'catalog_category_id'=>9,
                'image'=>$this->getAvatarPath('babies/Photo-1.png'),
            ],
            [
                'name'=>'Конверты и одеяла',
                'catalog_category_id'=>9,
                'image'=>$this->getAvatarPath('babies/Photo-2.png'),
            ],
            [
                'name'=>'Обувь',
                'catalog_category_id'=>9,
                'image'=>$this->getAvatarPath('babies/Photo-3.png'),
            ],
            [
                'name'=>'Одежда',
                'catalog_category_id'=>9,
                'image'=>$this->getAvatarPath('babies/Photo-4.png'),
            ],



        ];

        ProductCategory::insert($inits);
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
