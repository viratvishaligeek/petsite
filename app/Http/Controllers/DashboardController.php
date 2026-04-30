<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return View
     */
    public function dashboard()
    {
        $pageName = 'Dashboard';

        return view('dashboard', compact('pageName'));
    }

    public function clearCache()
    {
        try {
            Artisan::call('config:cache');
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('optimize:clear');

            return back()->with('success', 'Cache cleared successfully!');
        } catch (\Exception $e) {
            Log::error('Cache clear error: ' . $e->getMessage());

            return back()->with('error', 'Failed to clear cache. Please try again : ' . $e->getMessage());
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
}