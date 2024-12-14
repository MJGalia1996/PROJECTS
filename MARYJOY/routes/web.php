<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AnalyticsController;

// Redirect the root URL to the signup page
Route::get('/', function () {
    return redirect()->route('signup');
});

// Registration routes
Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('signup');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Login routes
Route::get('/login', function () {
    return view('login');
})->name('login.form');  // Name it differently from the POST route
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');  // Keep this for the action

// Dashboard route (protected with auth middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/welcome', function () {
    return view('welcome');  // Ensure you have a 'welcome.blade.php' in the 'resources/views' folder
})->name('welcome');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/', [AnalyticsController::class, 'showFilters']);




Route::get('/dashboard', [AnalyticsController::class, 'index']);

// Logout route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/filter-by-year/{year}', [AnalyticsController::class, 'filterByYear']);
