<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin data seeder
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone' => '8888888888',
            'password' => 'qwerty',
        ]);

        // setting data seeder
        Setting::create([
            'option' => 'project_name',
            'value' => 'Magnus',
        ]);
    }
}