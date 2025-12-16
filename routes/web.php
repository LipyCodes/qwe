<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Usercontroller as ControllersUsercontroller;

Route::get('/', [UserController::class,'home'])->name('index');
Route::get('/product_details/{id}', [UserController::class,'productDetails'])->name('product_details');
Route::get('/allproducts', [UserController::class,'allProducts'])->name('viewallproducts');
Route::get('/cart', [UserController::class,'cart'])->middleware(['auth', 'verified'])->name('cart');
Route::get('/cart/remove/{id}', [UserController::class,'removeFromCart'])->middleware(['auth', 'verified'])->name('cart.remove');
Route::get('/checkout', [Usercontroller::class, 'checkout'])->middleware(['auth', 'verified'])->name('checkout');

Route::get('/dashboard',[UserController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/addtocart/{id}',[UserController::class,'addToCart'])->middleware(['auth', 'verified'])->name('add_to_cart');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
Route::middleware('admin')->group(function () {
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
    Route::post('/add_product/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');



});

require __DIR__.'/auth.php';
