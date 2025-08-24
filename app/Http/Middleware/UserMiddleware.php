<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth('sanctum')->user();

        // Nếu chưa login
        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'Bạn cần đăng nhập hệ thống!'
            ], 401);
        }

        // Lấy token hiện tại
        $token = $user->currentAccessToken();

        // Nếu token hết hạn
        if ($token && $token->expires_at && $token->expires_at->isPast()) {
            $token->delete();
            return response()->json([
                'status' => 0,
                'message' => 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại!'
            ], 401);
        }

        // Kiểm tra role
        if ($user->role !== '1') {
            return response()->json([
                'status' => 0,
                'message' => 'Bạn không có quyền truy cập!'
            ], 403);
        }

        // Gia hạn token thêm 1h nếu cần
        if ($token) {
            $token->forceFill([
                'expires_at' => now()->addMinutes(60)
            ])->save();
        }

        return $next($request);
    }
}
