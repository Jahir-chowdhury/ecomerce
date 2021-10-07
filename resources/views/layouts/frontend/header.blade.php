<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Anar</title>
    <meta name="keywords" content="Anar.com.bd">
    <meta name="description" content="Anar.com.bd">
    <meta name="author" content="p-themes">
    
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/image49.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/image49.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/image49.png') }}">
    
    <!--<link rel="manifest" href="{{ asset('assets/images/icons/site.html') }}">-->
    <!--<link rel="mask-icon" href="{{ asset('assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">-->
    <link rel="shortcut icon" href="{{ asset('assets/images/image49.png') }}">
    
    
    
    
    <meta name="apple-mobile-web-app-title" content="Anar">
    <meta name="application-name" content="Anar">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery.countdown.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-demo-13.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demos/demo-13.css') }}">
 
    
    <style>
        .topnav {
          width: 80%;
          position:relative;
        }
    
        .cat-cover{
            width: 100% !important;
            height: 200px !important;
            position: relative;
       
        }
    
        .page-title{
            color:#3418d9 !important;
        }
    
        .page-header{
            padding:0px;
        }
    
        .cat-title{
             position: absolute;
            margin-top: -130px;
            background: #ddd;
            opacity: .5;
            width: 40%;
            margin-left: 30%;
        }
    
        .topnav a {
          float: left;
          display: block;
          color: black;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
          font-size: 17px;
        }
    
        .search-dropdown-div{
            position: absolute;
            width: 48%;
            z-index: 9999;
            height: 200px;
            margin-top: 21%;
            border-radius: 5px;
            margin-left:25%;
            display:none;
        }
        .dropdown-searchdata{
            display: block;
            margin-top: -4px;
            padding: 10px;
            font-size: 12px;
            font-weight: 500;
            width: 102%;
            background: #fff;
            overflow-y: scroll;
            height: 300px;
    
        }
    
        .dropdown-searchdata > li:hover{
            background:#ddd;
            padding:5px;
        }
        .topnav a:hover {
          background-color: #ddd;
          color: black;
        }
    
        .searchBtn{
            position: absolute;
            padding: 4px 10px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
            margin-top: -39px;
            margin-left: 75%;
        }
    
    
        .topnav a.active {
          background-color: #2196F3;
          color: white;
        }
    
    
    
        .topnav input[type=text] {
            padding: 6px;
            font-size: 17px;
            border: 1px solid #ddd;
            border-radius: 5px 0px 0px 5px;
            width: 80%;
            position: relative;
            margin-bottom: 0px;
        }
        .topnav .search-container button:hover {
          background: #ccc;
        }
    
    
        .img_mbl{
            height: 203px !important;
        }
        .vendor_img img{
                height: 125px; width: 18rem;
        }
    
        .category_img{
            width: 40px; margin: auto;height: 40px;
        }
        
        .newsletter-popup-container .mfp-close {
            right: calc(100% / 12 + 21rem);
        }
        .newsletter-popup-container .newsletter-popup-content {
            box-shadow: 0 0px 0px rgba(34, 34, 34, 0.3);
        }
        
        .img_newsletter{
            width:600px !important;
            height:360px !important;
        }
    
    
    
        @media screen and (max-width: 600px) {
            .img_newsletter{
                width:600px !important;
                height:300px !important;
            }  
            .product-action > button > span{
                display:none;
            }
            .product-action {
                left: 7rem;
                right: 1rem;
                border-radius: 40px;
                border: 1px solid dodgerblue;
            }
            .btn-product{
                border:none;
            }
            .product-action-vertical {
                right:1rem !important;
            }
            
            .newsletter-popup-container .mfp-close {
                right: calc(100% / 12 + 1.4rem);
            }
            
                .mb-3{
                    margin-bottom:2.5rem !important;
                }
                .intro-slide{
                    height:100px !important;
                }
                .img_mbl{
                    height:100px !important;
                }
            
                .banner img {
                    display: block;
                    max-width: none;
                    width: 100%;
                    height: 9rem;
                }
            
                .heading.heading-flex {
                    flex-direction: column;
                    text-align: center;
                    display:inline-block !important;
                }
            
                #clockdiv {
                    font-family: sans-serif;
                    display: inline-block;
                    font-weight: 100;
                    text-align: center;
                    font-size: 10px;
                }
        
                .flash_sale {
                    margin-top: 19px;
                    font-size: 18px;
                    color: green;
                    margin-right: 80px;
                    display: none;
                }
            
                .cat-block {
                    height: 61px;
                }
            
                .vendor_img img{
                    height:60px;
                    width:100%;
                }
                .icon-box-side .icon-box-title {
                    font-weight: 400;
                    font-size: 1.0rem;
                }
                .category_img{
                    width: 40px; height: 30px;
                }
                .electronics .product-body {
                    padding: 0.6rem 0.5rem 0.6rem 1rem;
                }
            
                .product-price {
                    font-size: 1.2rem;
                    margin-bottom: 0.5rem;
                }
                .product-title {
                    font-size: 1.0rem !important;
                }
                .title{
                    font-size:1.7rem !important;
                }
            
                .intro-slider-container, .intro-slide {
                    height: 100px;
                    background-color: #fafafa;
                }
                .intro-title{
                    font-size:2rem !important;
                        background: #ddd;
                        padding: 5px;
                        border-radius: 5px;
                        opacity: 0.6;
                }
                .intro-title span{
                    font-size:2.6rem !important;
                }
            
              .topnav .search-container {
                float: none;
              }
          
              .searchBtn{
                  display: none !important;
               }
              .topnav a, .topnav input[type=text], .topnav .search-container button {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                margin: 0;
                border-radius: 5px !important;
                padding: 5px;
                font-size: 12px;
                margin-bottom:5px;
                margin-top:5px;
                height: 30px;
                margin-left: 8px;
              }
              .topnav input[type=text] {
                border: 1px solid #ccc;  
              }
              .site-logo{
                display: none;
              }
              .mb-mode{
                max-width: 35px !important;
              }
          
              .searchBtn{
                  display:none;
              }
          
              .dropdown-toggle.user-option{
                  display:none;
              }
          
              .header.header-10.header-intro-clearance .compare-dropdown .dropdown-toggle, .header.header-10.header-intro-clearance .cart-dropdown .dropdown-toggle, .header.header-10.header-intro-clearance .wishlist-link .dropdown-toggle {
              
                font-size: 20px;
            }
            .header.header-10.header-intro-clearance .compare-dropdown [class*='count'], .header.header-10.header-intro-clearance .cart-dropdown [class*='count'], .header.header-10.header-intro-clearance .wishlist-link [class*='count'] {
                min-width: 1.1rem;
                height: 1.1rem;
            }
        
            .dropdown-searchdata{
                display: block;
                margin-top: 0px;
                padding: 10px;
                font-size: 10px;
                font-weight: 400;
                margin-left: 9px;
                border-radius: 5px;
                overflow-y: scroll;
                height: 150px;
                width: 196px;
            }
        
            .dropdown-searchdata > li:hover{
                background:#ddd;
                padding:5px;
            }
        
            .search-dropdown-div{
                position: absolute;
                width: 62%;
                z-index: 9999;
                height: 200px;
                margin-top: 75%;
                border-radius: 5px;
                margin-left: 23px;
                display:none;
            }
        }
