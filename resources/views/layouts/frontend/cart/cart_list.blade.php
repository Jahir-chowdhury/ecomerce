@extends('layouts.frontend.app')

@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title"><strong style="text-transform: capitalize">{{ auth()->user()->name ?? '' }}</strong> Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" id="cart" value="{{ $cart }}">
                                    @foreach ($cart as $crt)
                                        @if ($crt->get_product)
                                        <tr>
                                            <td class="product-col">
                                            {{-- <input hidden type="number" id="id" value="{{$crt->id}}" name="id">
                                            <input hidden type="text" id="sale_price" value="{{$crt->get_product->sale_price}}" name="$crt->get_product->sale_price"> --}}
                                                <div class="product">
                                                    @foreach ($crt->get_product->get_product_avatars as $avtr)
                                                        <figure class="product-media">
                                                            <a href="#">
                                                                <img src="{{ asset('/images/' . $avtr->front) }}"
                                                                    alt="Product image">
                                                            </a>
                                                        </figure>
                                                    @endforeach
                                                    <h3 class="product-title">
                                                        <a href="#">{{ $crt->get_product->product_name }}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            @foreach ($crt->get_product->get_attribute->unique('product_id') as $attr)
                                                @if ($attr->product_id == $crt->product_id)
                                                    <td id="sale_price" class="price-col">{{ $attr->sale_price }}</td>
                                                    
                                                @endif
                                            @endforeach
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input onchange="calculate({{$crt}},this.value)" id="qty" name="qty"
                                                    type="number" value="{{ $crt->qty }}" class="form-control" required>

                                                </div>
                                            </td>
                                            <td id="total" class="total-col">{{$crt ? $crt->total : $crt->get_product->sale_price }}</td>
                                            <td class="remove-col">
                                                <button onclick="itemDelete({{$crt->id}})" class="btn-remove"><i
                                                        class="icon-close"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($cart as $crt)
                                    @if ($crt->get_vendor_product)
                                    <tr>
                                        <td class="product-col">
                                        {{-- <input hidden type="number" id="id" value="{{$crt->id}}" name="id">
                                        <input hidden type="text" id="sale_price" value="{{$crt->get_product->sale_price}}" name="$crt->get_product->sale_price"> --}}
                                            <div class="product">
                                                @foreach ($crt->get_vendor_product->get_vendor_product_avatar as $avtr)
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="{{ asset('/images/' . $avtr->front) }}"
                                                                alt="Product image">
                                                        </a>
                                                    </figure>
                                                @endforeach
                                                <h3 class="product-title">
                                                    <a href="#">{{ $crt->get_vendor_product->product_name }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td id="sale_price" class="price-col">{{ $crt->get_vendor_product->sale_price }}</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input onchange="calculate({{$crt}},this.value)" id="qty" name="qty"
                                                type="number" value="{{ $crt->qty }}" class="form-control" required>

                                            </div>
                                        </td>
                                        <td id="total" class="total-col">{{$crt ? $crt->total : $crt->get_vendor_product->sale_price }}</td>
                                        <td class="remove-col">
                                            <button onclick="itemDelete({{$crt->id}})" class="btn-remove"><i
                                                    class="icon-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table><!-- End .table table-wishlist -->

                            <div class="cart-bottom">

                                <a href="{{ route('cart.bill') }}" class="btn btn-outline-dark-2"><span>Checkout Now</span>
                                    <i class="icon-refresh"></i>
                                </a>
                            </div><!-- End .cart-bottom -->
                        </div>
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
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
        function calculate(crt,val){
            
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': crt.id,
                    'qty': val
                },
                success:function(response)
                {
                    window.location.reload();
                }
            })
        }

        function checkout(){
            id = $("id").val();
            qty = $("qty").val();
            total = $("total").text();
            console.log($("id").val());
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
                    $("#count1").text(response.count1);
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
