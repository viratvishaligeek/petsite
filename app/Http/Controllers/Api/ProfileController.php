<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Get the authenticated user's profile details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiUserProfile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => 200,
            'message' => 'Profile retrieved successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'country_code' => $user->country_code,
                'status' => $user->status,
                'created_at' => $user->created_at,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            $request->user()->token()->revoke();

            return response()->json([
                'status' => 200,
                'message' => 'Logged out successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong during logout'
            ], 500);
        }
    }
}