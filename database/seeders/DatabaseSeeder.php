<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            ShopSeeder::class,
            CategorySeeder::class,
            GenderSeeder::class,
            CatalogCategorySeeder::class,
            GenderActionSeeder::class,
            ProductCategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductStructureSeeder::class,
            ProductStyleSeeder::class,
            ProductSeasonSeeder::class,
            ProductSeeder::class,
            FashionSeeder::class,
            FashionProductSeeder::class,
            MallSeeder::class
        ]);
    }
}
