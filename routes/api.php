<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\BlogCatApiController;
use App\Http\Controllers\Api\ContactFormApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::controller(BlogCatApiController::class)->group(function () {
        Route::get('/blog-category', 'index');
    });
    Route::controller(BlogApiController::class)->group(function () {
        Route::get('blogs', 'index');
        Route::get('blog/{slug}', 'blogDetail');
        Route::get('category/{id}', 'categoryBlog');
    });
    Route::controller(ContactFormApiController::class)->group(function () {
        Route::post('form-submit', 'formSubmit');
    });
    Route::controller(ProductApiController::class)->group(function () {
        Route::get('featured-products', 'featuredProducts');
        Route::get('top-products', 'topProducts');
        Route::get('recent-products', 'recentProducts');
        Route::get('category', 'category');
        Route::get('category/{id}', 'categoryProducts');
        Route::get('search/{query}', 'search');
        Route::get('products', 'productList');
        Route::get('product/{slug}', 'productDetail');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
    });

    // after success login
    Route::middleware('auth:user')->prefix('user')->group(function () {
        // ProfileController apis
        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'apiUserProfile');
            Route::get('logout', 'logout');
        });

        // shipping address apis
        // Route::controller(ShippingController::class)->group(function () {
        //     Route::get('shipping-address', 'getShippingAddress')->name('shipping-address');
        //     Route::get('store-shipping-address', 'saveShippingAddress')->name('store-shipping-address');
        // });

        // // AuthController apis
        // Route::controller(AuthController::class)->group(function () {
        //     Route::post('logout', 'logout')->name('logout');
        //     Route::post('logout-all', 'logoutAllDevices')->name('logout-all');
        // });
    });
});