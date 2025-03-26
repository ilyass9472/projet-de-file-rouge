<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RsaController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/home', [App\Http\Controllers\RsaController::class, 'run'])->name('home');
Route::get('/Houme', [App\Http\Controllers\RsaController::class, 'run'])->name('home');


Route::prefix('rsa')->group(function () {
    Route::get('/run', [RsaController::class, 'run']);
    Route::post('/encrypt', [RsaController::class, 'encrypt']);
    Route::post('/decrypt', [RsaController::class, 'decrypt']);
});




Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/validate', [AuthController::class, 'validateToken']);
});





Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});