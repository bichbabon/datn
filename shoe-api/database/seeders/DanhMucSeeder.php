<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\DanhMuc;


class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu giả cho 10 danh mục giày
        for ($i = 1; $i <= 10; $i++) {
            DanhMuc::create([
                'ten' => $faker->word,
            ]);
        }
    }
}
