<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnhSanPham extends Model
{
    use HasFactory;

    protected $table = "anhsanpham";
    protected $fillable = ['anhminhhoa'];
}
