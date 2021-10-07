@extends('layouts.backend.app')

@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            @if($data->role == 'super_admin')
            <div class="col-sm-2">
                <div id="disableDiv" style="width: 100%;
                    padding: 5px;
                    background-color: white;
                    border: 1px solid #ddd;
                    box-shadow: 1px 1px #ddd;
                    border-radius: 5px;display: inline-flex;">
                    <a href="{{route('user.role')}}" style="padding: 10px;" class="btn btn-primary">
                        <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                        style="margin-right: 5px;"></i>
                    </a>
                    <p style="margin-left: 5px;
                    font-weight: 700;
                    margin-bottom: 0px;">Add Role
                        <span style="float: left;
                    margin-left: 15px;" class="badge badge-warning">0/0</span>
                    </p>
                </div>
            </div>
           @endif
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
         
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>
                  @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                    {{ $order }}
                  @else
                    {{ $ven_new_order }}
                  @endif
              </h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            @if(auth()->user()->role == 'vendor')
            <a href="{{url('vendor-sales-history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <a href="{{route('sales.history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           @endif
          </div>
        </div>
        
        @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $admin_profit ? $admin_profit : 00 }}</h3>

              <p>Profit From Vendor</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-check"></i></a>
          </div>
        </div>
         @endif
        <!-- ./col -->
        @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$user}}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('user.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endif
        
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
                @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                    
                    <h3>{{$profit}} Tk</h3>
                  @else
                    
                    <h3>{{$ven_profit}} Tk</h3>
                  @endif
              <p>Total Profit</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-check"></i></a>
          </div>
        </div>
        <!-- ./col -->
        @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
        <div class="col-lg-12 col-12">
          <div id="pendingHistory" class="card" style="border: 1px solid #ddd;">
            <div class="card-header" style="color: #fff;
                background-color: #ab8a00;
                border-color: #007bff;">
                <h3 class="card-title"><strong>Vendor Order Unpaid list</strong></h3>
                <button style="color: #fff;" onclick="hidetbl()" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr role="row">
                            <th style="width: 166px;">
                                Vendor Name
                            </th>
                            <th style="width: 166px;">
                                Brand Name
                            </th>

                            <th style="width: 166px;">
                                Delivery Status
                            </th>
                            <th style="width: 166px;">
                                Total Order
                            </th>
                            <th style="width: 166px;">
                                Total Profit
                            </th>
                            <th style="width: 166px;">
                                Total Amount
                            </th>
                            <th style="width: 204px;">
                                Payment Status
                            </th>
                            <!--<th style="width: 99px;">-->
                            <!--    Action-->
                            <!--</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor_orders->unique('vendor_id') as $order)
                        @foreach($users->where('id',$order->vendor_id) as $user)
                        @if($order->get_orders->status == 'Processing' || $order->get_orders->status == 'delivered' && $order->get_orders->admin_pay == 'Unpaid')
                        <tr role="row" class="odd">
                            <td class="sorting_1">
                                {{optional($user)->name}}
                            </td>
                            <td class="sorting_1">
                                @foreach($all_vendor->where('user_id',$user->id) as $vendor)
                                 {{optional($vendor)->brand_name}}
                                 @if($vendor->multi_vendor == 0)
                                    <span class="badge badge-info">Single Vendor<span/>
                                @else 
                                    <span class="badge badge-success">Group Vendor<span/>
                                @endif
                                @endforeach
                            </td>
                            <td class="sorting_1">
                                @if($order->get_orders->status == 'Processing')
                                <span class="badge badge-warning">{{optional($order->get_orders)->status}}<span/>
                                @else 
                                <span class="badge badge-success">{{optional($order->get_orders)->status}}<span/>
                                @endif
                            </td>
                            <td class="sorting_1">
                                {{optional($vendor_orders)->where('vendor_id',$user->id)->unique('order_id')->count()}}
                            </td>
                            <td class="sorting_1">
                                {{optional($vendor_orders)->where('vendor_id',$user->id)->sum('admin_profit')}}
                            </td>
                            <td class="sorting_1">
                                {{optional($vendor_orders)->where('vendor_id',$user->id)->sum('total') - optional($vendor_orders)->where('vendor_id',$user->id)->sum('admin_profit')}}
                            </td>
                            <td class="sorting_1">
                                @if($order->get_orders->admin_pay == 'Unpaid')
                                <span onclick="paid({{$order->order_id}})" style="cursor:pointer;" class="badge badge-info">{{optional($order->get_orders)->admin_pay}}</span>
                                @else 
                                <span class="badge badge-success">{{optional($order->get_orders)->admin_pay}}<span/>
                                @endif
                                
                            </td>
                            <!--<td class="sorting_1">-->
                            <!--    <button data-toggle="modal" data-target="#orderByProduct" style="margin-right: 5px;" class="btn btn-primary btn-sm">-->
                            <!--        <i class="fa fa-eye"></i>-->
                            <!--    </button>-->
                            <!--</td>-->
                        <tr/>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-12">
          <div class="card" style="border: 1px solid #ddd;">
            <div class="card-header" style="color: #fff;
                background-color: #ab8a00;
                border-color: #007bff;">
                <h3 class="card-title"><strong>Vendor Order Paid list</strong></h3>
                <button style="color: #fff;" onclick="hidetbl()" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr role="row">
                            <th style="width: 166px;">
                                Vendor Name
                            </th>
                            <th style="width: 166px;">
                                Brand Name
                            </th>

                            <th style="width: 166px;">
                                Delivery Status
                            </th>
                            <th style="width: 166px;">
                                Total Order
                            </th>
                            <th style="width: 166px;">
                                Total Profit
                            </th>
                            <th style="width: 166px;">
                                Total Amount
                            </th>
                            <th style="width: 204px;">
                                Payment Status
                            </th>
                            <!--<th style="width: 99px;">-->
                            <!--    Action-->
                            <!--</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor_orders->unique('vendor_id') as $order)
                        @foreach($users->where('id',$order->vendor_id) as $user)
                        @if($order->get_orders->status == 'delivered' && $order->get_orders->admin_pay == 'Paid')
                        <tr role="row" class="odd">
                            <td class="sorting_1">
                                {{optional($user)->name}}
                            </td>
                            <td class="sorting_1">
                                @foreach($all_vendor->where('user_id',$user->id) as $vendor)
                                 {{optional($vendor)->brand_name}}
                                 @if($vendor->multi_vendor == 0)
                                    <span class="badge badge-info">Single Vendor<span/>
                                @else 
                                    <span class="badge badge-success">Group Vendor<span/>
                                @endif
                                @endforeach
                            </td>
                            <td class="sorting_1">
                                @if($order->get_orders->status == 'Processing')
                                <span class="badge badge-warning">{{optional($order->get_orders)->status}}<span/>
                                @else 
                                <span class="badge badge-success">{{optional($order->get_orders)->status}}<span/>
                                @endif
                            </td>
                            <td class="sorting_1">
                                {{optional($vendor_orders)->where('vendor_id',$user->id)->unique('order_id')->count()}}
                            </td>
                            <td class="sorting_1">
                                {{optional($vendor_orders)->where('vendor_id',$user->id)->sum('admin_profit')}}
                            </td>
                            <td class="sorting_1">
                                {{optional($vendor_orders)->where('vendor_id',$user->id)->sum('total') - optional($vendor_orders)->where('vendor_id',$user->id)->sum('admin_profit')}}
                            </td>
                            <td class="sorting_1">
                                @if($order->get_orders->status == 'Unpaid')
                                <span onclick="paid({{$order->order_id}})" style="cursor:pointer;" class="badge badge-info">{{optional($order->get_orders)->admin_pay}}</span>
                                @else 
                                <span class="badge badge-success">{{optional($order->get_orders)->admin_pay}}<span/>
                                @endif
                                
                            </td>
                            <!--<td class="sorting_1">-->
                            <!--    <button data-toggle="modal" data-target="#orderByProduct" style="margin-right: 5px;" class="btn btn-primary btn-sm">-->
                            <!--        <i class="fa fa-eye"></i>-->
                            <!--    </button>-->
                            <!--</td>-->
                        <tr/>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
        @endif
      </div>
    </section>
    <!-- /.content -->
  </div>
  @section('js')
    <script>
        function paid(id){
             $.ajax({
                url: "{{ route('order.payment') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    window.location.reload();
                    swal("Successfull!", "Paid successfull.", "success");
                    setTimeout(function() {
                        swal.close();
                    },2000);
                }
            });
        }
    </script>
  @endsection

@endsection

