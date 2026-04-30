<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $key = 'register:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json([
                'status' => false,
                'message' => 'Too many attempts. Try again later.'
            ], 429);
        }
        RateLimiter::hit($key, 60);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'country_code' => 'required|string|max:5',
            'phone' => ['required', 'string', 'regex:/^[0-9]{7,15}$/', 'unique:users,phone'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $validated = $validator->validated();
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $validated['name'],
                'email' => strtolower($validated['email']),
                'country_code' => $validated['country_code'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'status' => 'active'
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Registration successful',
                'access_token' => $token,
                'user' => $user->makeHidden(['password', 'remember_token'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $key = 'login:' . $request->ip() . ':' . $request->email;
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json([
                'status' => false,
                'message' => 'Too many login attempts. Try again in ' . RateLimiter::availableIn($key) . ' seconds.'
            ], 429);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            RateLimiter::hit($key, 60);
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            RateLimiter::hit($key, 60);
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'status' => false,
                'message' => 'Your account is inactive. Please contact support.'
            ], 403);
        }
        RateLimiter::clear($key);
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->makeHidden(['password', 'remember_token']);
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }
}