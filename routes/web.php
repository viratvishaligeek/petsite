<?php

use App\Http\Controllers\AdvanceModule\RoleController;
use App\Http\Controllers\AdvanceModule\TeamController;
use App\Http\Controllers\SeoPluginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blogger\BlogCategoryController;
use App\Http\Controllers\Blogger\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\OptionController;
use App\Http\Controllers\Product\OptionValueController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\VariantController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

// Auth routes
Route::prefix('admin')->as('admin.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::post('try-login', 'tryLogin')->name('try_login');
        Route::get('forgot-password', 'forgotPassword')->name('forgot_password');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::get('clear-cache', 'clearCache')->name('clear_cache');
            Route::get('logout', 'logout')->name('logout');
        });

        // team member module routes
        Route::resource('team', TeamController::class);

        // roles & permissions module routes
        Route::resource('role', RoleController::class);

        // blogging module routes
        Route::resource('blog-category', BlogCategoryController::class);
        Route::resource('blog', BlogController::class);

        // product module routes
        Route::resource('brand', BrandController::class);

        // category module routes
        Route::resource('category', CategoryController::class);

        // sub category module routes
        Route::get('product/get-subcategories/{id}', [CategoryController::class, 'getSubCategories'])->name('product.get-subcategories');
        Route::resource('options', OptionController::class);

        // option module routes
        Route::post('options/get-values', [OptionController::class, 'getOptionValues'])->name('options.get-values');
        Route::resource('option-value', OptionValueController::class);

        // sub category module routes
        Route::resource('product', ProductController::class);
        Route::get('product/get-faqs/{id}', [ProductController::class, 'getFaqs'])->name('product.get-faqs');
        Route::patch('product/update-faqs/{id}', [ProductController::class, 'updateFaqs'])->name('product.update-faqs');

        // variant module routes
        Route::resource('variant', VariantController::class);

        // setting module routes
        Route::resource('setting', SettingController::class);

        // Social media module routes
        Route::controller(SeoPluginController::class)->prefix('seo-plugin')->as('seo-plugin.')->group(function () {
            Route::get('{type}', 'index')->name('index');
            Route::get('{type}/{id}/edit', 'edit')->name('edit');
            Route::post('{type}/{id}', 'update')->name('update');
            // -------
        });
    });

    // ------------- laravel file manager
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin']], function () {
        Lfm::routes();
    });
    Route::get('admin/file-manager', function () {
        return view('filemanager');
    })->name('laravel-filemanager');
});