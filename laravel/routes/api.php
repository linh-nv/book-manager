<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\BookController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\LendTicketController;
use App\Http\Controllers\api\PublisherController;
use App\Http\Controllers\api\TicketDetailController;
use App\Http\Controllers\api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'userProfile'])->middleware('jwt.verify');

Route::group(['middleware' => 'jwt.verify'], function() {
    Route::apiResource('author', AuthorController::class);
    Route::apiResource('book', BookController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('lend-ticket', LendTicketController::class);
    Route::apiResource('publisher', PublisherController::class);
    Route::apiResource('ticket-detail', TicketDetailController::class);
    Route::apiResource('user', UserController::class);

    Route::prefix('search')->group(function () {
        Route::post('author', [AuthorController::class, 'search']);
        Route::post('publisher', [PublisherController::class, 'search']);
        Route::post('category', [CategoryController::class, 'search']);
        Route::post('book', [BookController::class, 'search']);
        Route::post('lend-ticket', [LendTicketController::class, 'search']);
        Route::post('ticket-detail', [TicketDetailController::class, 'search']);
        Route::post('user', [UserController::class, 'search']);

    });
});
