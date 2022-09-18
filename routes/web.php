<?php

use App\Http\Controllers\app\HomeController;
use App\Http\Controllers\app\ImprintController;
use App\Http\Controllers\app\NovaPackagesController;
use App\Http\Controllers\app\PasswordGeneratorController;
use App\Http\Controllers\app\PrivacyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group and the HandleInertiaRequests middleware.
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::name('legal.')->group(function () {
    Route::get('/imprint', [ImprintController::class, 'index'])
        ->name('imprint');
    Route::get('/privacy', [PrivacyController::class, 'index'])
        ->name('privacy');
});

Route::name('stuff.')->group(function () {
    Route::get('/nova-packages', [NovaPackagesController::class, 'index'])
        ->name('nova-packages');
});

Route::name('tools.')->group(function () {
    Route::get('/password-generator', [PasswordGeneratorController::class, 'index'])
        ->name('password-generator');
    Route::get('/string-formatter', [PasswordGeneratorController::class, 'index'])
        ->name('string-formatter');
});
