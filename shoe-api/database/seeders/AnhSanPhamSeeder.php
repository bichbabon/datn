<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\SanPham;
use App\Models\AnhSanPham;

class AnhSanPhamSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Lấy tất cả sản phẩm
        $sanPhams = SanPham::all();

        // Tạo dữ liệu giả cho 3 ảnh cho mỗi sản phẩm
        $sanPhams->each(function ($sanPham) use ($faker) {
            for ($i = 0; $i < 5; $i++) {
                AnhSanPham::create([
                    'sanpham_id' => $sanPham->id,
                    'anhminhhoa' => $faker->imageUrl()
                ]);
            }
        });
    }
}
