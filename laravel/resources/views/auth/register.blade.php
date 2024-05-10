@extends('app')

@section('app')
<div class="auth w-screen h-screen p-20">
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
        <section id="form-register" onload="handleRegister()">
            <input id="csrf_token" type="hidden" name="_token" value="{{csrf_token()}}">
            <span id="status-notification-message" class="text-red-500 flex justify-center"></span>

            <div class="form-mid">
                {{-- 1. Form name, email: Kiểm tra xem email đã tồn tại chưa
                    -> Nếu chưa: tiếp tục sang form khác
                    -> Nếu rồi: hiển thị thông báo và nhập lại
                --}}
                <div id="layout-name-email" class="flex flex-col gap-20">
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
                    <div class="form-group flex justify-center items-center">
                        <button onclick="handleCheckEmail('{{route('check_email')}}')" id="check-email-btn" class="login-btn flex justify-between items-center gap-4 bg-blue-500 text-white h-24 px-14 py-6 w-1/3 rounded-lg hover:bg-blue-400 transition-colors duration-300">
                            Tiếp tục
                            <div class="icon-btn">
                                <i class="fa-solid fa-right-long"></i>
                            </div>
                        </button>
                    </div>
                </div>

                {{-- 2. Form thông tin cơ bản: Nhập đủ tất cả các trường
                    -> Nếu chưa: tiếp tục sang form khác
                    -> Nếu rồi: hiển thị thông báo và nhập lại
                --}}
                <div id="layout-basic-information" class="hidden">
                    <div class="flex flex-col gap-[20px]">
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
                        <div class="form-group flex justify-center items-center">
                            <button onclick="handleCheckBasicInfor()" id="check-basic-infor-btn" class="login-btn flex justify-between items-center gap-4 bg-blue-500 text-white h-24 px-14 py-6 w-1/3 rounded-lg hover:bg-blue-400 transition-colors duration-300">
                                Tiếp tục
                                <div class="icon-btn">
                                    <i class="fa-solid fa-right-long"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- 3. Form password: Nhập mật khẩu và xử lý đăng ký
                    -> Nếu chưa: tiếp tục sang form khác
                    -> Nếu rồi: hiển thị thông báo và nhập lại
                --}}
                <div id="layout-password" class="hidden">
                    <div class="form-box">
                        <div class="form-group">
                            <label for="password_register">Password</label>
                            <input id="password_register" name="password" type="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_pass">Confirm Password</label>
                            <input id="confirm_pass" name="confirm_pass" type="password" required>
                        </div>
                        <div class="form-group flex justify-center items-center">
                            <button onclick="handleRegister('{{route('store')}}', '{{route('index')}}')" id="check-basic-infor-btn" class="login-btn flex justify-between items-center gap-4 bg-blue-500 text-white h-24 px-14 py-6 w-1/3 rounded-lg hover:bg-blue-400 transition-colors duration-300">
                                Đăng ký
                                <div class="icon-btn">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-bottom mt-20">
                <div class="create-account">
                    <span>Already have an account?</span>
                    <a href="{{route('index')}}">Sign In</a>
                </div>
            </div>
        </section>

    </main>
</div>

@endsection