<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\ThuongHieu;

class ThuongHieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Tạo dữ liệu giả cho 10 thương hiệu
        for ($i = 1; $i <= 10; $i++) {
            ThuongHieu::create([
                'ten' => $faker->company,
            ]);
        }
    }
}
