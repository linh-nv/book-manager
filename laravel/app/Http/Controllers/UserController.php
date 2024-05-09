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
use App\Enum\LendTicket;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LendTicket::values();

    }

    public function home(){
        return view('pages.home');
    }
    public function handle_login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return redirect()->route('home');
            // return response()->json($request->password);
        }
        return redirect()->back()->with('error', 'Sai ten dang nhap hoac mat khau');
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
    public function store(Request $request)
    {
        if(!empty($request->name) && !empty($request->email) && !empty($request->password)){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at,
            ]);

            TokensVerify::create([
                'email' => $request->email,
                'token' => $request->_token,
                'expires_at' => Carbon::now()->addMinutes(30)
            ]);

            SendEmailVerify::dispatch($request->email, $request->_token);
        }
    }

    // khi người dùng ấn xác nhận ở trong email
    public function confirm_email_verification($token){
        $confirmationCode = TokensVerify::where('token', $token)->first();

        if ($confirmationCode && $confirmationCode->expires_at > Carbon::now()) {
            // khi xác minh email thành công -> cập nhật email_verified_at ở user và xóa hàng token đấy đi
            $elementToken = TokensVerify::where('token', $token)->first();

            User::where('email', $elementToken->email)->update([
                'email_verified_at' => Carbon::now(),
            ]);

            $elementToken->delete();
            return view('auth.login');
        } else {
            $elementToken = TokensVerify::where('token', $token)->delete();
            return view('auth.register');
            // echo 'het han';
        }
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
