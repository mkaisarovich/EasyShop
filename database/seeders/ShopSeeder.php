<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Zara',
                'user_id'=>3,
                'iin_bin'=>"010203501203",
                'city_id'=>1,
                'avatar'=>$this->getAvatarPath('z3twpjpr444795.jpg')
            ],
            [
                'name'=>'H&M',
                'user_id'=>4,
                'iin_bin'=>"010203571203",
                'city_id'=>1,
                'avatar'=>$this->getAvatarPath('HM-Share-Image.jpg')
            ],

        ];

        Shop::insert($inits);
    }


    public function getAvatarPath($filename)
    {
        // Assuming the image is stored in `storage/app/public/shops/`
        if (Storage::disk('public')->exists("shops/{$filename}")) {
            return config('app.url') . "/storage/shops/{$filename}";
        }

        // Fallback in case the image is missing
        return null; // or return a default placeholder image path
    }
}