</style>

</head>

<body>
    @include('sweetalert::alert')
    <div class="page-wrapper" id="app">

        <div class="top-notice text-white bg-dark" id="newsletter-headadd">
            @foreach ($ads as $ad)
                @if ($ad->position == 'top')
                    <div class="container text-center">
                        <a target="_blank" href="{{$ad->link}}">
                            <img src="{{ asset('/images/' . $ad->avatar) }}">
                        </a>
                        <button onclick="closeAdd()" title="Close (Esc)" type="button" class="mfp-close"></button>
                    </div>
                @endif
            @endforeach
        </div>

        <header class="header header-10 header-intro-clearance">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="tel:#"><i class="icon-phone"></i>Call: {{ optional($setting)->contact }}</a>
                    </div>
                    <!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <ul>
                                    @guest
                                        <li class="login">
                                            <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                                        </li>
                                    @endguest
                                </ul>
                            </li>
                        </ul>
                        <!-- End .top-menu -->
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-top -->

            <div class="sticky-header" style="padding-right: 0px !important">
                <div class="header-middle">
                    <div class="container">
                        <div class="header-left mb-mode">
                            <button class="mobile-menu-toggler">
                                <span class="sr-only">Toggle mobile menu</span>
                                <i style="font-size:2.0rem !important;" class="icon-bars"></i>
                            </button>

                            <a class="site-logo" href="{{ route('home') }}" style="padding-top:5px;padding-bottom:5px;">
                                <img src="/images/{{ optional($setting)->logo }}" alt="logo" width="160" height="30">
                            </a>

                        </div>
                        <div class="topnav">
                          <div class="search-container">
                            <form>
                              <input onkeyup="searchTest()" type="text" class="form-control" id="searchValue" placeholder="Search..">
                              <button class="searchBtn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                          </div>
                        </div>
                        
                        <div class="search-dropdown-div" id="productValue">

                        </div>

                        <div class="header-right">
                            <span style="background-color: #2edc53;
                                font-size: 12px;
                                padding-left: 5px;
                                padding-right: 5px;display:none;" id="error">Already in wish list.
                            </span>
                            <span style="background-color: #2edc53;
                                font-size: 12px;
                                padding-left: 5px;
                                padding-right: 5px;display:none;" id="cartError">Already in Cart.
                            </span>

                            <di v class="header-dropdown-link">
                                @auth
                                <a href="{{route('wishlist')}}" title="wishlist" class="wishlist-link">
                                    <i class="icon-heart-o"></i>
                                <span style="top: -0.7rem !important;
                                right: -0.5rem !important;" class="wishlist-count" id="count">{{$count}}</span>
                                    
                                </a>
                                @else
                                <a href="#" class="wishlist-link" title="wishlist">
                                    <i class="icon-heart-o"></i>
                                <span style="top: -0.7rem !important;
                                right: -0.5rem !important;" class="wishlist-count">00</span>
                                </a>
                                @endauth
                                <div class="dropdown cart-dropdown">
                                    <a href="#" class="dropdown-toggle" title="cart" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-display="static">
                                        <i class="icon-shopping-cart"></i>
                                    <span style="top: -0.7rem !important;
                                    right: -0.5rem !important;" class="cart-count" id="count1">{{$count1}}</span>
                                        {{-- <span class="cart-txt">Cart</span> --}}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" style="margin-top: 20px;">
                                        <div class="dropdown-cart-products">
                                            @foreach ($cart as $crt)
                                            @if ($crt->get_product)
                                            <div class="product" style="padding-top: 3px; ">
                                                <div class="product-cart-details">
                                                    <h4 class="product-title">
                                                        <a id="pro_name" href="{{route('cart')}}">{{$crt->get_product ? $crt->get_product->product_name  : ''}}</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                        <span id="pro_sale" class="cart-product-qty">{{$crt->qty}}</span> x {{$crt->get_product ? $crt->get_product->sale_price : ''}}
                                                    </span>
                                                </div>
                                                <!-- End .product-cart-details -->
                                                @if ($crt->get_product)

                                                @foreach ($crt->get_product->get_product_avatars as $avatar)
                                                <figure class="product-image-container">
                                                    <a href="#" class="product-image">
                                                        <img id="cartAvtr" src="{{ asset('/images/' . $avatar->front) }}"
                                                            alt="product">
                                                    </a>
                                                </figure>
                                                @endforeach
                                                @endif
                                                <button onclick="itemDelete({{$crt->id}})" class="btn-remove" title="Remove Product">
                                                    <i style="font-size: 1.5rem !important;" class="icon-close"></i>
                                                </button>
                                            </div>
                                            <!-- End .product -->
                                            @endif
                                            @endforeach
                                            @foreach ($cart as $crt)
                                            @if ($crt->get_vendor_product)
                                            <div class="product">
                                                <div class="product-cart-details">
                                                    <h4 class="product-title">
                                                        <a id="pro_name" href="{{route('cart')}}">{{$crt->get_vendor_product->product_name}}</a>
                                                    </h4>

                                                    <span class="cart-product-info">
                                                    <span id="pro_sale" class="cart-product-qty">{{$crt->qty}}</span> x {{$crt->get_vendor_product->sale_price}}
                                                    </span>
                                                </div>
                                                <!-- End .product-cart-details -->
                                                @foreach ($crt->get_vendor_product->get_vendor_product_avatar as $avatar)
                                                <figure class="product-image-container">
                                                    <a href="#" class="product-image">
                                                        <img id="cartAvtr" src="{{ asset('/images/' . $avatar->front) }}"
                                                            alt="product">
                                                    </a>
                                                </figure>
                                                @endforeach
                                                <button onclick="itemDelete({{$crt->id}})" class="btn-remove" title="Remove Product">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </div>
                                            <!-- End .product -->
                                            @endif
                                            @endforeach
                                        </div>
                                        <!-- End .cart-product -->

                                        <div class="dropdown-cart-total">
                                            <span>Total</span>
                                            @php
                                                $amount = 0
                                            @endphp
                                            @foreach ($cart as $crt)
                                                @php
                                                    $amount += $crt->total
                                                @endphp
                                            @endforeach
                                            <span class="cart-total-price">= {{$amount}} TK</span>
                                        </div>
                                        <!-- End .dropdown-cart-total -->
                                        @auth
                                        <div class="dropdown-cart-action">
                                            <a href="{{route('cart')}}" class="btn btn-primary">View Cart</a>
                                            <a href="{{ route('cart.bill') }}" class="btn btn-outline-primary-2">Checkout</a>
                                        </div>
                                        @else
                                        <div class="dropdown-cart-action">
                                            <a href="#" class="btn btn-primary">View Cart</a>
                                            <a href="#" class="btn btn-outline-primary-2">Checkout</a>
                                        </div>
                                        @endauth
                                        <!-- End .dropdown-cart-total -->
                                    </div>
                                    <!-- End .dropdown-menu -->
                                </div>
                                @auth
                                <div class="dropdown cart-dropdown">
                                    <a href="{{route('user')}}" class="dropdown-toggle user-option" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-display="static">
                                        <i class="la la-user"></i>
                                        <span class="cart-count" style="background-color: #c96;
                                        height: 10px;
                                        min-width: 10px;"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right e-money" style="margin-right: 2px; margin-top: 19px; padding-top:6px;height: 180px;">

                                        <ul>
                                            @if(auth()->user()->role == 'vendor')
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i style="font-size: 15px;
                                                    margin-right: 3px;" class="la la-user"></i>Vendor Account</a>
                                            </li>
                                            @elseif(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                                            <li>
                                                <a href="{{ route('dashboard') }}"><i style="font-size: 15px;
                                                    margin-right: 3px;" class="la la-user"></i>Admin Dashboard</a>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="{{url('profile')}}"><i style="font-size: 15px;
                                                    margin-right: 3px;" class="la la-user"></i>Profile</a>
                                            </li>
                                            <hr style="margin:0px;">
                                            <li>
                                                <a href="{{route('wishlist')}}"><i style="font-size: 15px;
                                                    margin-right: 5px;" class="la la-heart"></i>Wishlist</a>
                                            </li>
                                            <hr style="margin:0px;">
                                            <li><a href="{{url('profile')}}" style="display: inline-flex;">
                                                <img src="/assets/tk.svg" style="height: 15px;
                                                    width: 10%;
                                                    margin-top: 4px;
                                                    margin-right: 5px;">
                                                E-money
                                                <span style="line-height: 2;" class="badge badge-warning">{{auth()->user()->e_money}} TK</span>
                                            </a></li>
                                            <hr style="margin:0px;">
                                            <li>
                                                <a href="{{ route('user.logout') }}">
                                                    <i style="font-size: 15px;
                                                        margin-right: 5px;cursor: pointer;" class="la la-sign-out"></i>
                                                    Logout
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End .dropdown-cart-total -->
                                    </div>
                                    <!-- End .dropdown-menu -->
                                </div>
                                @else
                                <div class="dropdown cart-dropdown">
                                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" data-display="static">
                                        <i class="la la-user"></i>
                                        <span class="cart-count" style="background-color:red;
                                        height: 10px;
                                        min-width: 10px;"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <h6>Please login first then view your profile</h6>
                                    </div>
                                    <!-- End .dropdown-menu -->
                                </div>
                                @endauth


                                <!-- End .cart-dropdown -->
                            </div>
                        </div>

                    </div>
                    <!-- End .container -->
                </div>
                <!-- End .header-middle -->
                

                <div class="header-bottom">
                    <div class="container" style="height: 2.7rem !important">
                        <div class="header-left">
                            <div onclick="showDropdown()" class="dropdown category-dropdown show is-on" data-visible="true">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">Categories
                                </a>
                                <div class="dropdown-menu show" id="showCategory">
                                    <nav class="side-nav">
                                        <ul class="menu-vertical sf-arrows sf-js-enabled">
                                            @foreach ($categories as $cat)
                                                <li class="megamenu-container">
                                                <a class="sf-with-ul" href="{{ route('category',$cat->slug)}}">{{ $cat->cat_name }}</a>

                                                    <div class="megamenu" style="display: none;height: 375px;width: 650px;">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-12" style="overflow-y: scroll;
                                                            height: 375px !important;">
                                                                <div class="menu-col">
                                                                    <div class="row col-12">
                                                                        @foreach ($cat->get_child_category as $child)
                                                                        <div class="col-md-6">

                                                                                <div class="menu-title">
                                                                                    <a href="{{ route('category',$child->slug)}}">{{ $child->child_name }}</a>
                                                                                </div>
                                                                                <ul>
                                                                                    @foreach ($child->get_sub_child_category as $sub_child)
                                                                                        <li>
                                                                                            <a href="{{ route('category',$sub_child->slug)}}">{{ $sub_child->sub_child_name }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                        </div>
                                                                        @endforeach
                                                                        <!-- End .col-md-6 -->
                                                                    </div>
                                                                    <!-- End .row -->
                                                                </div>
                                                                <!-- End .menu-col -->
                                                            </div>
                                                            <!-- End .col-md-8 -->

                                                            {{-- <div class="col-md-4">
                                                                <div class="banner banner-overlay">
                                                                    <a href="category.html" class="banner banner-menu">
                                                                        <img style="height: 375px;" src="assets/images/demos/demo-13/menu/banner-1.jpg"
                                                                            alt="Banner">
                                                                    </a>
                                                                </div>
                                                                <!-- End .banner banner-overlay -->
                                                            </div> --}}
                                                            <!-- End .col-md-4 -->
                                                        </div>
                                                        <!-- End .row -->
                                                    </div>
                                                    <!-- End .megamenu -->
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- End .menu-vertical -->
                                    </nav>
                                    <!-- End .side-nav -->
                                </div>
                                <!-- End .dropdown-menu -->
                            </div>
                            <!-- End .category-dropdown -->
                        </div>
                        
                       
                        
                        
                        <div class="header-right">
                            <i style="font-size: 2rem !important;color: yellow !important;" class="la la-lightbulb-o"></i>
                            @auth
                                @if(auth()->user()->e_money >= 100)
                                    <p style="font-size: 1.2rem !important">Allowed For Purchasing By E-Money <strong style="color:yellow;">{{optional(auth()->user())->e_money}} TK</strong></p>
                                @else
                                    <p style="font-size: 1.2rem !important">Not Allowed For Purchasing By E-Money <strong style="color:yellow;">{{optional(auth()->user())->e_money}} TK</strong></p>
                                @endif
                            @else
                            <p style="font-size: 1.2rem !important">Get E-Money By Purchasing Product</p>
                            @endauth
                        </div>
                        
                        
                    </div><!-- End .container -->
                </div><!-- End .header-bottom -->
            </div>
        </header>
