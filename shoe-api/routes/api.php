<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\MauSacController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ThuongHieuController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KhachhangController;
use App\Http\Controllers\GiohangController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatisticController;



//Danh mục
Route::get('danhmuc', [DanhMucController::class, 'index']);
Route::get('danhmuc/{id}', [DanhMucController::class, 'show']);
Route::post('danhmuc', [DanhMucController::class, 'store']);
Route::put('danhmuc/{id}', [DanhMucController::class, 'update']);
Route::delete('danhmuc/{id}', [DanhMucController::class, 'destroy']);

//Màu sắc
Route::get('mausac', [MauSacController::class, 'index']);
Route::get('mausac/{id}', [MauSacController::class, 'show']);
Route::post('mausac', [MauSacController::class, 'store']);
Route::put('mausac/{id}', [MauSacController::class, 'update']);
Route::delete('mausac/{id}', [MauSacController::class, 'destroy']);


//Size
Route::get('size', [SizeController::class, 'index']);
Route::get('size/{id}', [SizeController::class, 'show']);
Route::post('size', [SizeController::class, 'store']);
Route::put('size/{id}', [SizeController::class, 'update']);
Route::delete('size/{id}', [SizeController::class, 'destroy']);


//Thương hiệu
Route::get('thuonghieu', [ThuongHieuController::class, 'index']);
Route::get('thuonghieu/{id}', [ThuongHieuController::class, 'show']);
Route::post('thuonghieu', [ThuongHieuController::class, 'store']);
Route::put('thuonghieu/{id}', [ThuongHieuController::class, 'update']);
Route::delete('thuonghieu/{id}', [ThuongHieuController::class, 'destroy']);


//Sản phẩm
Route::get('sanpham', [SanPhamController::class, 'index']);
Route::get('tongquansanpham', [SanPhamController::class, 'getProductsByCategory']);
Route::get('related/{id}', [SanPhamController::class, 'relatedProduct']);
Route::get('sanpham/{id}', [SanPhamController::class, 'show']);
Route::post('themsanpham', [SanPhamController::class, 'store']);
Route::post('sanpham/{id}', [SanPhamController::class, 'update']);
Route::delete('sanpham/{id}', [SanPhamController::class, 'delete']);
Route::get('getsanphambycart/{id}', [SanPhamController::class, 'getProductBySanphamSizeColorId']);

//Danh gia
Route::get('danhgia', [DanhGiaController::class, 'index']);
Route::post('danhgia', [DanhGiaController::class, 'create']);
Route::get('danhgia/sanpham/{id}', [DanhGiaController::class, 'getDanhGiaTheoIdSanPham']);



//Gio hang
Route::get('giohang/{khachhang_id}', [GiohangController::class, 'index']);
Route::post('giohang', [GiohangController::class, 'addToCart']);
Route::post('updategiohang', [GiohangController::class, 'updateCart']);
Route::delete('removegiohang/{khachhang_id}/{sanpham_size_mausac_id}', [GiohangController::class, 'removeFromCart']);




//Auth
Route::post('khachhang/dangky', [AuthController::class, 'register']);
Route::post('khachhang/dangnhap', [AuthController::class, 'login']);
Route::post('khachhang/updateprofile/{id}', [AuthController::class, 'updateProfile']);
Route::post('khachhang/updatepassword/{id}', [AuthController::class, 'updatePassword']);


Route::get('admins', [AdminController::class,'getAllAdmins']);
Route::post('admin/create', [AdminController::class, 'store']);
Route::post('admin/login', [AdminController::class, 'login']);
Route::post('admin/update/{id}', [AdminController::class, 'update']);
Route::post('admin/updateavatar/{id}', [AdminController::class, 'updateAvatar']);
Route::post('admin/updatepassword/{id}', [AdminController::class, 'updatePassword']);
Route::post('admin/updatepassword2/{id}', [AdminController::class, 'updatePassword2']);
Route::post('admin/updaterole/{id}', [AdminController::class,'updateAdminRole']);
Route::post('admin/updatestatus/{id}', [AdminController::class,'updateAdminStatus']);
Route::get('admin/{id}', [AdminController::class,'getAdmin']);





//Khach hang
Route::get('khachhang', [KhachHangController::class, 'index']);
Route::get('khachhang/{id}', [KhachHangController::class, 'getKhachHangById']);
Route::post('khachhang/updatestatus/{id}', [KhachHangController::class, 'updateStatus']);
Route::post('khachhang/{id}/update-avatar', [KhachHangController::class, 'updateAvatar']);
Route::put('khachhang/{id}/update-info', [KhachHangController::class, 'updateInfo']);
Route::put('khachhang/{id}/update-password', [KhachHangController::class, 'updatePassword']);



