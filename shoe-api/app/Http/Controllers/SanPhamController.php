<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SanPham;
use App\Models\AnhSanPham;
use App\Models\SanPhamSizeMauSac;
use App\Models\SanPhamDanhMuc;
use App\Models\DanhMuc;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $page = $request->input('page', 1);
    if ($page == "") {
        $page = 1;
    }
    $limit = min($request->input('limit', 16), 100);

    $name = $request->input('name');
    $priceMin = $request->input('price_min');
    $priceMax = $request->input('price_max');
    $brandId = $request->input('thuonghieu');
    $danhmuc = $request->input('danhmuc');
    $sortByPrice = $request->input('sort_price');
    $sortByRating = $request->input('sort_rating', 'desc'); // Default to sort by highest ratings

    $query = SanPham::with('danhmuc', 'thuonghieu', 'anhsanpham')
        ->withCount('danhgia as total_reviews') 
        ->withAvg('danhgia as average_rating', 'tyle');
    
    $query->orderBy("created_at", 'desc');

    if ($name) {
        $query->where('ten', 'like', '%' . $name . '%');
    }

    if (!is_null($priceMin)) {
        $query->where('gia', '>=', $priceMin);
    }

    if (!is_null($priceMax)) {
        $query->where('gia', '<=', $priceMax);
    }

    if ($brandId) {
        $query->where('thuonghieu_id', $brandId);
    }

    if ($danhmuc) {
        $query->whereHas('danhmuc', function($q) use ($danhmuc) {
            $q->where('danhmuc_id', $danhmuc);
        });
    }

    // Sorting by price if specified
    if ($sortByPrice === 'desc') {
        $query->orderBy('gia', 'desc');
    } elseif ($sortByPrice === 'asc') {
        $query->orderBy('gia', 'asc');
    }

    // Sorting by rating
    if ($sortByRating === 'desc') {
        $query->orderBy('average_rating', 'desc');
    } elseif ($sortByRating === 'asc') {
        $query->orderBy('average_rating', 'asc');
    }
    
    $products = $query->paginate($limit, ['*'], 'page', $page);

    return response()->json($products);
}

