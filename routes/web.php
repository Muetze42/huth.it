<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImprintController;
use App\Http\Controllers\PasswordGeneratorController;
use App\Http\Controllers\StringFormatterController;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;

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

/**
 * Public Inertia Routes
 */
Route::middleware([HandleInertiaRequests::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/imprint', [ImprintController::class, 'index'])->name('imprint.index');
    Route::get('/password-generator', [PasswordGeneratorController::class, 'index'])->name('password-generator.index');
    Route::get('/string-formatter', [StringFormatterController::class, 'index'])->name('string-formatter.index');
    Route::post('/string-formatter', [StringFormatterController::class, 'index'])->name('string-formatter.format');
});

$providers = 'github';
Route::get('auth/{provider}', [AuthController::class, 'redirect'])->name('auth')->where('provider', $providers);
Route::get('auth/{provider}/callback', [AuthController::class, 'callback'])->where('provider', $providers);
