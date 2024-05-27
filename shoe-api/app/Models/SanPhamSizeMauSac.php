<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamSizeMauSac extends Model
{
    use HasFactory;
    protected $table = "sanpham_size_mausac";

    protected $fillable = ['mausac_id','size_id','soluong'];

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function mausac()
    {
        return $this->belongsTo(MauSac::class, 'mausac_id');
    }

    public function danhGias()
    {
        return $this->hasMany('App\Models\DanhGia', 'sanpham_size_mausac_id');
    }

    public function sanPham()
    {
        return $this->belongsTo('App\Models\SanPham', 'sanpham_id');
    }

}
