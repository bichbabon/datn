<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function productCategoryStatistics()
    {
        $categories = DanhMuc::withCount('sanphams')->get(['id', 'ten', 'products_count']);
        
        return response()->json(['categories' => $categories]);
    }
}