@extends('layouts.frontend.app')

@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            @php
                $name = '';
            @endphp
             @foreach ($products as $product)
            @php
                $name = $product->get_vendor->brand_name;
            @endphp
        @endforeach
        <h1 class="page-title">{{$name}}<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('home')}}">Shop</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="products mb-2">
                        <div class="row justify-content-center">
                            @foreach ($products as $product)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <div class="product product-7 text-center">
                                    @foreach ($product->get_vendor_product_avatar as $avtr)
                                    <figure class="product-media">
                                        <a href="{{route('product.quick',$product->slug)}}">
                                            <img style="width: 203px !important;
                                            height: 203px !important;" src="{{ asset('/images/' . $avtr->front) }}" alt="Product image"
                                                class="product-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <button onclick="addWishList({{$product}})" class="btn-product-icon btn-wishlist btn-expandable"><span>add
                                                    to wishlist</span></button>
                                        </div>

                                        <div class="product-action">
                                            <button onclick="addToCart({{$product}})" class="btn-product btn-cart"><span>add to cart</span></button>
                                        </div>
                                    </figure>
                                    @endforeach
                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.html">{{$product->product_name}}
                                                </a></h3>
                                        <div class="product-price">
                                            @foreach ($product->get_product_attribute->unique('vendor_product_id') as $attr)
                                                <span class="new-price">{{$attr->sale_price}} TK</span>
                                                <span class="old-price"><del>{{$attr->promo_price}} TK</del></span>
                                            @endforeach
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@section('js')
<script>
    window.onload=(function(){
        $("#showCategory").hide();
    });

    function showDropdown(){
        $("#showCategory").show();
    }
    function addWishList(product) {
        slug = product.slug

        $.ajax({
            url: "{{ route('wishlist.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': slug
            },
            success: function(response) {
                $("#count").text(response.count);
            },
            error: function(e) {
                if (e.status == 422) {
                    swal("Opps! Product already in cart", {
                        icon: "error"
                    });
                    setTimeout(function() {
                        swal.close();
                    },3000);
                }else{
                    $('#signin-modal').modal('show');
                }
                
            }
        })

    }

    function addToCart(product) {
        id = product.id;
        slug = product.slug;
        $.ajax({
            url: "{{ route('cart.store') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'slug': slug,
                'id': id,
                'data':'vendor_product_id'
            },
            success: function(response) {
                $("#count").text(response.count);
                $("#count1").text(response.count1);
            },
            error: function(e) {
                if (e.status == 422) {
                    swal("Opps! Product already in cart", {
                        icon: "error"
                    });
                    setTimeout(function() {
                        swal.close();
                    },3000);
                }else if(e.status == 404){
                    swal("Opps! Product out of stock.", {
                        icon: "error"
                    });
                    setTimeout(function() {
                        swal.close();
                    },3000);
                }else{
                    $('#signin-modal').modal('show');
                }
                
            }
        })

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
</script>
@endsection
@endsection