<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return response()->json($sizes);
    }

    public function show($id)
    {
        $size = Size::findOrFail($id);
        return response()->json($size);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:50',
        ]);

        $size = Size::create([
            'ten' => $request->ten,
        ]);

        return response()->json(['message' => 'Size đã được thêm thành công', 'data' => $size], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:50',
        ]);

        $size = Size::findOrFail($id);
        $size->ten = $request->ten;
        $size->save();

        return response()->json(['message' => 'Size đã được cập nhật thành công', 'data' => $size], 200);
    }

    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return response()->json(['message' => 'Size đã được xóa thành công'], 200);
    }
}
