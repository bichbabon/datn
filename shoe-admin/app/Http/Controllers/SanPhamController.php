<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index(){
        return view("sanpham.index");
    }

    public function edit(){
        return view("sanpham.edit");
    }
    public function add(){
        return view('sanpham.add');
    }
}
