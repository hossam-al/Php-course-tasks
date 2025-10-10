<?php

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\API\AuthCotroler;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\WishlistController;


Route::get('/montgat', [ProductsController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix("products")->group(function () {

        // get All data
        Route::get('/', [ProductsController::class, 'index']);

        // Add data
        Route::post('/', [ProductsController::class, 'store']);
        // show data
        Route::get('/{id}', [ProductsController::class, 'show']);
        //  update data
        Route::post('/{id}', [ProductsController::class, 'update']);
        // by Slug
        Route::get('/slug/{slug}', [ProductsController::class, 'showBySlug']);
        // delete data
        Route::delete('/{id}', [ProductsController::class, 'destroy']);
    });
    Route::prefix('Category')->group(function () {
        // get All data
        Route::get('/', [CategoryController::class, 'index']);

        // Add data
        Route::post('/', [CategoryController::class, 'store']);
        // show data
        Route::get('/{id}', [CategoryController::class, 'show']);
        // by Slug
        Route::get('/slug/{slug}', [CategoryController::class, 'showBySlug']);
        //  update data
        Route::post('/{id}', [CategoryController::class, 'update']);

        // delete data
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('brands')->group(function () {
        // get All data
        Route::get('/', [BrandController::class, 'index']);

        // Add data
        Route::post('/', [BrandController::class, 'store']);
        // show data
        Route::get('{id}', [BrandController::class, 'show']);

        //  update data
        Route::post('/{id}', [BrandController::class, 'update']);

        // delete data
        Route::delete('/{id}', [BrandController::class, 'destroy']);
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::post('/{order}', [OrderController::class, 'update']);
        Route::delete('/{order}', [OrderController::class, 'destroy']);

        Route::get('/{order}/items', [OrderItemController::class, 'index']);
        Route::post('/{order}/items', [OrderItemController::class, 'store']);
        Route::get('/{order}/items/{orderItem}', [OrderItemController::class, 'show']);
        Route::post('/{order}/items/{orderItem}', [OrderItemController::class, 'update']);
        Route::delete('/{order}/items/{orderItem}', [OrderItemController::class, 'destroy']);
    });
    Route::prefix('ProductImage')->group(function () {
        // get All data
        Route::get('/', [ProductImageController::class, 'index']);

        // Add data
        Route::post('/', [ProductImageController::class, 'store']);
        // show data
        Route::get('{id}', [ProductImageController::class, 'show']);

        //  update data
        Route::post('/{id}', [ProductImageController::class, 'update']);

        // delete data
        Route::delete('/{id}', [ProductImageController::class, 'destroy']);
    });

    Route::prefix('reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index']);
        Route::post('/', [ReviewController::class, 'store']);
        Route::get('/{review}', [ReviewController::class, 'show']);
        Route::post('/{review}', [ReviewController::class, 'update']);
        Route::delete('/{review}', [ReviewController::class, 'destroy']);
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/', [CartController::class, 'store']);
        Route::get('/{cart}', [CartController::class, 'show']);
        Route::post('/{cart}', [CartController::class, 'update']);
        Route::delete('/{cart}', [CartController::class, 'destroy']);

        Route::get('/{cart}/items', [CartItemController::class, 'index']);
        Route::post('/{cart}/items', [CartItemController::class, 'store']);
        Route::get('/{cart}/items/{cartItem}', [CartItemController::class, 'show']);
        Route::post('/{cart}/items/{cartItem}', [CartItemController::class, 'update']);
        Route::delete('/{cart}/items/{cartItem}', [CartItemController::class, 'destroy']);
    });

    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index']);
        Route::post('/', [WishlistController::class, 'store']);
        Route::get('/{wishlist}', [WishlistController::class, 'show']);
        Route::post('/{wishlist}', [WishlistController::class, 'update']);
        Route::delete('/{wishlist}', [WishlistController::class, 'destroy']);
    });

    Route::post('Logout', [AuthCotroler::class, 'Logout']);
    Route::delete('delete', [AuthCotroler::class, 'DeleteUser']);
});



Route::post('regiser/', [AuthCotroler::class, 'register']);
Route::post('Login/', [AuthCotroler::class, 'Login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
