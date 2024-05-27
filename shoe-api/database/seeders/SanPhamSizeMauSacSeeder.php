<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanPhamSizeMauSac;
use App\Models\Size;
use App\Models\MauSac;
use App\Models\SanPham;

class SanPhamSizeMauSacSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh sách sản phẩm từ cơ sở dữ liệu
        $sanPhams = SanPham::all();

        // Lặp qua từng sản phẩm
        foreach ($sanPhams as $sanPham) {
            // Lấy ngẫu nhiên số lượng size và màu sắc cho sản phẩm
            $soLuongSize = rand(1, 5); // Giả sử mỗi sản phẩm có từ 1 đến 5 size
            $soLuongMauSac = rand(1, 5); // Giả sử mỗi sản phẩm có từ 1 đến 5 màu sắc

            // Lấy danh sách size và màu sắc từ cơ sở dữ liệu
            $sizes = Size::inRandomOrder()->limit($soLuongSize)->get();
            $mauSacs = MauSac::inRandomOrder()->limit($soLuongMauSac)->get();

            // Lặp qua từng size và màu sắc, tạo bản ghi tương ứng trong bảng sanpham_size_mausac
            foreach ($sizes as $size) {
                foreach ($mauSacs as $mauSac) {
                    SanPhamSizeMauSac::create([
                        'sanpham_id' => $sanPham->id,
                        'size_id' => $size->id,
                        'mausac_id' => $mauSac->id,
                        'soluong' => rand(1, 20), // Giả sử mỗi sản phẩm có từ 1 đến 20 sản phẩm cho mỗi cặp size và màu sắc
                    ]);
                }
            }
        }
    }
}
