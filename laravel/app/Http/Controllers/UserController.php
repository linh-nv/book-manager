<?php

namespace App\Http\Controllers;

use App\Enum\RoleStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): bool
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
                'role_id' => RoleStatus::MANAGER->value,
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
