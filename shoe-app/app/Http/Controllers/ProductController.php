<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id) {
        return view('product.detail', ['id' => $id]);
    }
    public function index(){
        return view('product.index');
    }
    
}
