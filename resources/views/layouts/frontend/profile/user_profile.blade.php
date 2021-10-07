@extends('layouts.frontend.app')

@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title" style="text-transform: capitalize;">{{auth()->user()->name ?? ''}} Account<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{auth()->user()->name ?? ''}} Account</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-3 col-lg-2">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                        href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                        aria-selected="true">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab"
                                        aria-controls="tab-orders" aria-selected="false">Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                        role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-md-9 col-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
                                    aria-labelledby="tab-dashboard-link">
                                    <h6>Recent Orders</h6>
                                    <h6 style="margin-top: -31px;" class="pull-right">Total E-Money : <span class="badge badge-success">{{auth()->user()->e_money ?? ''}}</span></h6>
                                    <hr>
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Transection Id
                                                </th>
            
                                                <th>
                                                    Payment Type
                                                </th>
                                                <th>
                                                    Quantity
                                                </th>
                                                <th>
                                                    Customer Name
                                                </th>
                                                <th>
                                                    Phone
                                                </th>
                                                <th>
                                                    Address
                                                </th>
                                                <th>
                                                    Total Amount
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th style="width: 10%;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                @if($sale->get_orders->status == 'Processing')
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">
                                                            <span><strong>{{ $sale->get_orders->transaction_id }}</strong></span><br>
                                                        </td>
                                                        <td class="sorting_1">{{ $sale->get_orders->payment }}</td>
                                                        <td class="sorting_1">{{ $sale->get_orders->qty }}</td>
                                                        <td class="sorting_1">{{ $sale->get_orders->name }}</td>
                                                        <td class="sorting_1">
                                                            {{$sale->get_orders->phone}}
                                                        </td>
                                                        <td class="sorting_1">
                                                            {{$sale->get_orders->address}}
                                                        </td>
                                                        <td class="sorting_1">
                                                            {{$sale->get_orders->amount}} TK
                                                        </td>
                                                        <td class="sorting_1">
                                                            <p class="badge badge-warning">Pending</p>
                                                        </td>
                                                        <td class="sorting_1" style="display: inline-flex;">
                                                            <p onclick="showProduct({{$sale->get_orders->id}})" style="margin-right: 5px;cursor:pointer;margin-top: 10px;
                                                                margin-bottom: 0px;" class="badge badge-warning">
                                                                <i class="fa fa-eye"></i>
                                                            </p>
                                                            @if($sale->get_orders->payment == 'cash on delivery')
                                                            <p onclick="refund({{$sale->get_orders->id}})" style="margin-right: 5px;cursor:pointer;margin-top: 10px;
                                                                margin-bottom: 0px;" class="badge badge-danger">
                                                                <i class="fa fa-undo"></i>
                                                            </p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                    aria-labelledby="tab-orders-link">
                                    <table class="table table-cart table-mobile">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Transection Id
                                                </th>
            
                                                <th>
                                                    Payment Type
                                                </th>
                                                <th>
                                                    Quantity
                                                </th>
                                                <th>
                                                    Customer Name
                                                </th>
                                                <th>
                                                    Phone
                                                </th>
                                                <th>
                                                    Address
                                                </th>
                                                <th>
                                                    Total Amount
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th style="width: 10%;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sales as $sale)
                                                @if($sale->get_orders->status == 'delivered')
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">
                                                            <span><strong>{{ $sale->get_orders->transaction_id }}</strong></span><br>
                                                        </td>
                                                        <td class="sorting_1">{{ $sale->get_orders->payment }}</td>
                                                        <td class="sorting_1">{{ $sale->get_orders->qty }}</td>
                                                        <td class="sorting_1">{{ $sale->get_orders->name }}</td>
                                                        <td class="sorting_1">
                                                            {{$sale->get_orders->phone}}
                                                        </td>
                                                        <td class="sorting_1">
                                                            {{$sale->get_orders->address}}
                                                        </td>
                                                        <td class="sorting_1">
                                                            {{$sale->get_orders->amount}} TK
                                                        </td>
                                                        <td class="sorting_1">
                                                            <p class="badge badge-success">Delivered</p>
                                                        </td>
                                                        <td class="sorting_1" style="display: inline-flex;">
                                                            <p onclick="showProduct({{$sale->get_orders->id}})" style="margin-right: 5px;cursor:pointer;margin-top: 10px;
                                                                margin-bottom: 0px;" class="badge badge-warning">
                                                                <i class="fa fa-eye"></i>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-downloads" role="tabpanel"
                                    aria-labelledby="tab-downloads-link">
                                    <p>No downloads available yet.</p>
                                    <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i
                                            class="icon-long-arrow-right"></i></a>
                                </div><!-- .End .tab-pane -->


                                <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                    aria-labelledby="tab-account-link">
                                    <form action="{{route('update.user')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="userId" value="{{auth()->user()->id ?? ''}}"/>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Name *</label>
                                                <input type="text" name="name" value="{{auth()->user()->name ?? ''}}" class="form-control" required="">
                                            </div><!-- End .col-sm-6 -->
                                            <div class="col-sm-6">
                                                <label>Email address *</label>
                                                <input type="email" name="email" value="{{auth()->user()->email ?? ''}}" class="form-control" required="">
                                            </div><!-- End .col-sm-6 -->
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Phone number *</label>
                                                <input type="text" name="phn" value="{{auth()->user()->phn ?? ''}}" class="form-control" required="">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Current password (leave blank to leave unchanged)</label>
                                                <input type="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                 <label>New password (leave blank to leave unchanged)</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Address *</label>
                                                <textarea type="text" class="form-control" name="address" required="">{{auth()->user()->address ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" id="orderByProduct" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Ordered Product Info</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="padding-left: 20px !important;
                                                padding-right: 20px !important;margin-bottom: 15px;">
                                                 @include('layouts.frontend.profile.view_product_by_order')
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
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

            function refund(id){
                    $.ajax({
                        url: "{{ route('product.refund') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response) {
                            window.location.reload();
                            swal("Successfull", "Refund successfull.", "success");
                            setTimeout(function() {
                                swal.close();
                            },2000);
                        }
                    });
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
            
            function showProduct(id){
                $.ajax({
                    url: "{{ route('view.product.order') }}",
                    type: "POST",
                    dataType:"html",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(response) {
                        $("#getProduct").html(response);
                        $("#orderByProduct").modal('show');
                    }
                });
            }
        </script>
    @endsection
@endsection
