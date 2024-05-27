<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\SanPhamSizeMauSac;

class DanhGiaController extends Controller
{
    public function index()
    {
        $data = DanhGia::all();

        return response()->json($data);
    }

    public function getDanhGiaTheoIdSanPham($id)
    {
        try {
            // Lấy danh sách các đánh giá mới nhất của sản phẩm với ID là $id
            $reviews = DanhGia::where('sanpham_id', $id)
                ->with('khachHang:id,ten,anhdaidien') // Chọn chỉ các trường 'id', 'ten', 'anhdaidien' của bảng 'khachhang'
                ->orderByDesc('created_at') // Sắp xếp theo thời gian tạo đánh giá giảm dần
                ->take(5) // Lấy ra tối đa 5 đánh giá
                ->get();

            return response()->json($reviews);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi lấy danh sách đánh giá', 'error' => $e->getMessage()], 500);
        }
    }


    public function create(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'sanpham_id' => 'required|exists:sanpham,id',
            'khachhang_id' => 'required|exists:khachhang,id',
            'tyle' => 'required|integer|min:1|max:5',
            'nhanxet' => 'required|string',
        ]);

        // Create a new DanhGia instance
        $danhGia = DanhGia::create([
            'sanpham_id' => $validatedData['sanpham_id'],
            'khachhang_id' => $validatedData['khachhang_id'],
            'tyle' => $validatedData['tyle'],
            'nhanxet' => $validatedData['nhanxet'],
        ]);

        // Return a response
        return response()->json(['message' => 'Đã đánh giá sản phẩm thành công', 'data' => $danhGia], 201);
    }

}
