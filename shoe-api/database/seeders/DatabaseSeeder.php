<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DanhMucSeeder::class,
            MauSacSeeder::class,
            SizeSeeder::class,
            ThuongHieuSeeder::class,
            AnhSanPhamSeeder::class,
            SanPhamSeeder::class,
            SanPhamDanhMucSeeder::class,
            SanPhamSizeMauSacSeeder::class,
            KhachHangTableSeeder::class,
            DanhGiaTableSeeder::class,
        ]);
    }
}
