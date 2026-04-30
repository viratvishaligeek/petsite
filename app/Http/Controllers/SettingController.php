<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function edit(string $page)
    {
        // $user = Auth::user();
        // $capital = ucfirst($page);
        // return view('setting.' . $page, compact('pageName'));
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            foreach ($request->except('_token') as $key => $value) {
                Setting::updateOrCreate(
                    [
                        'option' => $key,
                    ],
                    [
                        'value' => $value
                    ]
                );
            }
            Cache::forget('global_settings');
            return redirect()->back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings. ' . $e->getMessage());
        }
    }
}