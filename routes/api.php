<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\auth\LoginRegisterController;
use App\Http\Middleware\UserTokenIsValid;
use App\Http\Controllers\FavoriteController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});


Route::post('/login', [LoginRegisterController::class, 'login'])->name('login');// Login
Route::post('/register', [LoginRegisterController::class, 'Register'])->name('Register');// Register

Route::post('/logout/{id}', [LoginRegisterController::class, 'logout'])->name('logout'); // Logout

// resend otp
Route::post('/resendOtp', [LoginRegisterController::class, 'resendOtp'])->name('resendOtp'); // Resend OTP



// Route::middleware([UserTokenIsValid::class])->group(function () {
//     Route::get('/alluser', [UserController::class, 'userData'])->name('user.index'); // Display all users
// });



Route::post('/verifyOtp', [LoginRegisterController::class, 'verifyOtp'])->name('verifyOtp'); // Token

Route::post('/forgotPassword', [LoginRegisterController::class, 'forgotPassword'])->name('forgotPassword'); // Forgot Password






// User routes
Route::prefix('user')->group(function () {
    Route::post('/register', [LoginRegisterController::class, 'Register'])->name('Register');
    Route::get('/alluser', [UserController::class, 'userData'])->name('user.index'); // Display all users
    Route::get('/{id}', [UserController::class, 'showUserById'])->name('user.showUserById'); // Display user by their id
    Route::post('/create', [UserController::class, 'store'])->name('user.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Remove the specified resource from storage


    // otp routes





});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/alladmin', [AdminController::class, 'adminData'])->name('admin.index'); // Display all admins
    Route::get('/{id}', [AdminController::class, 'showAdminById'])->name('admin.showAdminById'); // Display admin by their id
    Route::post('/create', [AdminController::class, 'store'])->name('admin.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Remove the specified resource from storage
});

// Category routes
Route::prefix('category')->group(function () {
    Route::get('/allcategory', [CategoryController::class, 'categoryData'])->name('category.index'); // Display all categories
    Route::post('/create', [CategoryController::class, 'store'])->name('category.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy'); // Remove the specified resource from storage
    Route::get('/{id}', [CategoryController::class, 'showCategoryById'])->name('category.showCategoryById'); // Display category by their id
});

// Product routes
Route::prefix('product')->group(function () {
    Route::get('/allproduct', [ProductController::class, 'productData'])->name('product.index'); // Display all products
    Route::post('/create', [ProductController::class, 'store'])->name('product.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy'); // Remove the specified resource from storage

    Route::get('/search/{name}', [ProductController::class, 'searchProductByName'])->name('product.searchProductByName'); // Display product by their name

    // after
    // Route::get('/detail/{id}', [ProductController::class, 'showProductById'])->name('product.showProductById'); // Display product by their id
    // Route::get('/{id}', [ProductController::class, 'showProductByCategoryId'])->name('product.showProductByCategoryId'); // Display productcategory by their category id


    Route::get('/{id}', [ProductController::class, 'showProductById'])->name('product.showProductById'); // Display product by their id
    Route::get('/category/{id}', [ProductController::class, 'showProductByCategoryId'])->name('product.showProductByCategoryId'); // Display product by category id
});


// Order routes
Route::prefix('order')->group(function () {
    Route::get('/allorder', [OrderController::class, 'orderData'])->name('order.index'); // Display all orders
    Route::get('/{id}', [OrderController::class, 'showOrderById'])->name('order.showOrderById'); // Display order by their id
    Route::post('/create', [OrderController::class, 'store'])->name('order.create'); // Store a newly created resource in storage


    Route::get('/user/{id}', [OrderController::class, 'showOrderByUserId'])->name('order.showOrderByUserId'); // Display order by user id
});
// e.need@gmail.com

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/allcart', [CartController::class, 'cartData'])->name('cart.index'); // Display all carts
    Route::get('/{id}', [CartController::class, 'showCartById'])->name('cart.showCartById'); // Display cart by their id
    Route::post('/create', [CartController::class, 'store'])->name('cart.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy'); // Remove the specified resource from storage


    Route::get('/user/{id}', [CartController::class, 'showCartByUserId'])->name('cart.showCartByUserId'); // Display cart by user id
    Route::get('/increaseQuantity/{userId}/{productId}', [CartController::class, 'increaseQuantity'])->name('cart.increaseQuantity'); // increase cart quantity by user id and product id
    Route::get('/decreaseQuantity/{userId}/{productId}', [CartController::class, 'decreaseQuantity'])->name('cart.decreaseQuantity'); // decrease cart quantity by user id and product id
});

// Payment routes
Route::prefix('payment')->group(function () {
    Route::get('/allpayment', [PaymentController::class, 'paymentData'])->name('payment.index'); // Display all payments
    Route::get('/{id}', [PaymentController::class, 'showPaymentById'])->name('payment.showPaymentById'); // Display payment by their id
    Route::post('/updateStatus/{id}', [PaymentController::class, 'update'])->name('payment.update'); // Update the specified resource in storage
    Route::get('/paymentByStatus/{id}/{status}', [PaymentController::class, 'showPaymentByUserId'])->name('payment.showPaymentByUserId'); // Update the specified resource in storage

});

// Review routes
Route::prefix('review')->group(function () {
    Route::get('/allreview', [ReviewController::class, 'reviewData'])->name('review.index'); // Display all reviews
    Route::get('/{id}', [ReviewController::class, 'showReviewById'])->name('review.showReviewById'); // Display review by their id
    Route::post('/create', [ReviewController::class, 'store'])->name('review.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [ReviewController::class, 'update'])->name('review.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [ReviewController::class, 'destroy'])->name('review.destroy'); // Remove the specified resource from storage
    Route::get('/user/{id}', [ReviewController::class, 'showReviewByUserId'])->name('review.showReviewByUserId'); // Display review by user id
});

// favorite routes
Route::prefix('favorite')->group(function () {
    Route::get('/user/{id}', [FavoriteController::class, 'showFavoritesByUserId'])->name('favorite.showFavoritesByUserId'); // Display favorite by user id
    Route::get('/add/{UserId}/{productId}', [FavoriteController::class, 'addProductToFavorites'])->name('favorite.addProductToFavorites'); // add product to favorite
    Route::get('/remove/{UserId}/{productId}', [FavoriteController::class, 'removeProductFromFavorites'])->name('favorite.removeProductFromFavorites'); // remove product from favorite
});



