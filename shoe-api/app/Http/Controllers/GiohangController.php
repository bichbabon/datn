<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;

class GiohangController extends Controller
{
    public function index($khachhang_id){
        $giohang = GioHang::where('khachhang_id', $khachhang_id)->get();
        return response()->json($giohang);
    }
    public function addToCart(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'sanpham_size_mausac_id' => 'required|integer',
        'soluong' => 'required|integer|min:1',
        'khachhang_id' => 'required|integer'
    ]);

    // Check if the product variant already exists in the cart for this customer
    $gioHang = GioHang::where('sanpham_size_mausac_id', $validated['sanpham_size_mausac_id'])
                       ->where('khachhang_id', $validated['khachhang_id'])
                       ->first();


    if ($gioHang) {
        // If found, just update the quantity
        $gioHang->soluong += $validated['soluong'];
    } else {
        // If not found, create a new cart item with the given details
        $gioHang = new GioHang([
            'khachhang_id' => $validated['khachhang_id'],
            'sanpham_size_mausac_id' => $validated['sanpham_size_mausac_id'],
            'soluong' => $validated['soluong'],
        ]);
    }

    // Save the cart item
    $gioHang->save();

    // Return a JSON response to indicate success
    return response()->json([
        'message' => 'Product added to cart successfully!'
    ], 201);
}


    public function updateCart(Request $request)
    {

        $giohang = GioHang::where('khachhang_id', $request->khachhang_id)
                    ->where('sanpham_size_mausac_id', $request->sanpham_size_mausac_id)
                    ->first();

        if (!$giohang) {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }

        $giohang->soluong = $request->soluong;
        $giohang->save();

        return response()->json($giohang);
    }

    public function removeFromCart($khachhang_id, $sanpham_size_mausac_id)
    {
        $result = GioHang::where('khachhang_id', $khachhang_id)
                         ->where('sanpham_size_mausac_id', $sanpham_size_mausac_id)
                         ->delete();

        if ($result) {
            return response()->json(['message' => 'Item removed from cart']);
        } else {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }
    }
}