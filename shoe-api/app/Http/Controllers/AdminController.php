<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'tendangnhap' => 'required|string',
            'matkhau' => 'required|string'
        ]);

        // Find the admin by username
        $admin = Admin::where('tendangnhap', $request->tendangnhap)->first();

        // Check if admin exists and password is correct
        if ($admin && Hash::check($request->matkhau, $admin->matkhau)) {
            // Return a successful login response
            return response()->json(['message' => 'Đăng nhập thành công!', 'admin' => $admin->makeHidden(['matkhau'])], 200);
        }

        // If authentication fails, return an error response
        return response()->json(['message' => 'Sai tài khoản hoặc mật khẩu'], 401);
    }
    public function getAllAdmins()
    {
        $admins = Admin::all('id', 'tendangnhap', 'anhdaidien', 'tinhtrang', 'chucvu');
        return response()->json($admins);
    }

    public function getAdmin($id)
    {
        // Find the admin by ID
        $admin = Admin::find($id);

        // Check if admin was found
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        // Return the found admin, excluding sensitive data
        return response()->json($admin->makeHidden(['password']));
    }

    public function updateAvatar(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // Limit the image size to 2MB
        ]);

        $admin = Admin::findOrFail($id);
        $file = $request->file('image');
        $filename = $file->hashName(); // Generates a unique name based on file contents

        // Store the file in the 'public/avatars' directory within Laravel's storage
        $file->storeAs('public/avatars', $filename);

        // Save only the filename in the 'anhdaidien' column
        $admin->anhdaidien = $filename;
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Avatar updated successfully',
        ]);
    }

    public function updatePassword2(Request $request, $id)
    {

        $admin = Admin::findOrFail($id);

        // Check if the old password matches
        if (!Hash::check($request->old_password, $admin->matkhau)) {
            return response()->json([
                'success' => false,
                'message' => 'The old password does not match our records.',
            ], 401); // Unauthorized status code
        }

        // Update to the new password
        $admin->matkhau = Hash::make($request->password);
        $admin->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully',
        ]);
    }



    public function store(Request $request)
    {
        // Validate the incoming request
        // $request->validate([
        //     'tendangnhap' => 'required|string|max:100|unique:admin,tendangnhap',
        //     'matkhau' => 'required|string|min:6|max:100',
        //     'anhdaidien' => 'nullable|string|max:100',
        //     'tinhtrang' => 'required|in:active,blocked',
        //     'chucvu' => 'required|in:admin,manager,staff'
        // ]);

        // Create a new admin instance
        $admin = new Admin;
        $admin->tendangnhap = $request->tendangnhap;
        $admin->matkhau = Hash::make($request->matkhau); // Hash the password for security
        $image = $request->file('anhdaidien');
        $originalName = $image->getClientOriginalName();
        $filename = pathinfo($originalName, PATHINFO_FILENAME); // Lấy tên tệp không bao gồm phần mở rộng
        $extension = $image->getClientOriginalExtension(); // Lấy phần mở rộng tệp
        $filenameToStore = $filename . '_' . time() . '.' . $extension; // Thêm timestamp để đảm bảo tên tệp duy nhất

        // Lưu tệp vào thư mục storage/app/public/uploads
        $path = $image->storeAs('public/avatars', $filenameToStore);

        // Lưu chỉ tên tệp vào cơ sở dữ liệu
        $admin->anhdaidien = $filenameToStore;
        $admin->tinhtrang = $request->tinhtrang;
        $admin->chucvu = $request->chucvu;
        $admin->save(); // Save the admin to the database

        // Return a response indicating success
        return response()->json([
            'message' => 'Admin created successfully'
        ], 201);
    }
    // Method to update the role of an admin
    public function updateAdminRole(Request $request, $id)
    {
        $request->validate([
            'chucvu' => 'required|in:nhanvien,quanly,admin',
        ]);

        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->chucvu = $request->chucvu;
        $admin->save();

        return response()->json([
            'message' => 'Admin role updated successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'tendangnhap' => 'sometimes|required|string|max:100' . $id,
            'anhdaidien' => 'nullable|string|max:100',
            'tinhtrang' => 'required|in:hoatdong,vohieuhoa',
            'chucvu' => 'required|in:admin,quanly,nhanvien'
        ]);

        // Find the admin by ID
        $admin = Admin::findOrFail($id);

        // Update admin details
        if ($request->has('tendangnhap')) {
            $admin->tendangnhap = $request->tendangnhap;
        }
        // if ($request->has('password')) {
        //     $admin->password = Hash::make($request->password);
        // }
        // if ($request->has('anhdaidien')) {
        //     $admin->image_url = $request->image_url;
        // }
        $admin->tinhtrang = $request->tinhtrang;
        $admin->chucvu = $request->chucvu;

        // Save the changes
        $admin->save();

        // Return a response
        return response()->json([
            'message' => 'Admin updated successfully'
        ]);
    }
    public function updatePassword($id, Request $request)
    {
        // Validate the incoming request
        try {
            $admin = Admin::findOrFail($id);

            // Update the password
            $admin->matkhau = Hash::make($request->matkhau);

            // Save the changes
            $admin->save();

            // Return a response
            return response()->json([
                'message' => 'Password updated successfully',
            ]);
        } catch (e) {
            return response(
                ["message" => "Lỗi", 400]
            );
        }
    }

    // Method to update the status of an admin
    public function updateAdminStatus(Request $request, $id)
    {
        $request->validate([
            'tinhtrang' => 'required|in:hoatdong,vohieuhoa',
        ]);

        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->tinhtrang = $request->tinhtrang;
        $admin->save();

        return response()->json([
            'message' => 'Admin status updated successfully'
        ]);
    }
}
