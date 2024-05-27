<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThuongHieuController extends Controller
{
    public function index(){
        return view("thuonghieu.index");
    }
}
