<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Livewire\Admin\Category;
use App\Livewire\Admin\Dashboard;
use App\Livewire\CategoryManager;
use App\Livewire\CkeditorTest;
use App\Livewire\Customer;
use App\Livewire\HomePage;
use App\Livewire\ManageProfile;
use App\Livewire\ManageUser;
use App\Livewire\ProductDetails;
use App\Livewire\ProductManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', HomePage::class)->name('client.home');
Route::get('/product/{slug}', ProductDetails::class)->name('product.details');

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

Route::post('/place-order', function () {
    // Save to DB or trigger payment
    session()->forget('cart');

    return redirect('/')->with('success', 'Order placed successfully!');
})->name('place.order')->middleware('auth');



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

});
//logout
Route::post('/logout', [Dashboard::class, 'logout'])->name('logout');


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
