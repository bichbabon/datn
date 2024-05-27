<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KhachHang;

class KhachHangController extends Controller
{

    public function index()
    {
        $khs = KhachHang::orderBy('created_at', 'desc')->get(['id', 'ten', 'diachi', 'sdt', 'email', 'anhdaidien', 'tinhtrang']);

        return response()->json($khs);
    }

    public function getKhachHangById($id)
    {
        $kh = KhachHang::find($id, ['id', 'ten', 'diachi', 'sdt', 'email', 'anhdaidien', 'tinhtrang']);

        return response()->json($kh);
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request to ensure 'status' is provided and it's one of the allowed values
        $request->validate([
            'tinhtrang' => 'required|in:hoatdong,vohieuhoa'
        ]);

        // Retrieve the customer by id
        $customer = KhachHang::find($id);

        // Check if the customer exists
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Update the status
        $customer->tinhtrang = $request->tinhtrang;
        $customer->save();

        // Return a success response
        return response()->json([
            'message' => 'Customer status updated successfully'
        ], 200);
    }

    public function updateAvatar(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // Limit the image size to 2MB
        ]);

        $khachHang = KhachHang::findOrFail($id);
        $file = $request->file('image');
        $filename = $file->hashName(); // Generates a unique name based on file contents

        // Store the file in the 'public/avatars' directory within Laravel's storage
        $file->storeAs('public/avatars', $filename);

        // Save only the filename in the 'anhdaidien' column
        $khachHang->anhdaidien = $filename;
        $khachHang->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar updated successfully',
            'filename' => $filename
        ]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email_or_phone', 'password');

        if (filter_var($credentials['email_or_phone'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $credentials['email_or_phone'];
            unset($credentials['email_or_phone']);
        } else {
            $credentials['phone_number'] = $credentials['email_or_phone'];
            unset($credentials['email_or_phone']);
        }

        // Lấy thông tin người dùng từ cơ sở dữ liệu với các trường cần thiết
        if (isset($credentials['email'])) {
            $customer = KhachHang::select('id')
                ->where('email', $credentials['email'])
                ->first();
        } else {
            $customer = KhachHang::select('id')
                ->where('sdt', $credentials['phone_number'])
                ->first();
        }

        if ($customer && $customer->status === 'active' && Hash::check($credentials['password'], $customer->password)) {
            Auth::loginUsingId($customer->id);
            return response()->json(['message' => 'Login successful', 'customer' => $customer], 200);
        }

        // Đăng nhập thất bại
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function updateInfo(Request $request, $id)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:khachhang,email,' . $id,
            'sdt' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
        ]);

        $khachHang = KhachHang::findOrFail($id);
        $khachHang->update($request->only(['ten', 'email', 'sdt', 'diachi']));

        return response()->json([
            'success' => true,
            'message' => 'Information updated successfully',
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $khachHang = KhachHang::findOrFail($id);

        // Check if the old password matches
        if (!Hash::check($request->old_password, $khachHang->matkhau)) {
            return response()->json([
                'success' => false,
                'message' => 'The old password does not match our records.',
            ], 401); // Unauthorized status code
        }

        // Update to the new password
        $khachHang->matkhau = Hash::make($request->password);
        $khachHang->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully',
        ]);
    }

    public function getCustomerStatistics()
    {
        $totalCustomers = KhachHang::count();
        $customersWithOrders = DonHang::distinct()->count('khachhang_id');

        return response()->json([
            'total_customers' => $totalCustomers,
            'customers_with_orders' => $customersWithOrders,
        ]);
    }
}
