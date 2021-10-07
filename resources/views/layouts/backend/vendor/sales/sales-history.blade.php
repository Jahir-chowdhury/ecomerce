@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-3" style="max-width:20% !important">
                        <div id="disableDiv" style="width: 100%;
                            padding: 10px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <button class="btn btn-primary" onclick="showPendingOrders()" style="padding: 10px;">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-star"
                                    style="margin-right: 5px;"></i>
                            </button>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Pending Orders
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">
                                   
                                     @php
                                        $val = 0;
                                    @endphp
                                    @foreach($odr->unique('order_id') as $order)
                                        @if($order->get_orders->status == 'Processing')
                                            @php
                                                $val += 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($val)
                                        {{ $val }}
                                    @else
                                        0/0
                                    @endif
                                </span>
                            </p>
                        </div>

                    </div>
                    <div class="col-sm-3" style="max-width:20% !important">
                        <div id="disableDiv" style="width: 100%;
                            padding: 10px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <a href="{{ route('vendor.sales.refund') }}" class="btn btn-warning" style="padding: 10px;">

                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fas fa-undo"></i>
                            </a>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Refund Orders
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">
                                    @php
                                        $val = 0;
                                    @endphp
                                    @foreach($refunds as $order)
                                        @if($order->order_id == $order->get_orders->id && $order->get_orders->status == 'refund')
                                            @php
                                                $val += 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($val)
                                        {{ $val }}
                                    @else
                                        0/0
                                    @endif
                                </span>
                            </p>
                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="row">
                <div id="pendingHistory" class="card col-12" style="border: 1px solid #ddd;display:none;">
                    <div class="card-header" style="color: #fff;
                    background-color: #007bff;
                    border-color: #007bff;
                    box-shadow: none;">
                        <h3 class="card-title"><strong>Pending Orders History</strong></h3>
                        <button style="color: #fff;" onclick="hidetbl()" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th style="width: 166px;">
                                        Transection Id
                                    </th>

                                    <th style="width: 166px;">
                                        Payment Type
                                    </th>
                                    <th style="width: 166px;">
                                        Quantity
                                    </th>
                                    <th style="width: 166px;">
                                        Customer Name
                                    </th>
                                    <th style="width: 166px;">
                                        Phone
                                    </th>
                                    <th style="width: 204px;">
                                        Address
                                    </th>
                                    <th style="width: 204px;">
                                        Total Amount
                                    </th>
                                    <th style="width: 204px;">
                                        Status
                                    </th>
                                    <th style="width: 99px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $prof = 0;
                                $amount=0;
                                @endphp
                                 @foreach ($sales->unique('order_id') as $sale)
                                    @if($sale->get_orders->status == 'Processing')
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">
                                                <span><strong>{{ $sale->get_orders->transaction_id }}</strong></span><br>
                                            </td>
                                            <td class="sorting_1">{{ $sale->get_orders->payment }}</td>
                                            <td class="sorting_1">{{ $qty }}</td>
                                            <td class="sorting_1">{{ $sale->get_orders->name }}</td>
                                            <td class="sorting_1">
                                                {{$sale->get_orders->phone}}
                                            </td>
                                            <td class="sorting_1">
                                                {{$sale->get_orders->address}}
                                            </td>
                                            @php
                                            $pro = 0;
                                            $amount += $sale->total;
                                            @endphp
                                            @foreach($details as $detail)
                                                @if($detail->order_id == $sale->get_orders->id)
                                                    @php
                                                        $pro += $detail->ven_profit;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <td class="sorting_1">
                                                {{$amount}} TK
                                                <p>Profit : <spna class="badge badge-warning">{{$pro}}</span> TK</p>
                                            </td>
                                            <td class="sorting_1">
                                                    <p style="cursor: pointer;margin: 0px;"
                                                        onclick="delivery({{ $sale->get_orders->id }})"
                                                        class="badge badge-warning">Pending</p>
                                            </td>
                                            <td class="sorting_1" style="display: inline-flex;">
                                                <button onclick="showProduct({{$sale->get_orders->id}})" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <form action="{{route('order.invoice')}}" method="POST" target="_blank">
                                                    @csrf
                                                    <input type="hidden" id="id" name="id" value="{{$sale->get_orders->id}}">
                                                    <button type="submit" class="badge badge-info btn-sm">Invoice</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card col-12" id="deliveredHistory" style="border: 1px solid #ddd;display: block">
                    <div class="card-header" style="display: inline-flex;width: 100%;">
                        <h3 class="card-title" style="width: 68%;"><strong>Delivered History is here</strong></h3>
                        <form target="_blank" method="post" action="{{ route('vendor.sales.pdf') }}" style="width: 100%;">
                            @csrf
                            <input type="hidden" name="val" id="searchVal" value="" required>
                            <button type="submit" target="_blank"class="btn btn-success btn-sm" style="margin-left: 82%;">Get Report</button>
                        </form>
                            <div class="col-md-3" style="float: right;
                                display: inline-flex;position:relative;margin-right: -9px;">
                                
                                <form action="{{route('vendor.table.search')}}" method="POST">
                                    @csrf
                                    
                                    <button type="submit" class="badge badge-info"
                                    style="
                                    position: absolute;
                                    z-index: 9999;
                                    padding: 7px;
                                    margin-top: 2px;
                                    margin-left: 74%;">
                                        Search
                                    </button>
                                    <select name="search" onchange="getValue(this.value)" id="inputVal" class="custom-select custom-select-sm form-control form-control-sm" required>
                                        <option value="" selected="selected" hidden>daily,weekly,monthly,yearly</option>
                                        <strong><option value="daily">daily</option></strong>
                                        <strong><option value="weekly">weekly</option></strong>
                                        <strong><option value="monthly">monthly</option></strong>
                                        <strong><option value="yearly">yearly</option></strong>
                                    </select>
                                </form>
                                
                            </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
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
                                        Profit
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="countRow">
                                @php
                                    $i = 0;
                                    $amount = 0;
                                @endphp
                                @foreach ($sales as $sale)
                                    @if($sale->get_orders->status == 'delivered')
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">
                                                <span><strong>{{ $sale->get_orders->transaction_id }}</strong></span><br>
                                            </td>
                                            <td class="sorting_1">{{ $sale->get_orders->payment }}</td>
                                            <td class="sorting_1">{{ $qty }}</td>
                                            <td class="sorting_1">{{ $sale->get_orders->name }}</td>
                                            <td class="sorting_1">
                                                {{$sale->get_orders->phone}}
                                            </td>
                                            <td class="sorting_1">
                                                {{$sale->get_orders->address}}
                                            </td>
                                            @php
                                            $prof = 0;
                                            $amount += $sale->total;
                                            @endphp
                                            @foreach($details as $detail)
                                                @if($detail->order_id == $sale->get_orders->id)
                                                    @php
                                                    $prof += $detail->ven_profit;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <td class="sorting_1">
                                                <p id="sales_total">{{$amount}} TK</p>
                                            </td>
                                            <td class="sorting_1">
                                                <p class="badge badge-warning" id="profit">{{$prof}} TK</p>
                                            </td>
                                            <td class="sorting_1">
                                                <span class="badge badge-success">Delivered</span>
                                                <span class="badge badge-warning">Ad.Pay {{ $sale->get_orders->admin_pay }}</span>
                                                
                                            </td>
                                            <td class="sorting_1" style="display: inline-flex;">
                                                <button onclick="showProduct({{$sale->get_orders->id}})" data-toggle="modal" data-target="#orderByProduct" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <!--<form action="#"-->
                                                <!--    method="POST">-->
                                                <!--    @csrf-->
                                                <!--    <button type="submit" class="btn btn-danger btn-sm">-->
                                                <!--        <i class="fa fa-trash"></i>-->
                                                <!--    </button>-->
                                                <!--</form>-->
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1" style="cursor: pointer;" onclick="totalAmount()">Total Sales Amount = <span class="badge badge-warning" id="sales_total1"></span> Tk</th>
                                    <th style="cursor: pointer;" onclick="totalAmount()" rowspan="1" colspan="1">Total Profit = <span class="badge badge-warning" id="total"></span> TK</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="orderByProduct" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Ordered Product Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         @include('layouts.backend.vendor.sales.order_by_vendor_product')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
