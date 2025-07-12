<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\error403;
use App\Http\Controllers\InsructorsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');




Route::get('error403', [error403::class, 'error403'])->name('error403');
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'AdminRule')->group(function () {



    Route::prefix('admins')->name("admin.")->group(function () {

        Route::get('/', [AdminsController::class, 'index'])->name('index');
        Route::get('/create', [AdminsController::class, 'create'])->name('create');
        Route::get('/show{id}', [AdminsController::class, 'show'])->name('show');
        Route::get('/edit{id}', [AdminsController::class, 'edit'])->name('edit');
        Route::post('/store', [AdminsController::class, 'store'])->name('store');
        Route::post('/update{id}', [AdminsController::class, 'update'])->name('update');
        Route::get('/destroy{id}', [AdminsController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('auth', 'instructorsrule')->group(function () {

    Route::prefix('instructors')->name("instructor.")->group(function () {

        Route::get('/', [InsructorsController::class, 'index'])->name('index');
        Route::get('/create', [InsructorsController::class, 'create'])->name('create');
        Route::get('/show{id}', [InsructorsController::class, 'show'])->name('show');
        Route::get('/edit{id}', [InsructorsController::class, 'edit'])->name('edit');
        Route::post('/store', [InsructorsController::class, 'store'])->name('store');
        Route::post('/update{id}', [InsructorsController::class, 'update'])->name('update');
        Route::get('/destroy{id}', [InsructorsController::class, 'destroy'])->name('destroy');
    });
});
Route::middleware('auth', 'studentsrule')->group(function () {

    Route::prefix('student')->name("student.")->group(function () {

        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::get('/show{id}', [StudentController::class, 'show'])->name('show');
        Route::get('/edit{id}', [StudentController::class, 'edit'])->name('edit');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::post('/update{id}', [StudentController::class, 'update'])->name('update');
        Route::get('/destroy{id}', [StudentController::class, 'destroy'])->name('destroy');
    });
});







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post("change_image/{id}", [ProfileController::class, 'change_image'])->name('profile.change_image');
});


require __DIR__ . '/auth.php';
