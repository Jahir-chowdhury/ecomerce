@extends('layouts.frontend.app')

@section('content')


<main class="main">
    <div class="intro-slider-container">
        <div class="intro-slider owl-carousel owl-simple owl-nav-inside owl-loaded owl-drag" data-toggle="owl"
            data-owl-options="{
                    &quot;nav&quot;: false,
                    &quot;responsive&quot;: {
                        &quot;992&quot;: {
                            &quot;nav&quot;: true
                        }
                    }
                }">
            
            <div class="owl-stage-outer">
                <div class="owl-stage"
                    style="transform: translate3d(-2698px, 0px, 0px); transition: all 0s ease 0s; width: 10792px;">
                  @foreach ($banars as $banar)
                    <div class="owl-item active" style="width: 1349px;">
                        @if($banar->slug)
                        <a target="_blank" href="{{route('quick',$banar->slug)}}">
                        @else
                        <a href="#">
                        @endif
                        
                            <div class="intro-slide" style="background-image:url('{{ $banar ? asset('/images/' . $banar->image) : '' }}')">
                                
                                <div class="container intro-content">
                                    <div class="row">
                                        <div class="col-auto offset-lg-3 intro-col">
                                            
                                            @if($banar->slug)
                                                <a target="_blank" href="{{route('quick',$banar->slug)}}" class="btn btn-outline-primary-2">
                                                    <span>Shop Now</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <!-- End .col-auto offset-lg-3 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .container intro-content -->
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="owl-nav">
                <button type="button" role="presentation" class="owl-prev"><i
                    class="icon-angle-left"></i>
                </button>
                <button type="button" role="presentation"
                    class="owl-next"><i class="icon-angle-right"></i>
                </button>
            </div>
        </div>
        <span class="slider-loader"></span>
    </div>



    <div class="mb-3"></div>
    <!-- Vendor started from here -->
    <div class="container">
        <div class="heading-border bg-light">
            <h2 class="text-center title" style="padding-top: 10px;">Express Shop</h2>
        </div>
        <div class="cat-blocks-container">
            <div class="row">
                @foreach ($vendors as $vendor)
                @if ($vendor->status == 1)
                <div class="col-3 col-sm-4 col-lg-2">
                    <a target="_blank" href="{{route('vendor.list.product',$vendor->brand_name)}}" class="cat-block">
                        <figure>
                            <span class="vendor_img">
                                <img src="{{ asset('/images/' . $vendor->logo) }}">
                            </span>
                        </figure>
                    </a>
                </div>
                @endif
                @endforeach
                <!-- End .col-sm-4 col-lg-2 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .cat-blocks-container -->
    </div>
    <!-- End .container -->
    <div class="mb-2"></div>
    <!-- End .mb-3 -->
    <div class="bg-light">
        <div class="container">
            <div class="title">
                Flash Sale
            </div>
            <div class="heading heading-flex heading-border mb-3" style="padding-bottom: 5px;">
                <div style="display: contents;">
                    <h6 class="flash_sale">On Sale Now</h6>
                    <span class="ending">Ending In</span>

                    <div id="clockdiv">
                        <div>
                            <span id="d" class="hours"></span>
                            <div class="smalltext">Days</div>
                        </div>
                        <div>
                            <span id="h" class="hours"></span>
                            <div class="smalltext">Hours</div>
                        </div>
                        <div>
                            <span id="m" class="minutes"></span>
                            <div class="smalltext">Minutes</div>
                        </div>

                        <div>
                            <span id="s" class="seconds"></span>
                            <div class="smalltext">Seconds</div>
                        </div>
                    </div>
                    <!-- End .title -->
                </div>
                <!-- End .heading-left -->


                <!-- End .heading-right -->
            </div>
            <!-- End .heading -->



            <div class="tab-content tab-content-carousel">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow owl-loaded owl-drag"
                    data-toggle="owl" data-owl-options="{
                                &quot;nav&quot;: false,
                                &quot;dots&quot;: true,
                                &quot;margin&quot;: 5,
                                &quot;loop&quot;: false,
                                &quot;responsive&quot;: {
                                    &quot;0&quot;: {
                                        &quot;items&quot;:3
                                    },
                                    &quot;480&quot;: {
                                        &quot;items&quot;:3
                                    },
                                    &quot;768&quot;: {
                                        &quot;items&quot;:3
                                    },
                                    &quot;992&quot;: {
                                        &quot;items&quot;:4
                                    },
                                    &quot;1280&quot;: {
                                        &quot;items&quot;:6,
                                        &quot;nav&quot;: true
                                    }
                                }
                            }">
                    
                        @foreach ($products as $product)
                         @if ($product->position == 'flash sale' && $product->flash_timing != null && $product->flash_status == 1 && $product->get_category->status == 1)
                        <div class="product prod_hover">
                         <input type="hidden" id="time" value="{{$product->flash_timing}}">
                            @foreach ($product->get_product_avatars as $pro_avatar)
                                <figure class="product-media">
                                    <a target="_blank" href="{{route('quick',$product->slug)}}">
                                        <img class="img_mbl"
                                            src="{{ asset('/images/' . $pro_avatar->front) }}"
                                            alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <button onclick="addWishList({{$product}})"
                                            class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></button>
                                    </div>
                                    <!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <button onclick="addToCart({{$product}})" class="btn-product btn-cart" title="Add to cart"><span>add
                                                to cart</span></button>
                                    </div>
                                    <!-- End .product-action -->
                                </figure>
                            @endforeach
                                <div class="product-body">
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a target="_blank" href="{{route('quick',$product->slug)}}">{{$product->product_name}}</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                                        <span class="new-price">{{$attr->sale_price}} TK</span>
                                        <span class="old-price"><del>{{$attr->promo_price}} TK</del></span>
                                            
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endforeach
                </div>
                <!-- End .owl-carousel -->


                <!-- .End .tab-pane -->
            </div>
            <!-- End .tab-content -->
            
        </div>
        <!-- End .container -->
    </div>
    <!-- End .bg-light pt-5 pb-5 -->


    <div class="mb-2"></div>
    <!-- Advertisements started from here -->

    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                @foreach ($ads as $ad)
                @if($ad->position == "body-top left")

                <div class="banner banner-overlay">
                    <a target="_blank" href="{{$ad->link}}">
                        <img src="{{ asset('/images/' . $ad->avatar) }}" alt="Banner">
                    </a>
                </div>
                @endif
                @endforeach
                <!-- End .banner -->
            </div>
            <!-- End .col-lg-6 -->


            <div class="col-lg-6">
                @foreach ($ads as $ad)
                @if($ad->position == "body-top right")

                <div class="banner banner-overlay">
                    <a target="_blank" href="{{$ad->link}}">
                        <img src="{{ asset('/images/' . $ad->avatar) }}" alt="Banner">
                    </a>
                </div>
                @endif
                @endforeach
                <!-- End .banner -->
            </div>
            <!-- End .col-lg-6 -->

        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->


    <!-- Category started from here -->
    <div class="container">
        <div class="heading-border bg-light">
            <h2 class="text-center title" style="padding-top: 10px;">Explore Popular Categories</h2>
        </div>
        <!-- End .title -->
        <div class="cat-blocks-container">
            <div class="row">
                @foreach ($categories as $cat)
                @if ($cat->explor == 1 && $cat->status == 1)

                <div class="col-6 col-sm-8 col-lg-3" style="margin-bottom: 5px;">
                    <a target="_blank" href="{{ route('category',$cat->slug)}}" class="icon-box icon-box-side"
                        style="border: 1px solid #ddd; padding-top:.5rem !important; padding-bottom: .5rem !important;">
                        <h3 class="icon-box-title" style="margin: auto;">{{$cat->cat_name}}</h3>
                        <img style="width: 35px !important;
                            height: 30px !important;" class="category_img" src="{{ asset('/images/' . $cat->icon) }}"
                            alt="">
                        <!-- <i class="icon-rotate-right"></i> -->
                        <!-- End .icon-box-content -->
                    </a>
                    <!-- End .icon-box -->
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
    <div class="mb-2"></div>
    
    
    <div class="bg-light">
            <div class="container electronics">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left">
                        <h2 class="title">Anar Mall</h2>
                        <!-- End .title -->
                    </div>
                    <!-- End .heading-left -->

                    <!--<div class="heading-right">-->
                    <!--        <a href="category-4cols.html" class="btn btn-outline-primary-2">-->
                    <!--            <span>Shop More</span>-->
                    <!--        </a>-->
                    <!--</div>-->
                    <!-- End .heading-right -->
                </div>
                <!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="elec-new-tab" role="tabpanel" aria-labelledby="elec-new-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 5,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":3
                                    },
                                    "480": {
                                        "items":3
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>
                        @foreach ($products as $product)
                        @if ($product->position == 'own mall' && $product->get_category->status == 1)
                        <div class="product prod_hover">
                            @foreach ($product->get_product_avatars as $pro_avatar)
                                <figure class="product-media">
                                    <a target="_blank" href="{{route('quick',$product->slug)}}">
                                        <img class="img_mbl"
                                            src="{{ asset('/images/' . $pro_avatar->front) }}"
                                            alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <button onclick="addWishList({{$product}})"
                                            class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></button>
                                    </div>
                                    <!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <button onclick="addToCart({{$product}})" class="btn-product btn-cart" title="Add to cart"><span>add
                                                to cart</span></button>
                                    </div>
                                    <!-- End .product-action -->
                                </figure>
                            @endforeach
                                <div class="product-body">
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a target="_blank" href="{{route('quick',$product->slug)}}">{{$product->product_name}}</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                                        <span class="new-price">{{$attr->sale_price}} TK</span>
                                        <span class="old-price"><del>{{$attr->promo_price}} TK</del></span>
                                            
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endforeach
                        </div>
                        <!-- End .owl-carousel -->
                    </div>
                    <!-- .End .tab-pane -->
                  
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .container -->
        </div>
        
    <div class="mb-2"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                @foreach($ads as $ad)
                @if($ad->position == "body-bottom left")
                <div class="banner banner-overlay banner-overlay-light">
                    <a target="_blank" href="{{$ad->link}}">
                        <img src="{{ asset('/images/' . $ad->avatar) }}">
                    </a>
                    <!-- End .banner-content -->
                </div>
                @endif
                @endforeach
                <!-- End .banner -->
            </div>
            <!-- End .col-lg-6 -->

            <div class="col-lg-6">
                @foreach($ads as $ad)
                @if($ad->position == "body-bottom right")
                <div class="banner banner-overlay">
                    <a target="_blank" href="{{$ad->link}}">
                        <img src="{{ asset('/images/' . $ad->avatar) }}" alt="Banner">
                    </a>
                </div>
                @endif
                @endforeach
                <!-- End .banner -->
            </div>
            <!-- End .col-lg-6 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->

    <div class="bg-light">
            <div class="container electronics">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left">
                        <h2 class="title">Upcoming Product</h2>
                        <!-- End .title -->
                    </div>
                    <!-- End .heading-left -->
                </div>
                <!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="elec-new-tab" role="tabpanel" aria-labelledby="elec-new-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 5,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":3
                                    },
                                    "480": {
                                        "items":3
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach ($products as $product)
                        @if ($product->position == 'upcoming product' && $product->get_category->status == 1)
                        <div class="product prod_hover">
                            @foreach ($product->get_product_avatars as $pro_avatar)
                                <figure class="product-media">
                                    
                                    <a target="_blank" href="{{route('quick',$product->slug)}}">
                                        <img class="img_mbl"
                                            src="{{ asset('/images/' . $pro_avatar->front) }}"
                                            alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <button onclick="addWishList({{$product}})"
                                            class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></button>
                                    </div>
                                    <!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <button onclick="addToCart({{$product}})" class="btn-product btn-cart" title="Add to cart"><span>add
                                                to cart</span></button>
                                    </div>
                                    <!-- End .product-action -->
                                </figure>
                            @endforeach
                                <div class="product-body">
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            target="_blank" href="{{route('quick',$product->slug)}}">{{$product->product_name}}</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                                        <span class="new-price">{{$attr->sale_price}} TK</span>
                                        <span class="old-price"><del>{{$attr->promo_price}} TK</del></span>
                                            
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endforeach
                        </div>
                        <!-- End .owl-carousel -->
                    </div>
                    <!-- .End .tab-pane -->
                  
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .container -->
        </div>

    <div class="mb-2"></div>

    <div class="bg-light">
            <div class="container electronics">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left">
                        <h2 class="title">Global Product</h2>
                        <!-- End .title -->
                    </div>
                    <!-- End .heading-left -->

                </div>
                <!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="elec-new-tab" role="tabpanel" aria-labelledby="elec-new-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 5,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":3
                                    },
                                    "480": {
                                        "items":3
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":6,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach ($products as $product)
                        @if ($product->position == 'global product' && $product->get_category->status == 1)
                        <div class="product prod_hover">
                            @foreach ($product->get_product_avatars as $pro_avatar)
                                <figure class="product-media">
                                    <a target="_blank" href="{{route('quick',$product->slug)}}">
                                        <img class="img_mbl"
                                            src="{{ asset('/images/' . $pro_avatar->front) }}"
                                            alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <button onclick="addWishList({{$product}})"
                                            class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                wishlist</span></button>
                                    </div>
                                    <!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <button onclick="addToCart({{$product}})" class="btn-product btn-cart" title="Add to cart"><span>add
                                                to cart</span></button>
                                    </div>
                                    <!-- End .product-action -->
                                </figure>
                            @endforeach
                                <div class="product-body">
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            target="_blank" href="{{route('quick',$product->slug)}}">{{$product->product_name}}</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        @foreach ($product->get_attribute->unique('product_id') as $attr)
                                        <span class="new-price">{{$attr->sale_price}} TK</span>
                                        <span class="old-price"><del>{{$attr->promo_price}} TK</del></span>
                                            
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endforeach
                        </div>
                        <!-- End .owl-carousel -->
                    </div>
                    <!-- .End .tab-pane -->
                  
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .container -->
        </div>
    <div class="mb-2"></div>
    <div class="container furniture">
        <div class="heading heading-flex heading-border mb-3">
            <div class="heading-left">
                <h2 class="title">Just For You</h2>
                <!-- End .title -->
            </div>
            <!-- End .heading-left -->
        </div>
        <div>
            @include('layouts.frontend.load_product')
            <div class="text-center">
              <button onclick="load()" class="btn btn-outline-primary-2">
                <span>Load More</span>
              </button>
            </div>
         </div>
    </div>

    <div class="mb-3"></div>
    <!-- End .mb-3 -->
    <div class="cta bg-image bg-dark pt-4 pb-5 mb-0" style="background-image: url(assets/images/demos/demo-4/bg-5.jpg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <div class="cta-heading text-center">
                        <h3 class="cta-title text-white">Get The Latest Deals</h3><!-- End .cta-title -->
                        <!--<p class="cta-desc text-white">and receive <span class="font-weight-normal">$20 coupon</span> for first shopping</p><!-- End .cta-desc -->-->
                    </div><!-- End .text-center -->

                    <form action="javascript:void(0)" type="post">
                        <!--{{ csrf_field() }}-->
                        <div class="input-group input-group-round" style="margin-bottom:5px;">
                            <input onfocus="enableSubscriber()" onfocusout="checkSubscriber()" type="email" name="subscriber_email" id="subscriber_email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                            <div class="input-group-append">
                                <button id="btnSubmit" onclick="addSubscriber();" class="btn btn-primary" type="submit"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                            </div><!-- .End .input-group-append -->

                        </div><!-- .End .input-group -->
                        <span id="statusSubscribe" style="display: none;"></span>
                    </form>
                </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cta -->


</main>




<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="row no-gutters newsletter-popup-content">
                
                @foreach ($ads as $ad)
                    @if ($ad->position == 'popup')
                            <a target="_blank" href="{{$ad->link}}" style="margin:auto;" >
                                <img src="{{ asset('/images/' . $ad->avatar) }}" class="img_newsletter" alt="newsletter">
                            </a>
                    
                    @endif
                @endforeach
                  
            </div>
        </div>
    </div>
</div>



@section('js')
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script>
    function addSubscriber(){
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'/add-subscriber',
            data:{
                "_token":"{{ csrf_token() }}",
                subscriber_email:subscriber_email
            },
            success:function(resp){
                if(resp == "exists"){
                    $("#statusSubscribe").show();
                    $("#btnSubmit").hide();
                    $("#statusSubscribe").html("Error: Subscriber Email Already Exists.");
                    $("#statusSubscribe").css({ 'background':'red', 'color':'#fff', 'border-radius':'12px', 'padding':'5px' });
                }else if(resp == "saved"){
                    $("#statusSubscribe").show();
                    $("#statusSubscribe").html("Success: Thanks for Subscribing!");
                    $("#statusSubscribe").css({ 'background':'green', 'color':'#fff', 'border-radius':'12px', 'padding':'5px' });
                }
            },
            error:function(){
                alert("Error");
            }
        });
    }

    function checkSubscriber(){
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:'post',
            url:'/check-subscriber-email',
            data:{
                "_token":"{{ csrf_token() }}",
                subscriber_email:subscriber_email
            },
            success:function(resp){
                if(resp == "exists"){
                    $("#statusSubscribe").show();
                    $("#btnSubmit").hide();
                    $("#statusSubscribe").html("Error: Subscriber Email Already Exists.");
                    $("#statusSubscribe").css({ 'background':'red', 'color':'#fff', 'border-radius':'12px', 'padding':'5px' });
                }
            },
            error:function(){
                alert("Error");
            }
        });
    }

    function enableSubscriber(){
        $("#btnSubmit").show();
        $("#statusSubscribe").hide();
    }


    window.onload = displayClock();
    function displayClock(){
        
        if(document.getElementById("time").value != null){
            var countDownDate = document.getElementById("time").value;
        }
        
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $("#d").text(days);
            $("#h").text(hours);
            $("#m").text(minutes);
            $("#s").text(seconds);
            if (distance < 0) {
                clearInterval(x);
                $("#clockdiv").hide();
                $.ajax({
                    url: "{{ route('product.flash.update') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success:function(response)
                    {
                        window.location.reload();
                    }
                })
            }
        }, 1000);
    }
    

    function addWishList(product){
        slug = product.slug

        $.ajax({
            url: "{{ route('wishlist.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': slug
            },
            success:function(response)
            {
                $("#count").text(response.count);
            },
            error: function(e) {
                if (e.status == 422) {
                    swal("Opps! Product already in cart", {
                        icon: "error"
                    });
                    setTimeout(function() {
                        swal.close();
                    },2000);
                }else{
                    
                    $('#signin-modal').modal('show');
                }
                
            }
        })
        

    }

    function addToCart(product){
        id = product.id;
        slug = product.slug;
        sale_price = product.sale_price;
        $.ajax({
            url: "{{ route('cart.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': slug,
                'id':id,
                'sale_price':sale_price,
                'data':'product_id'
            },
            success:function(response)
            {
                $("#count").text(response.count);
                $("#count1").text(response.count1);
            },
            error: function(e) {
                if (e.status == 422) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Product already in cart!'
                    });
                }else if(e.status == 404){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Product out of stock!'
                    });
                }else if(e.status == 500){
                    
                    $('#signin-modal').modal('show');
                }
                
            }
        })

    }
    
    function searchTest(){
        if($("#searchValue").val() == ''){
            $("#productValue").fadeOut();
        }else{
            $.ajax({
                url:"{{ route('search') }}",
                type:"post",
                dataType:"html",
                data:{
                    "_token":"{{ csrf_token() }}",
                    "val":$("#searchValue").val()
                },
                success:function(response){
                    $("#productValue").fadeIn();
                    $("#productValue").html(response);
                }
            })
            $(document).on('click', 'li', function(){
                $('#searchValue').val($(this).text());
                $("#productValue").fadeOut();
                window.location.href="/"+$('#searchValue').val();
            });
        }
        
    }

    function itemDelete(id){
        $.ajax({
            url: "{{ route('cart.item.delete') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success:function(response)
            {
                window.location.reload();
                swal("Successfull!", "Delete successfully.", "success");
                setTimeout(function() {
                    swal.close();
                },3000);

            }
        })
    }
    
    function load(){
        $.ajax({
            url: "{{ route('load') }}",
            type: "POST",
            dataType:"html",
            data: {
                "_token": "{{ csrf_token() }}",
                'val': 6
            },
            success:function(response)
            {
                $("#loadData").html(response);

            }
        })
    }

</script>

@endsection
@endsection
