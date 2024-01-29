<?php
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;

use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/dashboard', [AdminPanelController::class,"index"])
//    ->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::resource("dash/categories",CategoriesController::class)->middleware("auth");

Route::middleware(["auth","CheckRole:super-admin,admin"])->prefix("dashboard")->group(function (){

    Route::get("profileEdit", [ProfileController::class,"edit"])->name("dashboard.edit.profile");
    Route::patch("updateProfile", [ProfileController::class,"update"])->name("dashboard.update.profile");

    Route::get('/', [AdminPanelController::class,"index"])
        ->middleware(['verified'])->name('dashboard');

    Route::get("categories/trashed",[CategoriesController::class,"trashed"])->name("categories.trashed");
    Route::put("categories/restore/{category}",[CategoriesController::class,"restore"])->name("categories.restore");
    Route::delete("categories/force-delete/{category}",[CategoriesController::class,"forceDelete"])->name("categories.force-delete");

    Route::resource("/categories",CategoriesController::class);
    Route::resource("/products", ProductController::class);
});
