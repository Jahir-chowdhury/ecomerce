@extends('layouts.frontend.app')

@section('content')

    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">With Sidebar</li>
                </ol>

                <nav class="product-pager ml-auto" aria-label="Product">
                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                        <i class="icon-angle-left"></i>
                        <span>Prev</span>
                    </a>

                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                        <span>Next</span>
                        <i class="icon-angle-right"></i>
                    </a>
                </nav><!-- End .pager-nav -->
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-details-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-gallery">
                                        @foreach ($product->get_vendor_product_avatar as $avatar)
                                        <figure class="product-main-image">
                                            <span class="product-label label-top">Top</span>
                                            <img style="height: 426px !important;" id="product-zoom" src="{{ asset('/images/' . $avatar->front) }}"
                                                data-zoom-image="{{ asset('/images/' . $avatar->front) }}"
                                                alt="product image">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure><!-- End .product-main-image -->

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            <a class="product-gallery-item active" href="#"
                                                data-image="{{ asset('/images/' . $avatar->front) }}"
                                                data-zoom-image="{{ asset('/images/' . $avatar->front) }}">
                                                <img src="{{ asset('/images/' . $avatar->front) }}" alt="product side">
                                            </a>
                                            
                                            @if($avatar->back)
                                            <a class="product-gallery-item" href="#"
                                                data-image="{{ asset('/images/' . $avatar->back) }}"
                                                data-zoom-image="{{ asset('/images/' . $avatar->back) }}">
                                                <img src="{{ asset('/images/' . $avatar->back) }}" alt="product cross">
                                            </a>
                                            @endif
                                            
                                            @if($avatar->left)
                                            <a class="product-gallery-item" href="#"
                                                data-image="{{ asset('/images/' . $avatar->left) }}"
                                                data-zoom-image="{{ asset('/images/' . $avatar->left) }}">
                                                <img src="{{ asset('/images/' . $avatar->left) }}" alt="product with model">
                                            </a>
                                            @endif
                                            
                                            @if($avatar->right)
                                            <a class="product-gallery-item" href="#"
                                                data-image="{{ asset('/images/' . $avatar->right) }}"
                                                data-zoom-image="{{ asset('/images/' . $avatar->right) }}">
                                                <img src="{{ asset('/images/' . $avatar->right) }}" alt="product back">
                                            </a>
                                            @endif
                                        </div><!-- End .product-image-gallery -->
                                        @endforeach
                                    </div><!-- End .product-gallery -->
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <div class="product-details product-details-sidebar">
                                        <h1 class="product-title">{{ $product->product_name }}</h1>

                                        <div class="product-price">
                                            <span class="new-price" id="pro_price">{{ $product->get_product_attribute[0]->sale_price }} TK</span>
                                            <span class="old-price"><del>{{ $product->get_product_attribute[0]->promo_price }} TK</del></span>
                                        </div>

                                        <div class="product-content">
                                            <p>{{ $product->description }}</p>
                                        </div>

                                        <div class="details-filter-row details-row-size">
                                            <label>Color:</label>

                                            <div class="product-nav product-nav-dots">
                                                <a href="#" class="active" style="background: {{ $product->color }};"><span
                                                        class="sr-only">Color name</span></a>
                                            </div>
                                        </div>

                                        <div class="details-filter-row details-row-size">
                                            <label for="size">Size:</label>
                                            <div class="select-custom">
                                                <select onchange="priceBySize(this.value,{{ $product->id }})" name="size" id="size" class="form-control">
                                                    <option value="" selected="selected"
                                                        hidden>select size
                                                    </option>
                                                    @foreach ($product->get_product_attribute->unique('vendor_product_id') as $attr)
                                                        <option value="{{ $attr->size }}">{{ $attr->size }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="product-details-action">
                                            <div class="details-action-col">
                                                <label for="qty">Qty:</label>
                                                <div class="product-details-quantity">
                                                    <input type="number" id="qty" class="form-control" value="1" min="1"
                                                        max="10" step="1" data-decimals="0" required=""
                                                        style="display: none;">
                                                    <div class="input-group  input-spinner">
                                                        <div class="input-group-prepend"><button style="min-width: 26px"
                                                                class="btn btn-decrement btn-spinner" type="button"><i
                                                                    class="icon-minus"></i></button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="display: inline-flex;" class="details-action-wrapper">
                                                <button class="btn-product btn-wishlist" onclick="addWishList({{ $product }})" title="
                                                    Wishlist"><span>Add to Wishlist</span>
                                                </button>
                                                <button onclick="addToCart({{ $product }})"
                                                    class="btn-product btn-cart"><span>add to cart</span>
                                                </button>
                                            </div><!-- End .details-action-wrapper -->
                                        </div><!-- End .product-details-action -->
                                    </div><!-- End .product-details -->
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .product-details-top -->

                        <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->



                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow owl-loaded owl-drag"
                            data-toggle="owl" data-owl-options="{
                                &quot;nav&quot;: false, 
                                &quot;dots&quot;: true,
                                &quot;margin&quot;: 20,
                                &quot;loop&quot;: false,
                                &quot;responsive&quot;: {
                                    &quot;0&quot;: {
                                        &quot;items&quot;:1
                                    },
                                    &quot;480&quot;: {
                                        &quot;items&quot;:2
                                    },
                                    &quot;768&quot;: {
                                        &quot;items&quot;:3
                                    },
                                    &quot;992&quot;: {
                                        &quot;items&quot;:4
                                    },
                                    &quot;1200&quot;: {
                                        &quot;items&quot;:4,
                                        &quot;nav&quot;: true,
                                        &quot;dots&quot;: false
                                    }
                                }
                            }">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 891px;">
                                    @foreach ($products as $pro)
                                    @if ($pro->vendor_id == $product->vendor_id && $product->id != $pro->id)
                                    <div class="owl-item active" style="width: 202.75px; margin-right: 20px;">
                                        <div class="product product-7 text-center">
                                            @foreach ($pro->get_vendor_product_avatar as $avtr)
                                            <figure class="product-media">
                                                <span class="product-label label-new">New</span>
                                                <a href="{{route('product.quick',$pro->slug)}}">
                                                    <img style="height: 203px !important;width:203px !important;" src="{{ asset('/images/' . $avtr->front) }}" alt="Product image"
                                                        class="product-image">
                                                </a>

                                                <div class="product-action-vertical">
                                                    <button onclick="addWishList({{ $pro }})"
                                                        class="btn-product-icon btn-wishlist btn-expandable"><span>add to
                                                            wishlist</span>
                                                    </button>
                                                </div>

                                                <div class="product-action">
                                                    <button onclick="addToCart({{ $pro }})" class="btn-product btn-cart"><span>add to cart</span></button>
                                                </div>
                                            </figure>
                                            @endforeach
                                            <div class="product-body">
                                                <h3 class="product-title">
                                                    <a href="#">
                                                        {{$pro->product_name}}
                                                    </a>
                                                </h3>
                                                <div class="product-price">
                                                    {{$pro->sale_price}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="owl-nav disabled"><button type="button" role="presentation"
                                    class="owl-prev disabled"><i class="icon-angle-left"></i></button><button type="button"
                                    role="presentation" class="owl-next disabled"><i class="icon-angle-right"></i></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                        </div><!-- End .owl-carousel -->




                    </div><!-- End .col-lg-9 -->

                    <aside class="col-lg-3">
                        <div class="sidebar sidebar-product">
                            <div class="widget widget-products">
                                <h4 class="widget-title">Related Product</h4><!-- End .widget-title -->
                                <div class="products">
                                    @foreach ($products as $pro)
                                    @if ($pro->vendor_id == $product->vendor_id && $product->id != $pro->id)
                                    <div class="product product-sm">
                                        @foreach ($pro->get_vendor_product_avatar as $avtr)
                                        <figure class="product-media">
                                            <a href="{{route('product.quick',$pro->slug)}}">
                                                <img src="{{ asset('/images/' . $avtr->front) }}" alt="Product image"
                                                    class="product-image">
                                            </a>
                                        </figure>
                                        @endforeach
                                        <div class="product-body">
                                            <h5 class="product-title"><a href="{{route('product.quick',$pro->slug)}}">{{$pro->product_name}}</a></h5><!-- End .product-title -->
                                            <div class="product-price">
                                                <span class="new-price">{{$pro->sale_price}}</span>
                                                <span class="old-price">{{$pro->promo_price}}</span>
                                            </div><!-- End .product-price -->
                                        </div><!-- End .product-body -->
                                    </div><!-- End .product product-sm -->
                                    @endif
                                    @endforeach
                                </div><!-- End .products -->
                            </div><!-- End .widget widget-products -->
                        </div><!-- End .sidebar sidebar-product -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->

            </div><!-- End .container -->
        </div><!-- End .page-content -->
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

        function itemDelete(id) {
            $.ajax({
                url: "{{ route('cart.item.delete') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                success: function(response) {
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


        function priceBySize(val,id){
            $.ajax({
                url: "{{ route('price.by.product.size') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                    'val':val
                },
                success: function(response) {
                    $("#pro_price").text(response.price.sale_price+' TK');
                }
            })
        }

    </script>
@endsection
@endsection
