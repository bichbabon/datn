<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ChiTietDonHang;
use App\Models\SanPhamSizeMauSac;
use DB;

class DonHangController extends Controller
{

    public function getAllOrders()
    {
        try {
            $orders = DonHang::with('khachhang')->orderByDesc('created_at')->get();
            return response()->json($orders);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi lấy dữ liệu đơn hàng', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateStatus($id,Request $request)
{
    try {
        // Tìm đơn hàng dựa trên ID
        $order = DonHang::findOrFail($id);

        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order) {
            throw new \Exception('Không tìm thấy đơn hàng');
        }

        // Lấy trạng thái mới từ yêu cầu
        $newStatus = request('tinhtrang');

        // Lưu trạng thái hiện tại của đơn hàng
        $currentStatus = $order->tinhtrang;

        // Cập nhật trạng thái mới cho đơn hàng
        $order->tinhtrang = $newStatus;
        $order->save();

        if ($newStatus === 'danggiaohang' && $currentStatus !== 'danggiaohang') {
            $orderDetails = ChiTietDonHang::where('donhang_id', $id)->get();
            foreach ($orderDetails as $detail) {
                $productSizeColor = SanPhamSizeMauSac::findOrFail($detail->sanpham_size_mausac_id);
                $productSizeColor->soluong -= $detail->soluong;
                $productSizeColor->save();
            }
        }

        if (($newStatus === 'trahang' || $newStatus === 'huy') && $currentStatus === 'danggiaohang') {
            $orderDetails = ChiTietDonHang::where('donhang_id', $id)->get();
            foreach ($orderDetails as $detail) {
                $productSizeColor = SanPhamSizeMauSac::findOrFail($detail->sanpham_size_mausac_id);
                $productSizeColor->soluong += $detail->soluong;
                $productSizeColor->save();
            }
        }

        return response()->json(['message' => 'Cập nhật trạng thái đơn hàng thành công'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
    }
}


    public function getByCustomerId($khachhangId)
    {
        $orders = DonHang::where('khachhang_id', $khachhangId)->orderByDesc('created_at')->get();
        return response()->json($orders);
    }


    public function store(Request $request)
{
    DB::beginTransaction();
    try {
        // Lấy danh sách sản phẩm trong giỏ hàng của khách hàng
        $giohangItems = GioHang::where('khachhang_id', $request->khachhang_id)->get();

        // Kiểm tra số lượng sản phẩm trong kho
        foreach ($giohangItems as $item) {
            $sanphamSizeMauSac = $item->sanphamSizeMauSac; // Lấy thông tin sản phẩm kèm size và màu sắc
            if ($sanphamSizeMauSac->soluong < $item->soluong) {
                // Nếu số lượng trong kho ít hơn số lượng trong giỏ hàng, trả về lỗi
                return response()->json(['message' => 'Số lượng sản phẩm không đủ cho mặt hàng: ' . $sanphamSizeMauSac->sanpham->ten], 400);
            }
        }

        // Tạo đơn hàng mới
        $donhang = new DonHang();
        $donhang->khachhang_id = $request->khachhang_id;
        $donhang->ten = $request->ten; // Thay đổi theo dữ liệu thực
        $donhang->diachi = $request->diachi;
        $donhang->sdt = $request->sdt;
        $donhang->pttt = $request->pttt;
        $donhang->save();

        foreach ($giohangItems as $item) {
            $sanpham = $item->sanphamSizeMauSac->sanpham; // Lấy sản phẩm từ relationship
            $giaSale = $sanpham->gia - ($sanpham->gia * $sanpham->giamgia / 100);

            // Tạo chi tiết đơn hàng
            $chiTietDonHang = new ChiTietDonHang();
            $chiTietDonHang->donhang_id = $donhang->id;
            $chiTietDonHang->sanpham_size_mausac_id = $item->sanpham_size_mausac_id;
            $chiTietDonHang->gia = $giaSale;
            $chiTietDonHang->soluong = $item->soluong;
            $chiTietDonHang->save();

            // Cập nhật lại số lượng sản phẩm trong kho
            $sanphamSizeMauSac->soluong -= $item->soluong;
            $sanphamSizeMauSac->save();
        }

        // Xóa giỏ hàng (tùy chọn)
        GioHang::where('khachhang_id', $request->khachhang_id)->delete();

        DB::commit();
        return response()->json([
            'message' => 'Đơn hàng đã được tạo thành công',
            'id' => $donhang->id
        ], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình tạo đơn hàng', 'error' => $e->getMessage()], 500);
    }
}




public function getOrderAndProducts($orderId)
{
    try {
        // Lấy thông tin đơn hàng
        $order = DB::table('donhang')
            ->where('id', $orderId)
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Đơn hàng không tồn tại'], 404);
        }

        // Lấy thông tin chi tiết đơn hàng với giá và số lượng
        $orderDetails = DB::table('chitietdonhang')
            ->join('sanpham_size_mausac', 'chitietdonhang.sanpham_size_mausac_id', '=', 'sanpham_size_mausac.id')
            ->where('chitietdonhang.donhang_id', $orderId)
            ->select('sanpham_size_mausac.*', 'chitietdonhang.gia', 'chitietdonhang.soluong', 'sanpham_size_mausac.sanpham_id')
            ->get();

        // Lấy thông tin sản phẩm từ danh sách product_ids
        $products = [];
        foreach ($orderDetails as $detail) {
            $product = SanPham::with(['danhmuc', 'thuonghieu', 'anhsanpham'])
                ->find($detail->sanpham_id);

            if ($product) {
                // Thêm giá và số lượng vào thông tin sản phẩm
                $product->gia_ban = $detail->gia;
                $product->soluong = $detail->soluong;
                $products[] = $product;
            }
        }

        return response()->json([
            'order' => $order,
            'products' => $products
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Lỗi khi lấy dữ liệu', 'error' => $e->getMessage()], 500);
    }
}








}
