<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = "sanpham";

    protected $fillable = ['ten','mausac_id','thuonghieu_id','mota','gioithieu','gia','sanxuat','docao'];

    public function danhmuc()
    {
        return $this->belongsToMany(DanhMuc::class, 'sanpham_danhmuc', 'sanpham_id', 'danhmuc_id');
    }

    public function thuonghieu()
    {
        return $this->belongsTo(ThuongHieu::class, 'thuonghieu_id');
    }

    public function anhsanpham()
    {
        return $this->hasMany(AnhSanPham::class, 'sanpham_id');
    }
    public function sanphamsizemausac()
    {
        return $this->hasMany(SanPhamSizeMauSac::class, 'sanpham_id');
    }
    public function danhgia()
    {
        return $this->hasMany(DanhGia::class, 'sanpham_id');
    }
}
