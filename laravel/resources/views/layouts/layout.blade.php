
@extends('app')

@section('app')
<nav class="navigation">
    <div class="sidebar-menu">
        <div class="logo">
            <img src="{{asset('images/Logo.png')}}" alt="">
        </div>
        <ul class="sidebar-top">
            <li class="sidebar-item">
                <a href="{{route('home')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="iteam-text">
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('author.index')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-user-graduate"></i>                    
                    </div>
                    <div class="iteam-text">
                        <span>Author</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('publisher.index')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <div class="iteam-text">
                        <span>Publisher</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('category.index')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <div class="iteam-text">
                        <span>Category</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('book.index')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div class="iteam-text">
                        <span>Book</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('lend_ticket.index')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-cash-register"></i>
                    </div>
                    <div class="iteam-text">
                        <span>Lend Ticket</span>
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
                    <div class="iteam-text">
                        <span>Setting</span>
                    </div>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{route('logout')}}" class="product">
                    <div class="product-icon">
                        <i class="fa-solid fa-power-off"></i>
                    </div>
                    <div class="iteam-text">
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
            <label for="menu-click" class="menu-icon" onclick="menu();">
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
                <div class="user-info">
                    <div class="user-name">
                        <span>{{Auth::user()->name}}</span>
                    </div>
                    <div class="user-code">
                        <span>{{Auth::user()->user_code}}</span>
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