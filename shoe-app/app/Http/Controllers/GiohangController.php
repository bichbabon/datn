<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GiohangController extends Controller
{
    public function index(){
        return view("cart.index");
    }

    public function donhang(){
        return view("cart.order");
    }
}
