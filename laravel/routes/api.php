<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LendTicketController;
use App\Http\Controllers\Api\PublisherController;
use App\Http\Controllers\Api\TicketDetailController;
use App\Http\Controllers\Api\UserController;
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
    Route::get('book/all', [BookController::class, 'getAllCategoriesAuthorsPublishers']);
    Route::apiResource('book', BookController::class);
    Route::post('book/{id}', [BookController::class, 'update']);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('lend-ticket', LendTicketController::class);
    Route::apiResource('publisher', PublisherController::class);
    Route::apiResource('ticket-detail', TicketDetailController::class);
    Route::get('ticket-detail/lend-ticket/{id}', [TicketDetailController::class, 'showLendTicket']);
    Route::apiResource('user', UserController::class);
});