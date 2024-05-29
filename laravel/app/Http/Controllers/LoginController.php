<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check_email(Request $request): bool
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            return false; 
        }
        return true;
    }
    
    public function handleLogin(Request $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::attempt($credentials);
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu!!');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
