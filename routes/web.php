<?php

use Illuminate\Support\Facades\Route;

// WEB
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Admin\ContactController;

use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\RegulationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UniqueController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\LandingController;


// API
// use App\Http\Controllers\Admin\BaseController;


// Route::get('/csrf-token', function () {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

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

// API
Route::post('/generated-location', [HomeController::class, 'GenerateLocation'])->name('location');
Route::post('/generated-location-update', [HomeController::class, 'UpdateLocation'])->name('location.update');
Route::get('/cart/get/{unique}', [HomeController::class, 'GetCartByUnique'])->name('carts.get');
Route::delete('/cart/remove/{cart_id}', [HomeController::class, 'removeCarts'])->name('cart.remove');
Route::post('/cart/add/{product_id}', [HomeController::class, 'PostCartByUnique'])->name('carts.post');
Route::post('/checkout/order/{unique_id}', [HomeController::class, 'checkoutOrder'])->name('checkout.post');
Route::get('/order/get/{unique}', [HomeController::class, 'getOrderByUnique'])->name('order.get');


// ROUTE WEB
Route::get('/', [LandingController::class,'index'])->name('landing');
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/login/store', [HomeController::class, 'loginStore'])->name('login.store');
Route::get('/register/store', [HomeController::class, 'registerStore'])->name('register.store');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::middleware(['customer'])->group(function () {
    Route::get('/detail-product/{id}', [HomeController::class, 'detailProduct'])->name('product.detail');
    Route::get('/carts', [HomeController::class, 'carts'])->name('carts');
});

//CONTACT
Route::prefix('contacts')->controller(ContactController::class)->group(function(){
    Route::get('/', 'index')->name('contacts.index');
    Route::get('/create', 'create')->name('contacts.create');
    Route::post('/store', 'store')->name('contacts.store');
    Route::get('/detail/{id}', 'show')->name('contacts.show');
});

Route::prefix('authentications')->controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->name('authentications.login');
    Route::post('/store', 'store')->name('authentications.store');
    Route::get('/logout', 'logout')->name('authentications.logout');
    Route::get('/forgot-password' , 'forgotPassword')->name('authentications.forgot-password');
    Route::get('/test-event' , 'testEvent')->name('authentications.test-event');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard' , [DashboardController::class,'index'])->name('dashboard');
    Route::post('/filter-data' , [DashboardController::class,'filterData'])->name('dashboard.filter');

    // ADMIN
    Route::prefix('admins')->controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('admins.index');
        Route::get('/create', 'create')->name('admins.create');
        Route::post('/create/store', 'store')->name('admins.store');
        Route::get('/edit/{id}', 'edit')->name('admins.edit');
        Route::put('/edit/update/{id}', 'update')->name('admins.update');
        Route::get('/detail/{id}', 'show')->name('admins.show');
        Route::delete('/delete/{id}', 'destroy')->name('admins.destroy');
    });

    // Role
    Route::prefix('roles')->controller(RoleController::class)->group(function(){
        Route::get('/', 'index')->name('roles.index');
        Route::get('/create', 'create')->name('roles.create');
        Route::post('/create/store', 'store')->name('roles.store');
        Route::get('/edit/{id}', 'edit')->name('roles.edit');
        Route::put('/edit/update/{id}', 'update')->name('roles.update');
        Route::get('/detail/{id}', 'show')->name('roles.show');
        Route::delete('/delete/{id}', 'destroy')->name('roles.destroy');
    });

    // Permission
    Route::prefix('permissions')->controller(PermissionController::class)->group(function(){
        Route::get('/', 'index')->name('permissions.index');
        Route::get('/create', 'create')->name('permissions.create');
        Route::post('/create/store', 'store')->name('permissions.store');
        Route::get('/edit/{id}', 'edit')->name('permissions.edit');
        Route::put('/edit/update/{id}', 'update')->name('permissions.update');
        Route::get('/detail/{id}', 'show')->name('permissions.show');
        Route::delete('/delete/{id}', 'destroy')->name('permissions.destroy');
    });

    // PRODUCT
    Route::prefix('products')->controller(ProductController::class)->group(function(){
        Route::get('/', 'index')->name('products.index');
        Route::get('/create', 'create')->name('products.create');
        Route::post('/create/store', 'store')->name('products.store');
        Route::get('/edit/{id}', 'edit')->name('products.edit');
        Route::put('/edit/update/{id}', 'update')->name('products.update');
        Route::get('/detail/{id}', 'show')->name('products.show');
        Route::delete('/delete/{id}', 'destroy')->name('products.destroy');
    });

    // Categories
    Route::prefix('categories')->controller(CategoriesController::class)->group(function(){
        Route::get('/', 'index')->name('categories.index');
        Route::get('/create', 'create')->name('categories.create');
        Route::post('/create/store', 'store')->name('categories.store');
        Route::get('/edit/{id}', 'edit')->name('categories.edit');
        Route::put('/edit/update/{id}', 'update')->name('categories.update');
        Route::get('/detail/{id}', 'show')->name('categories.show');
        Route::delete('/delete/{id}', 'destroy')->name('categories.destroy');
    });

    // UNIQUE
    Route::prefix('uniques')->controller(UniqueController::class)->group(function(){
        Route::get('/', 'index')->name('uniques.index');
        Route::get('/create', 'create')->name('uniques.create');
        Route::post('/create/store', 'store')->name('uniques.store');
        Route::get('/edit/{id}', 'edit')->name('uniques.edit');
        Route::put('/edit/update/{id}', 'update')->name('uniques.update');
        Route::get('/detail/{id}', 'show')->name('uniques.show');
        Route::delete('/delete/{id}', 'destroy')->name('uniques.destroy');
    });

    // Order
    Route::prefix('orders')->controller(OrderController::class)->group(function(){
        Route::get('/', 'index')->name('orders.index');
        Route::get('/create', 'create')->name('orders.create');
        Route::post('/create/store', 'store')->name('orders.store');
        Route::get('/edit/{id}', 'edit')->name('orders.edit');
        Route::put('/edit/update/{id}', 'update')->name('orders.update');
        Route::get('/detail/{id}', 'show')->name('orders.show');
        Route::delete('/delete/{id}', 'destroy')->name('orders.destroy');

        // Add Ons Route
        Route::get('/excel-export' , 'export')->name('orders.get.export');
        Route::get('/orders/export', [OrderController::class, 'export'])->name('orders.export');
        Route::get('/orders/api/order-stats', [OrderController::class, 'orderStats'])->name('orders.order-stats');
    });

    // Regulation
    Route::prefix('regulations')->controller(RegulationController::class)->group(function(){
        Route::get('/', 'index')->name('regulations.index');
        Route::put('/edit/update/{id}', 'update')->name('regulations.update');
    });

});
