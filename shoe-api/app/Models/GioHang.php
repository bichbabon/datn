<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    use HasFactory;
    protected $table = "giohang";

    protected $fillable = ['khachhang_id','sanpham_size_mausac_id','soluong'];

    public function sanphamSizeMauSac()
    {
        return $this->belongsTo(SanPhamSizeMauSac::class, 'sanpham_size_mausac_id');
    }
}
