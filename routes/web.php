<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Dashboard\ProfileController;

Route::get('/', [HomeController::class,'index'])->name("home");

Route::get("products",[ProductController::class,"index"])->name("front.products.index");
Route::get("products/{product:slug}",[ProductController::class,"show"])->name("front.products.show");



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource("cart",CartController::class);

Route::get("checkout",[CheckoutController::class,"create"])->name("checkout.create");
Route::post("checkout",[CheckoutController::class,"store"])->name("checkout.store");

require __DIR__.'/Dashboard.php';
require __DIR__.'/auth.php';
