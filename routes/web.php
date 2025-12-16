<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [UserController::class,'home'])->name('index');
Route::get('/product_details/{id}', [UserController::class,'productDetails'])->name('product_details');
Route::get('/allproducts', [UserController::class,'allProducts'])->name('viewallproducts');

// Auth Routes (Login Required)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // This is the key: Dashboard route points to index, which redirects users to shop
    Route::get('/dashboard', [UserController::class,'index'])->name('dashboard');

    // Shopping
    Route::get('/addtocart/{id}', [UserController::class,'addToCart'])->name('add_to_cart');
    Route::get('/cart', [UserController::class,'cart'])->name('cart');
    Route::get('/cart/remove/{id}', [UserController::class,'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [UserController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [UserController::class, 'placeOrder'])->name('place.order');

    // Profile (Standard Breeze/Jetstream routes)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->group(function () { // Added 'admin' middleware if you have it created, otherwise 'auth' is fine
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categorydelete');
    Route::get('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.categoryupdate');
    Route::post('/update_category/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/update_product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    Route::post('/update_product/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');
    
    Route::get('/view_orders', [AdminController::class, 'viewOrder'])->name('admin.viewOrder');
    Route::get('/complete_order/{id}', [AdminController::class, 'completeOrder'])->name('admin.complete_order');
});

require __DIR__.'/auth.php';