@extends('layouts.frontend.app')

@section('content')
    <main class="main">
        <div class="page-header text-center">
            @if($category !=null)
            <img class="cat-cover" src="{{ asset('/images/' .optional($category->get_category)->cover) }}" alt="#" width="500" height="600">
            @elseif($sub_category !=null)
            <img class="cat-cover" src="{{ asset('/images/' .optional($sub_category->get_category)->cover) }}" alt="#" width="500" height="600">
            @else
            <img class="cat-cover" src="{{ asset('/images/' .optional($cat)->cover) }}" alt="#" width="500" height="600">
            @endif
            <div class="container cat-title">
                <h1 class="page-title" style="color:#fff"></h1>
            </div><!-- End .container -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        @if($sub_category)
                        <li class="breadcrumb-item"><a onclick="getAllProduct()" href="#">{{ optional($sub_category)->sub_child_name}}</a></li>
                        @elseif($sub_category !=null)
                        <li class="breadcrumb-item"><a onclick="getAllProduct()" href="#">{{ optional($category)->child_name}}</a></li>
                        @else
                        <li class="breadcrumb-item"><a onclick="getAllProduct()" href="#">{{ optional($cat)->cat_name}}</a></li>
                        @endif
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
              <div class="row">
                <div class="col-lg-9">
                  <div class="products mb-3">
                    <div class="row justify-content-center" id="allProduct">
                        @include('layouts.frontend.product_by_category')
                    </div>
                  </div>
                  <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                      <li class="page-item disabled">
                        <a
                          class="page-link page-link-prev"
                          href="#"
                          aria-label="Previous"
                          tabindex="-1"
                          aria-disabled="true"
                        >
                          <span aria-hidden="true"
                            ><i class="icon-long-arrow-left"></i></span
                          >Prev
                        </a>
                      </li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item-total">of 6</li>
                      <li class="page-item">
                        <a class="page-link page-link-next" href="#" aria-label="Next">
                          Next
                          <span aria-hidden="true"
                            ><i class="icon-long-arrow-right"></i
                          ></span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
                <!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                  <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                      <label>Filters:</label>
                    </div>
                    <!-- End .widget widget-clean -->

                    <div class="widget widget-collapsible">
                      <h3 class="widget-title">
                        <a
                          data-toggle="collapse"
                          href="#widget-1"
                          role="button"
                          aria-expanded="true"
                          aria-controls="widget-1"
                          class=""
                        >
                          Category
                        </a>
                      </h3>
                      <!-- End .widget-title -->

                      <div class="collapse show" id="widget-1" style="">
                        <div class="widget-body">
                          <div class="filter-items filter-items-count">
                            <div class="filter-item">
                              <div class="custom-control custom-checkbox" style="color:green !important;">
                                 <i class="fa fa-star"></i>
                                 @if($sub_category)
                                    <label onclick="getAllProduct()" style="cursor:pointer;font-weight:700;">{{ optional($sub_category)->sub_child_name}}</label>
                                @elseif($sub_category !=null)
                                    <label onclick="getAllProduct()" style="cursor:pointer;font-weight:700;">{{ optional($category)->child_name }}</label>
                                @else
                                    <label onclick="getAllProduct()" style="cursor:pointer;font-weight:700;">{{ optional($cat)->cat_name }}</label>
                                @endif

                              </div>
                            </div>
                            <!-- End .filter-item -->
                          </div>
                          <!-- End .filter-items -->
                        </div>
                        <!-- End .widget-body -->
                      </div>
                      <!-- End .collapse -->
                    </div>
                    <!-- End .widget -->

                    <div class="widget widget-collapsible">
                      <h3 class="widget-title">
                        <a
                          data-toggle="collapse"
                          href="#widget-4"
                          role="button"
                          aria-expanded="true"
                          aria-controls="widget-4"
                        >
                          Brand
                        </a>
                      </h3>

                      <div class="collapse show" id="widget-4">
                        <div class="widget-body">
                          <div class="filter-items">
                             @if($product)
                             @foreach ($product as $pro)
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input" id="brand-1{{optional($pro->get_brand)->brand_name}}">
                                  <label onclick="selectProperty({{optional($pro->get_brand)->id}},{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},{{ $cat ? $cat->id : "null" }},'brand_id','child_category_id','sub_child_category_id','category_id')" class="custom-control-label" for="brand-1{{optional($pro->get_brand)->brand_name}}">{{optional($pro->get_brand)->brand_name}}</label>
                                </div>
                            </div>
                            @endforeach
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="widget widget-collapsible">
                      <h3 class="widget-title">
                        <a
                          data-toggle="collapse"
                          href="#widget-2"
                          role="button"
                          aria-expanded="true"
                          aria-controls="widget-2"
                        >
                          Size
                        </a>
                      </h3>
                      <!-- End .widget-title -->

                      <div class="collapse show" id="widget-2">
                        <div class="widget-body">
                          <div class="filter-items">
                          @foreach ($productSize as $pro)
                            @foreach ($attributes->unique('size') as $size)
                            @if($pro->id == $size->product_id)
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input onclick="selectProperty({{optional($size)->id}},{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},{{ $cat ? $cat->id : "null" }},'id','child_category_id','sub_child_category_id','category_id')" type="checkbox" class="custom-control-input" id="size-1{{optional($size)->id}}">
                                    <label class="custom-control-label" for="size-1{{optional($size)->id}}">{{optional($size)->size}}</label>
                                </div>
                            </div>
                            @endif
                            @endforeach
                          @endforeach
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="widget widget-collapsible">
                      <h3 class="widget-title">
                        <a
                          data-toggle="collapse"
                          href="#widget-3"
                          role="button"
                          aria-expanded="true"
                          aria-controls="widget-3"
                        >
                          Colour
                        </a>
                      </h3>

                      <div class="collapse show" id="widget-3">
                        <div class="widget-body" style="display: inline-flex;">
                          <div class="filter-colors">
                            @foreach ($products->unique('color') as $color)
                              <a href="#" onclick="selectProperty(`{{optional($color)->color}}`,{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},{{ $cat ? $cat->id : "null" }},'color','child_category_id','sub_child_category_id','category_id')" style="background: {{optional($color)->color}};border: 2px solid #ddd;">
                                <span class="sr-only">{{optional($color)->color}}</span>
                              </a>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="widget widget-collapsible">
                      <h3 class="widget-title">
                        <a
                          data-toggle="collapse"
                          href="#widget-5"
                          role="button"
                          aria-expanded="true"
                          aria-controls="widget-5"
                        >
                          Price
                        </a>
                      </h3>

                      <div class="collapse show" id="widget-5">
                        <div class="widget-body">
                          <div class="filter-price">
                            <div class="filter-price-text">
                              Price Range:
                            </div>

                            <div class="slidecontainer">
                                <input style="width:100% !important;" onchange="Price('0','',{{ $category ? $category->id : "null" }},{{ $sub_category ? $sub_category->id : "null" }},{{ $cat ? $cat->id : "null" }},'child_category_id','sub_child_category_id','category_id')" id="inputPrice" type="range" min="1" max="100000" value="0">
                                <p>Price : TK 0 - <span id="maxValue"></span> TK</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </aside>
              </div>
            </div>
        </div><!-- End .page-content -->
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
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

    function getAllProduct(){
        window.location.reload();
    }

    function selectProperty(data,data1,data2,data3,col_name,col_name1,col_name2,col_name3){
        $.ajax({
            url: "{{ route('search.product') }}",
            method: "POST",
            data: {
                "_token": $("#_token").val(),
                'data':data,
                'data1':data1,
                'data2':data2,
                'data3':data3,
                'col_name':col_name,
                'col_name1':col_name1,
                'col_name2':col_name2,
                'col_name3':col_name3,
                'col_name4':null
            },
            dataType: 'html',
            success: function(response) {
                $("#allProduct").html(response);
            },
        })
    }

    function Price(min,max,data1,data2,data3,col_name1,col_name2,col_name3){
        $("#maxValue").text($("#inputPrice").val());
        $.ajax({
            url: "{{ route('search.product') }}",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                'min':min,
                'max':max ? max : $("#inputPrice").val(),
                'data1':data1,
                'data2':data2,
                'data3':data3,
                'col_name1':col_name1,
                'col_name2':col_name2,
                 'col_name3':col_name3,
                'col_name4':'price'
            },
            dataType: 'html',
            success: function(response) {
                $("#allProduct").html(response);
            },
        })
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
                    },3000);
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
