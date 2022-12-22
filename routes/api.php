<?php

use Illuminate\Support\Facades\Route;
use NormanHuth\HelpersLaravel\App\Http\Middleware\SanctumOrGuest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return [
        'message' => 'It work’s!',
        'authenticated' => auth()->check(),
        'time' => now(),
    ];
});
Route::middleware(SanctumOrGuest::class)->group(function () {
    //
});
