<?php

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
