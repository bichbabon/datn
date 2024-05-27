<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = "danhmuc";

    public function sanphams()
    {
        return $this->belongsToMany(SanPham::class, 'sanpham_danhmuc', 'danhmuc_id', 'sanpham_id');
    }
}
