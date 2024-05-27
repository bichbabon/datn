<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $table = "danhgia";

    protected $fillable = ['sanpham_id','khachhang_id','tyle','nhanxet'];

    public function sanpham()
    {
        return $this->belongsTo('App\Models\SanPham', 'sanpham _id');
    }

    public function khachHang()
    {
        return $this->belongsTo('App\Models\KhachHang', 'khachhang_id');
    }
    

}
