<?php

use App\Http\Controllers\Api\Consumer\ClientController;
use App\Http\Controllers\Api\Consumer\RepositoryController;
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

Route::middleware('auth:consumer-api')->group(function () {
    Route::post('client/refresh-token', [ClientController::class, 'refreshToken'])->name('consumer.client.refresh-token');
    Route::get('repositories', [RepositoryController::class, 'index'])->name('consumer.repositories.index');
    Route::get('repositories/{repository}', [RepositoryController::class, 'show'])->name('consumer.repositories.show');
    Route::get('repositories/{repository}/download', [RepositoryController::class, 'download'])->name('consumer.repositories.download');
});

Route::fallback(function () {
    return jsonResponse();
});
