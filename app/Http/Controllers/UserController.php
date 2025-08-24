<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->user)
            ->orWhere('username', $request->user)
            ->orWhere('phone', $request->user)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng!']);
        }

        if ($user->role !== '1') {
            return response()->json(['message' => 'Bạn không có quyền truy cập!']);
        }

        if ($user) {
            $token = $user->createToken('token')->plainTextToken;
            $user->tokens()->latest()->first()->update([
                'expires_at' => now()->addMinutes(60)
            ]);

            return response()->json([
                'status'  => 1,
                'message' => 'Đăng nhập thành công',
                'token'   => $token
            ]);
        }
    }

    public function checkToken()
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status'  => 0,
                'message' => 'Bạn cần đăng nhập hệ thống!'
            ]);
        }

        $token = $user->currentAccessToken();

        if ($token && $token->expires_at && $token->expires_at->isPast()) {
            // Xoá token hết hạn
            $token->delete();
            return response()->json([
                'status'  => 0,
            ]);
        }

        if ($token) {
            $token->forceFill([
                'expires_at' => now()->addMinutes(30)
            ])->save();
        }

        return response()->json([
            'status' => 1,
            'ho_ten' => $user->name,
        ]);
    }
}
