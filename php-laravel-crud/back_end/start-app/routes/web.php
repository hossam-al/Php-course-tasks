<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});





Route::prefix('employees')->name('employee.')->group(function () {
    Route::get("/", [EmployeeController::class, 'index'])->name('index');
    Route::get("/create", [EmployeeController::class, 'create'])->name('create');
    Route::post("/create", [EmployeeController::class, 'store'])->name('store');
    Route::get("/show/{id}", [EmployeeController::class, 'show'])->name('show');
    Route::get("/edit/{id}", [EmployeeController::class, 'edit'])->name('edit');
    Route::get("/delete/{id}", [EmployeeController::class, 'destroy'])->name('destroy');
    Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');

    });



Route::prefix('department')->name('department.')->group(function () {
    Route::get("/", [DepartmentController::class, 'index'])->name('index');
    Route::get("/create", [DepartmentController::class, 'create'])->name('create');
    route::post("/create",[DepartmentController::class, 'store'])->name('store');
    Route::get("/show/{id}", [DepartmentController::class, 'show'])->name('show');
    Route::get("/edit/{id}", [DepartmentController::class, 'edit'])->name('edit');
    Route::get("/delete/{id}", [DepartmentController::class, 'destroy'])->name('destroy');
    Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('update');



});
