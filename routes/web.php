<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

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
// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');
// Route::get('/aaa    ',[AuthController::class,'generateExposantPublic']);
Route::get('/dashboard', function () {
    return view('dashboard');
});
?>  