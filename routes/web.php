<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordGeneratorController;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\PageMeta;
use Illuminate\Support\Facades\Route;
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

Route::middleware([PageMeta::class, HandleInertiaRequests::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('contact', ContactController::class, ['names' => 'contact'])->only(['index', 'store']);

    Route::name('password-generator.')->prefix('password-generator')->group(function () {
        Route::get('/', [PasswordGeneratorController::class, 'index'])->name('index');
        Route::post('/hash', [PasswordGeneratorController::class, 'hash'])->name('hash');
    });
});
Route::post('/link/{link}', [HomeController::class, 'count']);

Route::middleware('auth')->group(function () {
    Route::get('auth/google', [AuthController::class, 'googleRedirect'])->name('auth.google');
    Route::get('auth/google/callback', [AuthController::class, 'googleCallback'])->name('auth.google.callback');
});

Route::get('auth/{provider}', [AuthController::class, 'redirect'])->name('auth');
Route::get('auth/{provider}/callback', [AuthController::class, 'callback']);

if (config('app.env') === 'local' && request()->getClientIp() === request()->ip()) {
    Route::resource('/test', \App\Http\Controllers\DevelopmentController::class);
}