<script>
    $(function() {
       $("#example1").DataTable();
       $('#example2').DataTable({
           "paging": true,
           "lengthChange": false,
           "searching": false,
           "ordering": true,
           "info": true,
           "autoWidth": false,
       });
   });

   $(function() {
       $("#example3").DataTable();
       $('#example4').DataTable({
           "paging": true,
           "lengthChange": false,
           "searching": false,
           "ordering": true,
           "info": true,
           "autoWidth": false,
       });
   });

</script>
    <script>

        window.onload = (function() {
            var sum = 0;
            var sum1 = 0;
            $('#countRow tr').each(function() {
                sum += parseFloat($(this).find('#profit').text());
                sum1 += parseFloat($(this).find('#sales_total').text());
                $("#total").text(sum);
                $("#sales_total1").text(sum1);
            });
        })
        
        function totalAmount(){
            var sum = 0;
            var sum1 = 0;
            $('#countRow tr').each(function() {
                sum += parseFloat($(this).find('#profit').text());
                sum1 += parseFloat($(this).find('#sales_total').text());
                $("#total").text(sum);
                $("#sales_total1").text(sum1);
            });
        };
        
        function getValue(value){
            $("#searchVal").val(value);
        }
        
        function pdf(){
            window.print();
        }

        function delivery(id) {
            $.ajax({
                url: "{{ route('product.delivery') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    window.location.reload();
                    swal("Successfull!", "Delivery successfull.", "success");
                    setTimeout(function() {
                        swal.close();
                    },2000);
                }
            });

        }

        function showPendingOrders() {

            $("#deliveredHistory").css({
                'display': 'none'
            });
            $("#pendingHistory").css({
                'display': 'block'
            });

        }

        function hidetbl() {
            $("#deliveredHistory").css({
                'display': 'block'
            });
            $("#pendingHistory").css({
                'display': 'none'
            });
        }
        
        
        function showProduct(id){
            $.ajax({
                url: "{{ route('orderBy.vendor.product') }}",
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