//Don hang
Route::get('donhang/khachhang/{khachhang_id}',[DonHangController::class, "getByCustomerId"]);
Route::post('donhang',[DonHangController::class, "store"]);
Route::get('chitietdonhang/{id}', [DonHangController::class, "getOrderAndProducts"]);


Route::get('donhang/getall',[DonHangController::class, "getAllOrders"]);
Route::post('donhang/updatestatus/{id}',[DonHangController::class, "updateStatus"]);


Route::get('/', function () {
    return "API";
});




// API endpoint to fetch sales quantity and revenue by month
Route::get('/sales-statistics', function () {
    $salesData = DB::table('donhang')
        ->join('chitietdonhang', 'donhang.id', '=', 'chitietdonhang.donhang_id')
        ->join('sanpham_size_mausac', 'chitietdonhang.sanpham_size_mausac_id', '=', 'sanpham_size_mausac.id')
        ->join('sanpham', 'sanpham_size_mausac.sanpham_id', '=', 'sanpham.id')
        ->select(
            DB::raw('MONTH(donhang.created_at) AS month'),
            DB::raw('YEAR(donhang.created_at) AS year'),
            DB::raw('SUM(chitietdonhang.soluong) AS total_quantity'),
            DB::raw('SUM(chitietdonhang.soluong * sanpham.gia) AS total_revenue')
        )
        ->groupBy(DB::raw('MONTH(donhang.created_at)'), DB::raw('YEAR(donhang.created_at)'))
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

    return response()->json($salesData);
});


Route::get('getcustomerstatistics', [KhachHangController::class, 'getCustomerStatistics']);
// routes/api.php

// Route::get('product-category-statistics', 'StatisticController@productCategoryStatistics');




Route::get('/best-selling-products', function () {
    $bestSellingProducts = DB::table('chitietdonhang')
        ->join('sanpham_size_mausac', 'chitietdonhang.sanpham_size_mausac_id', '=', 'sanpham_size_mausac.id')
        ->join('sanpham', 'sanpham_size_mausac.sanpham_id', '=', 'sanpham.id')
        ->select(
            'sanpham.id',
            'sanpham.ten',
            DB::raw('SUM(chitietdonhang.soluong) AS total_quantity_sold'),
            DB::raw('SUM(chitietdonhang.soluong * sanpham.gia) AS total_revenue')
        )
        ->groupBy('sanpham.id', 'sanpham.ten')
        ->orderBy('total_quantity_sold', 'desc')
        ->take(10) // Lấy 10 sản phẩm bán chạy nhất
        ->get();

    return response()->json($bestSellingProducts);
});


// API endpoint to fetch worst-selling products
Route::get('/worst-selling-products', function () {
    $worstSellingProducts = DB::table('sanpham')
        ->leftJoin('sanpham_size_mausac', 'sanpham.id', '=', 'sanpham_size_mausac.sanpham_id')
        ->leftJoin('chitietdonhang', 'sanpham_size_mausac.id', '=', 'chitietdonhang.sanpham_size_mausac_id')
        ->select(
            'sanpham.id',
            'sanpham.ten',
            DB::raw('IFNULL(SUM(chitietdonhang.soluong), 0) AS total_quantity_sold'),
            DB::raw('IFNULL(SUM(chitietdonhang.soluong * sanpham.gia), 0) AS total_revenue')
        )
        ->groupBy('sanpham.id', 'sanpham.ten')
        ->orderBy('total_quantity_sold', 'asc')
        ->take(10) // Lấy 10 sản phẩm bán ế nhất
        ->get();

    return response()->json($worstSellingProducts);
});


Route::get('/best-selling-products-month', function () {
    $bestSellingProducts = DB::table('chitietdonhang')
        ->join('sanpham_size_mausac', 'chitietdonhang.sanpham_size_mausac_id', '=', 'sanpham_size_mausac.id')
        ->join('sanpham', 'sanpham_size_mausac.sanpham_id', '=', 'sanpham.id')
        ->join('donhang', 'chitietdonhang.donhang_id', '=', 'donhang.id')
        ->select(
            'sanpham.id',
            DB::raw('SUM(chitietdonhang.soluong) AS total_quantity_sold'),
            DB::raw('SUM(chitietdonhang.soluong * sanpham.gia) AS total_revenue')
        )
        ->whereRaw('MONTH(donhang.created_at) = MONTH(CURRENT_DATE()) AND YEAR(donhang.created_at) = YEAR(CURRENT_DATE())')
        ->groupBy('sanpham.id')
        ->orderBy('total_quantity_sold', 'desc')
        ->take(10) // Lấy 10 sản phẩm bán chạy nhất trong tháng
        ->get();

    return response()->json($bestSellingProducts);
});

