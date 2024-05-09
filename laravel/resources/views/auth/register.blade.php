@extends('app')

@section('app')
<div class="auth w-screen h-full p-20">
    <main class="form-login">
        <header class="form-top">
            <h1 class="text-5xl font-semibold">Sign Up</h1>
            <span class="note">welcome</span>
        </header>
        @if(session('error'))
            <section class="notification">
                <div class="bg-red-400 py-6 text-white rounded-lg">
                    <span class="px-10">
                        {{ session('error') }}
                    </span>
                </div>
            </section>
        @endif
        <form action="{{route('store')}}" method="POST" id="form-register">
            <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-mid">
                <div id="layout-name-email">
                    <div class="form-box">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" placeholder="Nguyen Van A" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input id="email" name="email" type="email" placeholder="VD: linh@gmail.com" required>
                        </div>
                    </div>
                </div>
                <div id="layout-basic-information">
                    <div class="form-box">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" name="address" type="text" placeholder="VD: Đông Anh, Hà Nội" required>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input id="birthday" name="birthday" type="date" placeholder="01-01-2024" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Tel</label>
                        <input id="tel" name="tel" type="text" placeholder="0999999999" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input id="gender" name="gender" type="text" placeholder="0: Male, 1: Female" required>
                    </div>
                </div>
                <div id="layout-password">
                    <div class="form-box">
                        <div class="form-group">
                            <label for="password_register">Password</label>
                            <input id="password_register" name="password" type="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pass">Confirm Password</label>
                            <input id="confirm_pass" name="confirm_pass" type="password" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-bottom mt-20">
                <button type="submit" id="register-btn" class="login-btn hover:bg-blue-400 transition-colors duration-300" {{--onclick="loadingEffect()"--}}>
                    Sign Up
                </button>
                <div class="create-account">
                    <span>Already have an account?</span>
                    <a href="{{route('index')}}">Sign In</a>
                </div>
            </div>
        </form>
    </main>
</div>

@endsection