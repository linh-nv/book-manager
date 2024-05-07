@extends('app')

@section('app')
<div class="auth w-screen h-screen">
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
        <section id="form-register">
            <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-mid">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input id="name" name="name" type="text" placeholder="Nguyen Van A" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input id="email" name="email" type="email" placeholder="esteban_schiller@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="password_register">Password:</label>
                    <input id="password_register" name="password" type="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_pass">Confirm Password:</label>
                    <input id="confirm_pass" name="confirm_pass" type="password" required>
                </div>
            </div>
            <div class="form-bottom mt-20">
                <button id="register-btn" class="login-btn hover:bg-blue-400 transition-colors duration-300" onclick="loadingEffect()">
                    Sign Up
                </button>
                <div class="create-account">
                    <span>Already have an account?</span>
                    <a href="{{route('index')}}">Sign In</a>
                </div>
            </div>
        </section>

    </main>
</div>

<script>
    function loadingEffect() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password_register').value;
        const confirm_pass = document.getElementById('confirm_pass').value;

        if (name !== '' && email !== '' && password !== '' && confirm_pass === password) {
            const bodyContent = document.querySelector('body');
            let loading = `
            <section id="loadingEffect"
                style="width: 100%; 
                        height: 100%; 
                        background-color: #fff; 
                        position: fixed; 
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        opacity: 0.8;">
                <img src="{{asset('images/Hourglass.gif')}}" alt="Loading.......">
            </section>
            `;
            bodyContent.insertAdjacentHTML('afterbegin', loading);

            handleSendEmailNotify(name, email, password);
        }else{
            alert('Nhập thông tin bị thiếu hoặc sai!!')
        }
    }

    function displayVerification() {
        const verification = `
            <section class="verification w-full h-full p-10 top-0 left-0 rounded-xl text-center items-center justify-center">
            <div class="">
                <div class="heading w-full flex justify-center pt-10">
                <h1 class="text-4xl font-semibold uppercase">Xác minh tài khoản email</h1>
                </div>
                <p class="text-2xl mt-20">Thư xác minh đã được gửi đến email của bạn. Để hoàn tất đăng ký tài khoản, xin hãy xác nhận tài khoản email</p>
                <div class="flex w-full justify-center mt-20">
                <a href="https://mail.google.com/mail/" class="flex bg-red-700 py-2 px-8 text-2xl font-bold gap-4 rounded-xl items-center text-white">
                    <span>Đi đến Mail</span>
                    <img class="w-10 h-10" src="{{asset('icons/google-gmail.svg')}}" alt="">
                </a>
                </div>
            </div>
            </section>
        `;

        $('main').html(verification);
    }


    function handleSendEmailNotify(name, email, password) {
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('store') }}',
                method: 'POST',
                data: {
                _token: $('#csrf_token').val(),
                email: email,
                name: name,
                password: password,
                },
                success: function(response) {
                console.log(response);
                $('#loadingEffect').hide();
                displayVerification();
                },
                error: function(xhr, status, error) {
                console.log(error);
                }
            });
        });          
    }
</script>
@endsection