<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Login
     */
    public function index(Request $request)
    {
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::guard('api_admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get user info
     */
    public function getUser()
    {
        return response()->json([
            'user' => Auth::guard('api_admin')->user(),
        ]);
    }

    /**
     * Refresh token
     */
    public function refreshToken()
    {
        return $this->respondWithToken(Auth::guard('api_admin')->refresh());
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::guard('api_admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Format response token
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::guard('api_admin')->factory()->getTTL() * 60,
            'user'         => Auth::guard('api_admin')->user(),
        ]);
    }
}
