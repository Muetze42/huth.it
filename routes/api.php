<?php

use App\Http\Controllers\Api\Customer\AuthController;
use App\Http\Controllers\Api\Customer\RepositoryController;
use App\Http\Controllers\Api\GitHubWebhookController;
use Illuminate\Support\Facades\Route;

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

Route::post('webhooks/github/{webhook}/{slug}', [GitHubWebhookController::class, 'index'])->name('webhooks.github');

Route::middleware('auth:customer-api')->group(function () {
    Route::get('/test', function () {
        return auth()->user();
    });
    Route::post('refresh-token', [AuthController::class, 'requestToken'])->name('customer.refresh-token');
    Route::get('customer/repo/{package}', [RepositoryController::class, 'info'])->name('customer.repo.info');
    Route::get('customer/repo/{package}/download', [RepositoryController::class, 'download'])->name('customer.repo.download');
});

Route::fallback(function () {
    return jsonResponse();
});
