<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MauSac;

class MauSacController extends Controller
{
    public function index()
    {
        $mauSac = MauSac::all();
        return response()->json($mauSac);
    }

    public function show($id)
    {
        $mauSac = MauSac::findOrFail($id);
        return response()->json($mauSac);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
        ]);

        $mauSac = new MauSac();
        $mauSac->ten = $request->ten;
        $mauSac->save();

        return response()->json(['message' => 'Màu sắc đã được thêm thành công'], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
        ]);

        $mauSac = MauSac::findOrFail($id);
        $mauSac->ten = $request->ten;
        $mauSac->save();

        return response()->json(['message' => 'Màu sắc đã được cập nhật thành công'], 200);
    }

    public function destroy($id)
    {
        $mauSac = MauSac::findOrFail($id);
        $mauSac->delete();

        return response()->json(['message' => 'Màu sắc đã được xóa thành công'], 200);
    }
}
