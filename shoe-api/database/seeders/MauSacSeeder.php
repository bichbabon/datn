<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\MauSac;

class MauSacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu giả cho 10 màu sắc
        for ($i = 1; $i <= 10; $i++) {
            MauSac::create([
                'ten' => $faker->colorName,
            ]);
        }

    }
}
