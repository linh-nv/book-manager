@extends('app')

@section('app')
<div class="auth w-screen h-screen">
    <main class="form-login">
        <header class="form-top">
            <h1 class="text-5xl font-semibold">Login to Account</h1>
            <span class="note">Please enter your email and password to continue</span>
        </header>
        <section class="notification">
            @if(session('error'))
                <div class="bg-red-400 py-6 text-white rounded-lg">
                    <span class="px-10">
                        {{ session('error') }}
                    </span>
                </div>
            @endif
        </section>
        <form action="{{route('handle_login')}}" method="post">
            @csrf
            <div class="form-mid">
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input id="email" name="email" type="email" placeholder="esteban_schiller@gmail.com" required>
                </div>
                <div class="form-group">
                    <div class="password-note">
                        <label for="password">Password:</label>
                        <a href="" class="hover:text-blue-600">Forget Password?</a>
                    </div>
                    <input id="password" name="password" type="password" required>
                    <div class="remember-password">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember Password</label>
                    </div>
                </div>
            </div>
            <div class="form-bottom mt-6">
                <button type="submit" class="login-btn hover:bg-blue-400 transition-colors duration-300">Sign In</button>
                <div class="create-account">
                    <span>Don’t have an account?</span>
                    <a href="{{route('create')}}">Create Account</a>
                </div>
            </div>
        </form>
    </main>
</div>

@endsection