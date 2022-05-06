<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImprintController;
use App\Http\Controllers\NovaPackagesController;
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
    Route::get('/nova-packages', [NovaPackagesController::class, 'index'])->name('nova-packages.index');
});

$providers = 'github';
Route::get('auth/{provider}', [AuthController::class, 'redirect'])->name('auth')->where('provider', $providers);
Route::get('auth/{provider}/callback', [AuthController::class, 'callback'])->where('provider', $providers);

//Route::get('/a', function () {
//    return array_flip([
//        'toRfc7231String' => now()->toRfc7231String(),
//        'toRfc2822String' => now()->toRfc2822String(),
//        'toRfc1123String' => now()->toRfc1123String(),
//        'toRfc1036String' => now()->toRfc1036String(),
//        'toRfc850String' => now()->toRfc850String(),
//        'toRfc822String' => now()->toRfc822String(),
//        'toIso8601String' => now()->toIso8601String(),
//        'toIso8601ZuluString' => now()->toIso8601ZuluString(),
//        'toRfc3339String' => now()->toRfc3339String(),
//        'toW3cString' => now()->toW3cString(),
//        'toString' => now()->toString(),
//        'toRssString' => now()->toRssString(),
//        'toCookieString' => now()->toCookieString(),
//        'toAtomString' => now()->toAtomString(),
//    ]);
//});
