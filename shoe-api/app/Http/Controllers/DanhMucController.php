<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;

class DanhMucController extends Controller
{
    public function index()
    {
        $danhMuc = DanhMuc::all();
        return response()->json($danhMuc);
    }

    public function show($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        return response()->json($danhMuc);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
        ]);

        $danhMuc = new DanhMuc();
        $danhMuc->ten = $request->ten;
        $danhMuc->save();

        return response()->json(['message' => 'Danh mục đã được thêm thành công'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
        ]);

        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->ten = $request->ten;
        $danhMuc->save();

        return response()->json(['message' => 'Danh mục đã được cập nhật thành công'], 200);
    }

    public function destroy($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->delete();

        return response()->json(['message' => 'Danh mục đã được xóa thành công'], 200);
    }
}
