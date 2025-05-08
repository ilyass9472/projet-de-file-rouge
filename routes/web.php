<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SignalementController;
use App\Http\Controllers\Admin\AdminController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/generate-exposant-public', [AuthController::class, 'generateExposantPublic']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('users', UserController::class);
    
    Route::patch('users/{id}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
});
Route::resource('signalements', SignalementController::class);

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');