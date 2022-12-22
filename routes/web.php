<?php

use App\Http\Controllers\app\CoffeeController;
use App\Http\Controllers\app\HomeController;
use App\Http\Controllers\app\ImprintController;
use App\Http\Controllers\app\OpenSourceController;
use App\Http\Controllers\app\PasswordGeneratorController;
use App\Http\Controllers\app\PrivacyController;
use App\Http\Controllers\app\StringFormatterController;
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

Route::domain('coffee.'.basename(config('app.url')))->group(function () {
    Route::get('{wildcard?}', function () {
        return redirect()->route('coffee');
    });
});

Route::domain(basename(config('app.url')))->group(function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::name('legal.')->group(function () {
        Route::get('imprint', [ImprintController::class, 'index'])
            ->name('imprint');
        Route::get('privacy', [PrivacyController::class, 'index'])
            ->name('privacy');
    });

    Route::get('open-source', [OpenSourceController::class, 'index'])
        ->name('open-source');
    Route::get('nova-packages', function () {
        return redirect(route('open-source').'?tag=laravel-nova');
    });

    Route::get('coffee', [CoffeeController::class, 'index'])->name('coffee');

    Route::name('tools.')->group(function () {
        Route::get('password-generator', [PasswordGeneratorController::class, 'index'])
            ->name('password-generator');
        Route::get('string-formatter', [StringFormatterController::class, 'index'])
            ->name('string-formatter');
        Route::post('string-formatter', [StringFormatterController::class, 'index'])
            ->name('string-formatter.format');
    });
});

