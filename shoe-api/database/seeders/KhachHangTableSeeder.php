<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class KhachHangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('khachhang')->insert([
                'ten' => $faker->name,
                'diachi' => $faker->address,
                'sdt' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'matkhau' => Hash::make('password'),
                'anhdaidien' => $faker->imageUrl(),
                'tinhtrang' => $faker->randomElement(['hoatdong', 'vohieuhoa']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
