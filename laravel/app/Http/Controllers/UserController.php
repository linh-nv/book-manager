<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailNotify;
use App\Jobs\SendEmailVerify;
use App\Models\TokensVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('auth.login');
    }

    public function home(): View
    {
        $user = Auth::user();
        return view('pages.home', compact('user'));
    }

    public function handle_login(Request $request): RedirectResponse
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function check_email(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            return false; 
        }
        return true;
    }

    public function store(Request $request)
    {
        if ($request->filled(['name', 'email', 'password', 'tel'])) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'role_id' => 2, // khi tạo mặc định sẽ là role manager
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return true;
        }
        return false; 
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
