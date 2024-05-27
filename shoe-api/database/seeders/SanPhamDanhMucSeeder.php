<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\SanPhamDanhMuc;
use Faker\Factory as Faker;

class SanPhamDanhMucSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách tất cả sản phẩm
        $sanPhams = SanPham::all();

        // Lặp qua từng sản phẩm
        foreach ($sanPhams as $sanPham) {
            // Tạo số lượng danh mục ngẫu nhiên từ 1 đến 3
            $numDanhMuc = $faker->numberBetween(1, 4);

            // Lấy danh sách tất cả danh mục
            $danhMucs = DanhMuc::inRandomOrder()->limit($numDanhMuc)->get();

            // Lặp qua từng danh mục và tạo bản ghi cho bảng sanpham_danhmuc
            foreach ($danhMucs as $danhMuc) {
                SanPhamDanhMuc::create([
                    'sanpham_id' => $sanPham->id,
                    'danhmuc_id' => $danhMuc->id,
                ]);
            }
        }
    }
}
