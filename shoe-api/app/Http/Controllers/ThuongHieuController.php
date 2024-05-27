<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThuongHieu;

class ThuongHieuController extends Controller
{
    public function index()
    {
        $thuongHieus = ThuongHieu::all();
        return response()->json($thuongHieus);
    }

    public function show($id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        return response()->json($thuongHieu);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
        ]);

        $thuongHieu = ThuongHieu::create([
            'ten' => $request->ten,
        ]);

        return response()->json(['message' => 'Thương hiệu đã được thêm thành công', 'data' => $thuongHieu], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
        ]);

        $thuongHieu = ThuongHieu::findOrFail($id);
        $thuongHieu->ten = $request->ten;
        $thuongHieu->save();

        return response()->json(['message' => 'Thương hiệu đã được cập nhật thành công', 'data' => $thuongHieu], 200);
    }

    public function destroy($id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        $thuongHieu->delete();

        return response()->json(['message' => 'Thương hiệu đã được xóa thành công'], 200);
    }
}
