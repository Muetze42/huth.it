<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Coffee Subdomain Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the Coffee Subdomain. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('coffee.page');
});