public function getProductsByCategory()
{
    // Get all categories
    $categories = DanhMuc::all();

    // Initialize an empty collection to store all products
    $allProducts = collect();

    foreach ($categories as $category) {
        // Fetch up to 10 products for each category
        $products = $category->sanphams()
                             ->with('danhmuc', 'thuonghieu', 'anhsanpham')
                             ->withCount('danhgia as total_reviews')
                             ->withAvg('danhgia as average_rating', 'tyle')
                             ->orderBy('created_at', 'desc')
                             ->limit(10)
                             ->get();

        // Merge the products into the allProducts collection
        $allProducts = $allProducts->merge($products);
    }

    // Return the combined products as a JSON response
    return response()->json($allProducts);
}




    function getProductBySanphamSizeColorId($id)
    {
        $productId = SanPhamSizeMauSac::where('id', $id)->first()->sanpham_id;
        $product = SanPham::with('danhmuc', 'thuonghieu', 'anhsanpham')
            ->where('id', $productId)->firstOrFail();
        return response()->json($product);
    }



    public function relatedProduct($id)
    {
        // First, find the current product along with its categories and brand
        $product = SanPham::with('danhmuc', 'thuonghieu')->findOrFail($id);

        // Extract category IDs and brand ID
        $categoryIds = $product->danhmuc->pluck('id');
        $brandId = $product->thuonghieu_id;

        // Fetch products that share the same category or brand, excluding the current product
        $relatedProducts = SanPham::with('danhmuc', 'thuonghieu', 'anhsanpham')
            ->where('id', '!=', $id)
            ->where(function ($query) use ($categoryIds, $brandId) {
                $query->whereIn('thuonghieu_id', [$brandId])
                    ->orWhereHas('danhmuc', function ($q) use ($categoryIds) {
                        $q->whereIn('danhmuc_id', $categoryIds);
                    });
            })
            ->inRandomOrder() // Order by random
            ->limit(16) // Limit to 10 products
            ->get();

        // Return the related products as JSON
        return response()->json($relatedProducts);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // var_dump($request->all());
        // $validatedData = $request->validate([
        //     'ten' => 'required|string|max:255',
        //     'danhmuc.*' => 'required|array',
        //     'gia' => 'required|numeric',
        //     'thuonghieu' => 'required|string|max:255',
        //     'gioithieu' => 'required|string',
        //     'sanxuat' => 'required|string|max:50',
        //     'docao' => 'required|numeric|min:0',
        //     'giamgia' => 'required|numeric|min:0',
        //     'mota' => 'required|string',
        //     'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'mausac.*' => 'required|integer',
        //     'size.*' => 'required|integer',
        //     'soluong.*' => 'required|integer|min:1',
        // ]);

        // Lưu thông tin sản phẩm vào bảng `sanpham`
        $sanpham = new SanPham();
        $sanpham->ten = $request['ten'];
        $sanpham->gia = $request['gia'];
        // Thêm logic để lấy ID của thương hiệu dựa trên tên
        // Thêm logic để lấy ID của danh mục dựa trên ID đã chọn
        $sanpham->gioithieu = $request['gioithieu'];
        $sanpham->sanxuat = $request['sanxuat'];
        $sanpham->thuonghieu_id = $request['thuonghieu_id'];
        $sanpham->docao = $request['docao'];
        $sanpham->mota = $request['mota'];
        $sanpham->giamgia = $request['giamgia'];
        $sanpham->save();

        // Lấy danh sách danh mục từ request
        $danhmucIds = $request['danhmuc'];

        // Lặp qua danh sách danh mục và thêm vào bảng sanpham_danhmuc
        foreach ($danhmucIds as $danhmucId) {
            // Thêm vào bảng sanpham_danhmuc
            SanPhamDanhMuc::create([
                'sanpham_id' => $sanpham->id,
                'danhmuc_id' => $danhmucId
            ]);
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $filename = pathinfo($originalName, PATHINFO_FILENAME); // Lấy tên tệp không bao gồm phần mở rộng
                $extension = $image->getClientOriginalExtension(); // Lấy phần mở rộng tệp
                $filenameToStore = $filename . '_' . time() . '.' . $extension; // Thêm timestamp để đảm bảo tên tệp duy nhất

                // Lưu tệp vào thư mục storage/app/public/uploads
                $path = $image->storeAs('public/uploads', $filenameToStore);

                // Lưu chỉ tên tệp vào cơ sở dữ liệu
                $sanpham->anhsanpham()->create(['anhminhhoa' => $filenameToStore]);
            }
        }

        // Lưu chi tiết sản phẩm (kích thước, màu sắc, số lượng) vào bảng `sanpham_size_mausac`
        for ($i = 0; $i < count($request['mausac']); $i++) {
            $sanPhamSizeMauSac = new SanPhamSizeMauSac();
            $sanPhamSizeMauSac->sanpham_id = $sanpham->id;
            $sanPhamSizeMauSac->mausac_id = $request['mausac'][$i];
            $sanPhamSizeMauSac->size_id = $request['size'][$i];
            $sanPhamSizeMauSac->soluong = $request['soluong'][$i];
            $sanPhamSizeMauSac->save();
        }

        // Trả về thông báo thành công
        return response()->json('Sản phẩm đã được thêm thành công', 200);
    }

    public function show($id)
    {
        // Lấy sản phẩm theo ID kèm theo thông tin kích thước, màu sắc và số lượng
        $product = SanPham::with('danhmuc', 'thuonghieu', 'anhsanpham', 'sanphamsizemausac')->find($id);

        // Trả về dữ liệu dưới dạng JSON
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ten' => 'required|string|max:255',
            'danhmuc' => 'required|array',
            'gia' => 'required|numeric',
            'thuonghieu_id' => 'required|numeric',
            'gioithieu' => 'required|string',
            'sanxuat' => 'required|string|max:50',
            'docao' => 'required|numeric|min:0',
            'giamgia' => 'required|numeric|min:0',
            'mota' => 'required|string',
            'oldImages.*' => 'sometimes|string',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mausac.*' => 'required|integer',
            'size.*' => 'required|integer',
            'soluong.*' => 'required|integer|min:1',
        ]);

        $sanpham = SanPham::findOrFail($id);
        $sanpham->update($validatedData);
        $sanpham->anhsanpham()->delete();

        // Lưu hình ảnh cũ
        $oldImages = $request->input('oldImages');
        if (!empty($oldImages)) {
            foreach ($oldImages as $oldImage) {
                $sanpham->anhsanpham()->create(['anhminhhoa' => $oldImage]);
            }
        }

        // Attach or detach danh mục
        $sanpham->danhmuc()->sync($validatedData['danhmuc']);

        // Handle new images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $filename = pathinfo($originalName, PATHINFO_FILENAME); // Lấy tên tệp không bao gồm phần mở rộng
                $extension = $image->getClientOriginalExtension(); // Lấy phần mở rộng tệp
                $filenameToStore = $filename . '_' . time() . '.' . $extension; // Thêm timestamp để đảm bảo tên tệp duy nhất

                // Lưu tệp vào thư mục storage/app/public/uploads
                $path = $image->storeAs('public/uploads', $filenameToStore);

                // Lưu chỉ tên tệp vào cơ sở dữ liệu
                $sanpham->anhsanpham()->create(['anhminhhoa' => $filenameToStore]);
            }
        }

        // Update size, color, and quantity details
        SanPhamSizeMauSac::where('sanpham_id', $id)->delete(); // Optional: clear old data
        foreach ($validatedData['mausac'] as $index => $mausac_id) {
            $sanpham->sanphamsizemausac()->create([
                'mausac_id' => $mausac_id,
                'size_id' => $validatedData['size'][$index],
                'soluong' => $validatedData['soluong'][$index],
            ]);
        }

        return response()->json(['message' => 'Product updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $product = SanPham::find($id);

            if ($product) {
                $product->delete();
                return response()->json(['message' => 'Product deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'Product not found'], 404);
            }
        } catch (\Throwable $err) {
            return response()->json(['message' => 'Failed to add product: ' . $err->getMessage()], 500);
        }
    }
}
