<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamDanhMuc extends Model
{
    use HasFactory;
    protected $table = "sanpham_danhmuc";

    protected $fillable = ['sanpham_id','danhmuc_id'];

    public $timestamps = false;
}
