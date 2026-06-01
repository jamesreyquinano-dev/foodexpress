<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; // Capitalized C
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


// Authenticated Session Group - Users must be logged in
Route::middleware(['auth'])->group(function () {
    
    // 🔒 STRICT SECURITY GATE FOR DASHBOARD (Only your email is allowed)
    Route::get('/dashboard', function() {
        if (Auth::user()->email !== 'jamesreyquinano@gmail.com') {
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }
        return app(DashboardController::class)->showDashboard();
    })->name('dashboard');  

    // 🔒 STRICT SECURITY GATE FOR USER MANAGEMENT (Only your email is allowed)
    Route::get('/user', function() {
        if (Auth::user()->email !== 'jamesreyquinano@gmail.com') {
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }
        return app(UserController::class)->showUser();
    })->name('user');

    // 🔒 CRUD Operation Protection
    Route::post('/user/update/{id}', function($id) {
        if (Auth::user()->email !== 'jamesreyquinano@gmail.com') {
            return redirect('/')->with('error', 'Access Denied!');
        }
        return app(UserController::class)->updateUser(request(), $id);
    })->name('user.update');

    Route::get('/user/delete/{id}', function($id) {
        if (Auth::user()->email !== 'jamesreyquinano@gmail.com') {
            return redirect('/')->with('error', 'Access Denied!');
        }
        return app(UserController::class)->deleteUser($id);
    })->name('user.delete');


    // Regular Customer Profile Access (Every logged-in user can access this)
    Route::get('/profile', function () {
        return view('profile'); 
    })->name('profile');
    
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});