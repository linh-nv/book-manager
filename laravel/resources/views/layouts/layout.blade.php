
@extends('app')

@section('app')
<nav class="navigation">
    <div class="sidebar-menu">
        <div class="logo">
            <img src="{{asset('images/Logo.png')}}" alt="">
        </div>
        <ul class="sidebar-top">
            <li class="sidebar-item active-btn">
                <a href="{{route('home')}}" class="product bg-blue-400">
                    <div class="product-icon">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="product-text">
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('role.index')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-hammer"></i>
                    </div>
                    <div class="product-text">
                        <span>Role</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="product-text">
                        <span>Khách Hàng</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-mug-saucer"></i>
                    </div>
                    <div class="product-text">
                        <span>Sản Phẩm</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <div class="product-text">
                        <span>Danh Mục</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-file-invoice"></i>
                    </div>
                    <div class="product-text">
                        <span>Hóa Đơn</span>
                    </div>
                </a>
            </li>
        </ul>
        <!-- <ul class="sidebar-mid">

        </ul> -->
        <ul class="sidebar-bottom">
            <li class="sidebar-item">
                <a href="#setting" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <div class="product-text">
                        <span>Setting</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-power-off"></i>
                    </div>
                    <div href="" class="product-text">
                        <span>Logout</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</nav>
<main>
    <header class="top-bar">
        <div class="top-bar-left">
            <label for="menu-click" class="menu-icon">
                <img src="{{asset('icons/menu.svg')}}" alt="">
            </label>
            <input type="checkbox" id="menu-click">
            <div class="search-box">
                <div class="search-icon">
                    <img src="{{asset('icons/search.svg')}}" alt="">
                </div>
                <div class="search-input">
                    <input id="search" type="text" placeholder="Search category, book title" onkeyup="search()">
                    <ul id="search-result" class="list-search-category">
                    </ul>
                </div>
            </div>
        </div>
        <div class="top-bar-right">
            <div class="user-box">
                <div class="avatar">
                    <img src="{{asset('images/man-438081_960_720.png')}}" alt="avatar">
                </div>
                <div class="user-info">
                    <div class="user-name">
                        <span>Moni Roy</span>
                    </div>
                    <div class="user-role">
                        <span>Admin</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="content" class="min-h-[100vh] bg-[#F5F6FA]">
        @yield('content')
    </div>

</main>

@endsection