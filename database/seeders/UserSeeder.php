<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inits = [
            [
                'name'=>'Марленttt',
                'email'=>'margo@gmail.com',
                'password'=>bcrypt('margo'),
                'role'=>'user',
                'city_id'=>1,
            ],
            [
                'name'=>'Марлен',
                'email'=>'margo111@gmail.com',
                'password'=>bcrypt('margo'),
                'role'=>'user',
                'city_id'=>3,
            ],
            [
                'name'=>'Название компаний 1',
                'email'=>'company1@gmail.com',
                'password'=>bcrypt('company'),
                'role'=>'partner',
                'city_id'=>1
            ],
            [
                'name'=>'Название компаний 2',
                'email'=>'company2@gmail.com',
                'password'=>bcrypt('company'),
                'role'=>'partner',
                'city_id'=>2
            ],
            [
                'name'=>'Alikhan Baigaziev',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'admin',
                'city_id'=>2
            ],

        ];

            User::insert($inits);

    }
}
