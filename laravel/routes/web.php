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
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::post('/handle_login', [UserController::class, 'handle_login'])->name('handle_login');

Route::get('/confirm_email_verification/{token}', [UserController::class, 'confirm_email_verification'])->name('confirm_email_verification');
Route::get('/test', function(){


    $users = User::cursor()->filter(function (User $user) {
        return $user->id > 500;
    });

    foreach ($users as $user) {
        echo $user->id;
    }
});
