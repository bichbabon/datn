<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = "donhang";
    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class,"donhang_id");
    }

    public function khachhang()
    {
        return $this->hasMany(KhachHang::class,"id");
    }

}
