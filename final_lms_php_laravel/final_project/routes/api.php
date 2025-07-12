<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\API\Authcontroller;
use App\Http\Controllers\InsructorsController;
use App\Http\Controllers\DepartmentsController;

Route::post('regiser', [Authcontroller::class, 'regiser']);
Route::post('login', [Authcontroller::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'store']);
        Route::post('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
    Route::prefix('deoartments')->group(function () {
        Route::get('/', [DepartmentsController::class, 'index']);
        Route::get('/{id}', [DepartmentsController::class, 'show']);
        Route::post('/', [DepartmentsController::class, 'store']);
        Route::post('/{id}', [DepartmentsController::class, 'update']);
        Route::delete('/{id}', [DepartmentsController::class, 'destroy']);
    });
    Route::prefix('rounds')->group(function () {
        Route::get('/', [RoundController::class, 'index']);
        Route::get('/{id}', [RoundController::class, 'show']);
        Route::post('/', [RoundController::class, 'store']);
        Route::post('/{id}', [RoundController::class, 'update']);
        Route::delete('/{id}', [RoundController::class, 'destroy']);
    });
    Route::prefix('groups')->group(function () {
        Route::get('/', [GroupController::class, 'index']);
        Route::get('/{id}', [GroupController::class, 'show']);
        Route::post('/', [GroupController::class, 'store']);
        Route::post('/{id}', [GroupController::class, 'update']);
        Route::delete('/{id}', [GroupController::class, 'destroy']);
    });
    Route::post('logout', [Authcontroller::class, 'logout']);

    Route::prefix('student')->name("student.")->group(function () {

        Route::get('/', [StudentController::class, 'index']);
        Route::get('/{id}', [StudentController::class, 'show']);
        Route::post('/', [StudentController::class, 'store']);
        Route::post('/{id}', [StudentController::class, 'update']);
        Route::delete('/{id}', [StudentController::class, 'destroy']);
    });
    Route::prefix('instructors')->name("instructor.")->group(function () {
        Route::get('/', [InsructorsController::class, 'index']);
        Route::get('/{id}', [InsructorsController::class, 'show']);
        Route::post('/', [InsructorsController::class, 'store']);
        Route::post('/{id}', [InsructorsController::class, 'update']);
        Route::delete('/{id}', [InsructorsController::class, 'destroy']);
    });
    Route::prefix('admins')->name("admin.")->group(function () {

       Route::get('/', [AdminsController::class, 'index']);
        Route::get('/{id}', [AdminsController::class, 'show']);
        Route::post('/', [AdminsController::class, 'store']);
        Route::post('/{id}', [AdminsController::class, 'update']);
        Route::delete('/{id}', [AdminsController::class, 'destroy']);
        });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
