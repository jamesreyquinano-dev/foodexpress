<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('landing');
});

// Guest Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Shopping Cart Public Access
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'viewCheckout'])->name('checkout');
Route::post('/place-order', [CartController::class, 'placeOrder'])->name('order.process');

// Logout Route
Route::get('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/login');
})->name('logout');



Route::middleware(['auth'])->group(function () {
    
    
    // Dashboard View Security Gate
    Route::get('/dashboard', function() {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }
        return app(Dashboardcontroller::class)->showDashboard();
    })->name('dashboard');  

    // User Management List View Security Gate
    Route::get('/user', function() {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }
        return app(UserController::class)->showUser();
    })->name('user');

    // User Management CRUD Operations
    Route::post('/user/update/{id}', [UserController::class, 'updateUser'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');


    Route::get('/profile', function () {
        return view('profile'); 
    })->name('profile');
    
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});