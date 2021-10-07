@extends('layouts.frontend.app')

@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            @php
                $name = '';
            @endphp
             @foreach ($single_vendor as $product)
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
                            @foreach ($single_vendor as $ven)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-2">
                                <div class="product product-7 text-center">
                                    <figure class="product-media">
                                        <a href="{{route('vendor.all.products',$ven->brand_name)}}">
                                            <img style="width: 178px !important;
                                            height: 120px !important;" src="{{ asset('/images/' . $ven->logo) }}" alt="Product image"
                                                class="product-image">
                                        </a>
                                    </figure><!-- End .product-media -->
                                    <div class="product-body">
                                        <h3 class="product-title"><a href="{{route('vendor.all.products',$ven->brand_name)}}"">{{$ven->brand_name}}
                                                </a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            {{$ven->address}}
                                        </div><!-- End .product-price -->  
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .products -->

                </div><!-- End .col-lg-9 -->
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