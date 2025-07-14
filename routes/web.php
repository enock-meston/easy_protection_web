<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FlutterPaymentController;
use App\Livewire\Admin\Category;
use App\Livewire\Admin\ClientOrders;
use App\Livewire\Admin\Dashboard;
use App\Livewire\CategoryManager;
use App\Livewire\CkeditorTest;
use App\Livewire\Customer;
use App\Livewire\HomePage;
use App\Livewire\ManageProfile;
use App\Livewire\ManageUser;
use App\Livewire\ProductDetails;
use App\Livewire\ProductManager;
use App\Livewire\ClientProfile;
use App\Livewire\MyOrders;
use App\Livewire\NavigationMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\CategoryProducts;

// Route::view('/', 'welcome');

// Client Routes
Route::get('/', HomePage::class)->name('client.home');
Route::get('/product/{slug}', ProductDetails::class)->name('product.details');
Route::get('/orders', MyOrders::class)->name('client.orders')->middleware('auth');

// Client Profile Route (Protected)
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/profile', ClientProfile::class)->name('client.profile');
});

// Navigation Menu Component
Route::get('/navigation', NavigationMenu::class)->name('navigation');

// cart
Route::post('/add-to-cart', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart-count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart-items', [CartController::class, 'items']);
Route::delete('/clear-cart', [CartController::class, 'clear']);

Route::get('/buy', [BuyController::class, 'index'])->middleware('auth');
Route::get('/check-auth', function () {
    return response()->json([
        'loggedIn' => Auth::check(),
    ]);
});


Route::post('/place-order',[FlutterPaymentController::class,'pay'])->name('place.order')->middleware('auth');
Route::get('/payment-callback',[FlutterPaymentController::class,'callback'])->name('payment.callback')->middleware('auth');

Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/dashboard/category', CategoryManager::class)->name('admin.category');
    //product manager
    Route::get('/dashboard/product', ProductManager::class)->name('admin.product');
    //customers
    Route::get('/dashboard/customers', Customer::class)->name('admin.customers');
    //admin.users
    Route::get('/dashboard/users', ManageUser::class)->name('admin.users');
    //user profile management
    Route::get('/dashboard/profile', ManageProfile::class)->name('admin.profile');

    //client orders
    Route::get('/dashboard/client-orders', ClientOrders::class)->name('admin.client-orders');

});
//logout
Route::post('/logout', [Dashboard::class, 'logout'])->name('logout');

Route::get('/category/{id}', CategoryProducts::class)->name('category.products');


require __DIR__ . '/auth.php';
