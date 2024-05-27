<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DanhGiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        // Fetching existing IDs from related tables
        $sanphamIds = DB::table('sanpham')->pluck('id')->toArray();
        $khachHangIds = DB::table('khachhang')->pluck('id')->toArray();

        // Check if there are enough IDs to avoid errors
        if (empty($sanphamIds) || empty($khachHangIds)) {
            echo "Required data in sanpham_size_mausac or khachhang is missing.";
            return;
        }

        // Insert 1000 reviews
        for ($i = 1; $i <= 2000; $i++) {
            DB::table('danhgia')->insert([
                'sanpham_id' => $sanphamIds[array_rand($sanphamIds)],
                'khachhang_id' => $khachHangIds[array_rand($khachHangIds)],
                'tyle' => rand(1, 5), // Assuming a rating scale of 1-5
                'nhanxet' => $faker->text,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
