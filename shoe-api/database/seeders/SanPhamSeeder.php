<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\SanPham;

class SanPhamSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            SanPham::create([
                'ten' => $faker->sentence(3),
                'gia' => $faker->numberBetween(100, 500)*100,
                'thuonghieu_id' => $faker->numberBetween(1, 10),
                'gioithieu' => $faker->paragraph,
                'sanxuat' => $faker->company,
                'docao' => $faker->randomFloat(2, 1, 10),
                'mota' => $faker->paragraph,
                'giamgia' => $faker->numberBetween(0, 70),
            ]);
        }
    }
}