Route::get('/worst-selling-products-month', function () {
    $worstSellingProducts = DB::table('sanpham')
        ->leftJoin('sanpham_size_mausac', 'sanpham.id', '=', 'sanpham_size_mausac.sanpham_id')
        ->leftJoin('chitietdonhang', 'sanpham_size_mausac.id', '=', 'chitietdonhang.sanpham_size_mausac_id')
        ->leftJoin('donhang', 'chitietdonhang.donhang_id', '=', 'donhang.id')
        ->select(
            'sanpham.id',
            DB::raw('IFNULL(SUM(chitietdonhang.soluong), 0) AS total_quantity_sold'),
            DB::raw('IFNULL(SUM(chitietdonhang.soluong * sanpham.gia), 0) AS total_revenue')
        )
        ->whereRaw('MONTH(donhang.created_at) = MONTH(CURRENT_DATE()) AND YEAR(donhang.created_at) = YEAR(CURRENT_DATE())')
        ->groupBy('sanpham.id')
        ->orderBy('total_quantity_sold', 'asc')
        ->take(10) // Lấy 10 sản phẩm bán ế nhất trong tháng
        ->get();

    return response()->json($worstSellingProducts);
});

Route::get('/best-selling-products-week', function () {
    $bestSellingProducts = DB::table('chitietdonhang')
        ->join('sanpham_size_mausac', 'chitietdonhang.sanpham_size_mausac_id', '=', 'sanpham_size_mausac.id')
        ->join('sanpham', 'sanpham_size_mausac.sanpham_id', '=', 'sanpham.id')
        ->join('donhang', 'chitietdonhang.donhang_id', '=', 'donhang.id')
        ->select(
            'sanpham.id',
            DB::raw('SUM(chitietdonhang.soluong) AS total_quantity_sold'),
            DB::raw('SUM(chitietdonhang.soluong * sanpham.gia) AS total_revenue')
        )
        ->whereBetween('donhang.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->groupBy('sanpham.id')
        ->orderBy('total_quantity_sold', 'desc')
        ->take(10) // Lấy 10 sản phẩm bán chạy nhất trong tuần
        ->get();

    return response()->json($bestSellingProducts);
});


Route::get('/worst-selling-products-week', function () {
    $worstSellingProducts = DB::table('sanpham')
        ->leftJoin('sanpham_size_mausac', 'sanpham.id', '=', 'sanpham_size_mausac.sanpham_id')
        ->leftJoin('chitietdonhang', 'sanpham_size_mausac.id', '=', 'chitietdonhang.sanpham_size_mausac_id')
        ->leftJoin('donhang', 'chitietdonhang.donhang_id', '=', 'donhang.id')
        ->select(
            'sanpham.id',
            DB::raw('IFNULL(SUM(chitietdonhang.soluong), 0) AS total_quantity_sold'),
            DB::raw('IFNULL(SUM(chitietdonhang.soluong * sanpham.gia), 0) AS total_revenue')
        )
        ->whereBetween('donhang.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->groupBy('sanpham.id')
        ->orderBy('total_quantity_sold', 'asc')
        ->take(10) // Lấy 10 sản phẩm bán ế nhất trong tuần
        ->get();

    return response()->json($worstSellingProducts);
});




Route::get('/revenue-statistics', function () {
    // Tính ngày đầu tiên của tuần hiện tại
    $startOfWeek = Carbon::now()->startOfWeek()->toDateString();

    // Tạo mảng chứa kết quả thống kê
    $revenueStatistics = [];

    // Lặp qua 5 tuần gần nhất
    for ($i = 0; $i < 5; $i++) {
        // Tính ngày bắt đầu và kết thúc của tuần
        $startDate = Carbon::parse($startOfWeek)->subWeeks($i)->startOfWeek()->toDateString();
        $endDate = Carbon::parse($startOfWeek)->subWeeks($i)->endOfWeek()->toDateString();

        // Truy vấn cơ sở dữ liệu để tính tổng doanh thu trong tuần
        $weeklyRevenue = DB::table('donhang')
            ->join('chitietdonhang', 'donhang.id', '=', 'chitietdonhang.donhang_id')
            ->whereBetween('donhang.created_at', [$startDate, $endDate])
            ->sum(DB::raw('chitietdonhang.soluong * chitietdonhang.gia'));

        // Thêm kết quả vào mảng thống kê
        $revenueStatistics[] = [
            'week_start' => $startDate,
            'week_end' => $endDate,
            'total_revenue' => $weeklyRevenue,
        ];
    }

    return response()->json($revenueStatistics);
});