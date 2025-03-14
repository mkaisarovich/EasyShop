<?php

namespace Database\Seeders;

use App\Models\Mall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Mega Almaty',
                'address'=>"ТЦ Mega Almaty, Ул Розыбакиева 247 а",
                'city_id'=>1,
                'avatar'=>$this->getAvatarPath('5898934_1920.jpg')
            ],
            [
                'name'=>'Dostyk Plaza Almaty',
                'address'=>"ТЦ Dostyk Plaza Almaty, микрорайон Самал-2 111",
                'city_id'=>1,
                'avatar'=>$this->getAvatarPath('section-about-img-1.png')
            ]
        ];

        Mall::insert($inits);
    }

    public function getAvatarPath($filename)
    {
        // Assuming the image is stored in `storage/app/public/shops/`
        if (Storage::disk('public')->exists("malls/{$filename}")) {
            return config('app.url') . "/storage/malls/{$filename}";
        }

        // Fallback in case the image is missing
        return null; // or return a default placeholder image path
    }


}
