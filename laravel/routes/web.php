<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Jobs\SendEmailNotify;
use App\Jobs\SendEmailVerify;
use App\Models\TokensVerify;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Enum\LendTicket;
use App\Enum\LendTicketStatus;
use App\Enum\RoleStatus;
use App\Enum\TicketDetailStatus;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowBookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LendTicketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublisherController;
use App\Http\Middleware\Authenticate;
use App\Util\Constains;
use App\Util\Constants;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('/', UserController::class);
Route::resource('/role', RoleController::class);

Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::resource('/author', AuthorController::class);
    Route::resource('/publisher', PublisherController::class);
    Route::resource('/book', BookController::class);
    Route::resource('/lend_ticket', LendTicketController::class);

});
Route::post('/check-email', [LoginController::class, 'check_email'])->name('check_email');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/handle_login', [LoginController::class, 'handleLogin'])->name('handle_login');

// Route::get('/confirm_email_verification/{token}', [UserController::class, 'confirm_email_verification'])->name('confirm_email_verification');

Route::get('/test', function(){
    return Constains::PER_PAGE;
});
