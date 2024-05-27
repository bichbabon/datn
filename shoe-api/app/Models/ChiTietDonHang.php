<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = "chitietdonhang";

    public function sanphamSizeMauSac()
    {
        return $this->belongsTo(SanPhamSizeMauSac::class);
    }

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'donhang_id');  // Đảm bảo 'donhang_id' chính là tên cột
    }


}
