<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'home'])->name('products.home');

// Route hiển thị sản phẩm
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route hiển thị form tạo sản phẩm mới
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route lưu trữ sản phẩm mới được tạo
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route hiển thị thông tin chi tiết về một sản phẩm
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Route hiển thị form chỉnh sửa thông tin sản phẩm
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Route cập nhật thông tin sản phẩm đã chỉnh sửa
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Route xóa một sản phẩm
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

//Route hiện thông tin chi tiết
Route::get('/product/{id}/detail', [ProductController::class, 'detail'])->name('products.detail');

// Route tìm kiếm sản phẩm theo tiêu đề
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

// Route hiển thị sản phẩm danh mục
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Route hiển thị form tạo danh mục mới
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

// Route lưu trữ danh mục mới được tạo
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

// Route hiển thị thông tin chi tiết về một danh mục
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Route hiển thị form chỉnh sửa thông tin danh mục
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// Route cập nhật thông tin danh mục đã chỉnh sửa
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

// Route xóa một danh mục
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Lấy tất cả các tag
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

// Hiển thị form tạo mới tag
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');

// Lưu tag mới được tạo
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

// Hiển thị thông tin chi tiết của một tag cụ thể
Route::get('/tags/{id}', [TagController::class, 'show'])->name('tags.show');

// Hiển thị form chỉnh sửa tag
Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');

// Cập nhật thông tin của tag đã chỉnh sửa
Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update');

// Xóa tag
Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');
// hiển thị cart
Route::get('/shopping-cart', [ProductController::class, 'Cart'])->name('shopping.cart');
//thêm sản phẩm vào cart
Route::get('/products/{id}/add_to_cart', [ProductController::class, 'addToCart'])->name('add.to.cart');
//cập nhật cart
Route::post('/update-shopping-cart', [ProductController::class, 'updateCart'])->name('update.sopping.cart');
//xóa sản phẩm trong cart
Route::delete('/products/{id}/delete_cart', [ProductController::class, 'deleteCart'])->name('delete.cart');
//Thanh toán VNPAY
Route::post('/vnpay_payment',[PaymentController::class, 'vnpay_payment']);
