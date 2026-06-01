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


// Authenticated Session Group
Route::middleware(['auth'])->group(function () {
    
    // Dashboard View Security Gate (Fixed using Email validation)
    Route::get('/dashboard', function() {
        if (Auth::user()->email !== 'jamesreyquinano@gmail.com') {
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }
        return app(DashboardController::class)->showDashboard();
    })->name('dashboard');  

    // User Management List View Security Gate (Fixed using Email validation)
    Route::get('/user', function() {
        if (Auth::user()->email !== 'jamesreyquinano@gmail.com') {
            return redirect('/')->with('error', 'Access Denied! Admins only.');
        }
        return app(UserController::class)->showUser();
    })->name('user');

    // User Management CRUD Operations (Protected via Admin Email validation)
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


    // Profile Management Access
    Route::get('/profile', function () {
        return view('profile'); 
    })->name('profile');
    
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});