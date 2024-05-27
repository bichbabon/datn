<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email-sdt' => 'required|string',
                'matkhau' => 'required|string',
            ]);

            // Determine if 'email-sdt' is an email or a phone number
            $fieldType = filter_var($request->input('email-sdt'), FILTER_VALIDATE_EMAIL) ? 'email' : 'sdt';

            // Manually query the database using the identified field
            $user = DB::table('khachhang')
                ->where($fieldType, $request->input('email-sdt'))
                ->first();

            // Check if user was found and the password is correct
            if ($user && Hash::check($request->matkhau, $user->matkhau)) {
                // Manually handle user session or token generation, if not using Laravel's built-in Auth
                // $request->session()->put('user_id', $user->id); // Example session handling
                // $request->session()->regenerate();

                return response()->json([
                    'message' => 'Đăng nhập thành công',
                    'id' => $user->id
                ]);
            }
            return response()->json(['message' => 'Đăng nhập thất bại!'], 400);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'lỗi server',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            // Custom error messages
            $messages = [
                'email.unique' => 'Địa chỉ email đã tồn tại',
                'sdt.unique' => 'Số điện thoại đã tồn tại',
            ];

            // Validate incoming request data
            $validated = $request->validate([
                'ten' => 'required|string|max:100',
                'diachi' => 'required|string|max:255',
                'sdt' => 'required|string|max:20|unique:khachhang,sdt',
                'email' => 'required|string|email|max:100|unique:khachhang,email',
                'matkhau' => 'required|string|min:6',
            ], $messages);

            // Create the customer record
            KhachHang::create([
                'ten' => $validated['ten'],
                'diachi' => $validated['diachi'],
                'sdt' => $validated['sdt'],
                'email' => $validated['email'],
                'matkhau' => Hash::make($validated['matkhau']),
            ]);

            return response()->json([
                'message' => 'Registration successful'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while registering',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function updateProfile(Request $request, $id)
    {
        try {
            // Validate incoming request data
            $validated = $request->validate([
                'ten' => 'sometimes|string|max:100',
                'diachi' => 'sometimes|string|max:255',
                'sdt' => 'sometimes|string|max:20|unique:khachhang,sdt,' . $id,
                'email' => 'sometimes|string|email|max:100|unique:khachhang,email,' . $id,
            ]);

            // Retrieve the customer by ID
            $khachhang = KhachHang::findOrFail($id);

            // Update the customer
            $khachhang->update($validated);

            return response()->json([
                'message' => 'Cập nhật thông tin thành công',
                'khachhang' => $khachhang
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server error while updating',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePassword(Request $request, $id)
    {
        try{
            $validated = $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|string|min:6',
            ]);


    
            $khachhang = KhachHang::findOrFail($id);
    
            // Check if the old password is correct
            if (!Hash::check($validated['old_password'], $khachhang->matkhau)) { // Ensure to check against the hashed password in the database
                return response()->json(['message' => 'The provided old password is incorrect'], 400);
            }
    
            // Update the password
            $khachhang->matkhau = Hash::make($validated['new_password']); // Use the new password from validated data
            $khachhang->save();
    
            return response()->json(['message' => 'Password updated successfully']);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }



}
