<?php 
use App\Category;
use App\Page;
$pages = Page::all();
$categories = Category::all();
?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <!-- Styles -->
    @yield('styles')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>
<body>
@if(Session::has('success'))
    <script>
        alert("{{ Session::get('success') }}");
        <?php Session::forget('success'); ?>
    </script>
@elseif(Session::has('error_1'))
    <script>
        alert("{{ Session::get('error_1') }}");
        <?php Session::forget('error_1'); ?>
    </script>
@endif
<div class="overlay"> 
</div>   
    <nav class="main-navigation">
        <div class="category-links">
            @foreach($categories as $category)
                <a href="{{ route('public.category.product', [ 'id' => $category->id]) }}">{{ $category->name }}</a>
            @endforeach
        </div>    
        <div class="logo">
            <a href="{{ route('public.index') }}"><h1>ShoesShop</h1></a>
        </div>
        <div class="cart-and-user">
            <a href="{{ route('public.cart') }}">CART ( {{ Session::has('cart') ? Session::get('cart')->totalQuantity : '0' }} )</a>
            <button id="display-routes">MY PROFILE</button>
        </div>
        <div class="clearBoth"></div>
    </nav>  
    <div class="display-user-routes">
            <p class="close-btn">
                <span id="close-routes"><i class="fa fa-lg fa-times" aria-hidden="true"></i></span>
            </p>
        @guest
            <p class="lead">
                Create an account or login 
            </p>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            <a href="{{ route('user.home') }}">
                Go To Dashboard
            </a>         
            <a href="{{ route('user.logout') }}">
                Logout
            </a>
        @endguest
    </div>
    <div class="container-fluid">
        <div class="search">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <form action="{{ route('public.product.search') }}" method="GET">
                        <input type="search" required name="search" placeholder="Search all products">
                        <button type="submit"><i class="fa fa-lg fa-search"></i></button>
                    </form>
                </div>
                <div class="social-links col-md-6 col-lg-6">
                    <a href=""><i class="fa fa-lg fa-facebook"></i></a>
                    <a href=""><i class="fa fa-lg fa-instagram"></i></a>
                    <a href=""><i class="fa fa-lg fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div id="app">
            @yield('content')
        </div>
    </div>
    <footer>
        <div class="col-md-12 text-center">
            @foreach($pages as $page)
                <a href="{{ route('public.page', ['id' => $page->id]) }}">{{ $page->title }}</a>
            @endforeach
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('js')    
</body>
</html>