@extends('layouts.frontend.app')

@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 order-md-2">
                            <h4 class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill">{{$count1}}</span>
                            </h4>
                            <ul class="list-group mb-3" style="margin-top: 10px;">
                                @php
                                    $cost = 0;
                                    $shipp_cost = 0;
                                    $e_money = 0;
                                    $indoor = '';
                                    $neet_cost = 0;
                                @endphp
                                @foreach ($cart as $crt)
                                @if ($crt->get_product)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{$crt->get_product->product_name}}</h6>
                                        <small class="text-muted">{{$crt->get_product->color}}/{{$crt->size}}</small>
                                    </div>
                                    <div>
                                        <h6 class="my-0">= {{$crt->total}} TK</h6>
                                        @if ($crt->shipp_des == NULL)
                                            <small class="text-muted">Ship.Co.= 0.00 TK</small> 
                                        @else 
                                            @if ($crt->get_product->indoor_charge == null || $crt->get_product->outdoor_charge == null)
                                                <small style="margin-left: 22px;" class="text-muted">Free Shipping</small>
                                            @elseif($crt->shipp_des == 'indoor')

                                                @if ($crt->qty >3 && $crt->qty <=6)
                                                    <small class="text-muted">Ship.Co.= 2 x {{$crt->get_product->indoor_charge}} TK</small>
                                                @elseif($crt->qty >6 && $crt->qty <=9)
                                                    <small class="text-muted">Ship.Co.= 3 x {{$crt->get_product->indoor_charge}} TK</small>
                                                @elseif($crt->qty >9 && $crt->qty <=10)
                                                    <small class="text-muted">Ship.Co.= 4 x {{$crt->get_product->indoor_charge}} TK</small>
                                                @else
                                                    <small class="text-muted">Ship.Co.= {{$crt->get_product->indoor_charge}} TK</small>
                                                @endif
                                            @elseif($crt->shipp_des == 'outdoor')
                                                @if ($crt->qty >3 && $crt->qty <=6)
                                                    <small class="text-muted">Ship.Co.= 2 x {{$crt->get_product->outdoor_charge}} TK</small>
                                                @elseif($crt->qty >6 && $crt->qty <=9)
                                                    <small class="text-muted">Ship.Co.= 3 x {{$crt->get_product->outdoor_charge}} TK</small>
                                                @elseif($crt->qty >9 && $crt->qty <=10)
                                                    <small class="text-muted">Ship.Co.= 4 x {{$crt->get_product->outdoor_charge}} TK</small>
                                                @else
                                                    <small class="text-muted">Ship.Co.= {{$crt->get_product->outdoor_charge}} TK</small>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </li>
                                @php
                                    if ($crt->shipp_des == 'indoor') {
                                        if ($crt->qty >3 && $crt->qty <=6) {
                                            $shipp_cost = 2*$crt->get_product->indoor_charge;
                                            $cost += 2*$crt->get_product->indoor_charge;
                                        }elseif($crt->qty >6 && $crt->qty <=9){
                                            $shipp_cost = 3*$crt->get_product->indoor_charge;
                                            $cost += 3*$crt->get_product->indoor_charge;
                                        }elseif ($crt->qty >9 && $crt->qty <=10) {
                                            $shipp_cost = 4*$crt->get_product->indoor_charge;
                                            $cost += 4*$crt->get_product->indoor_charge;
                                        }else{
                                            $shipp_cost = $crt->get_product->indoor_charge;
                                            $cost += $crt->get_product->indoor_charge;
                                        }
                                    }else if($crt->shipp_des == 'outdoor'){
                                        if ($crt->qty >3 && $crt->qty <=6) {
                                            $shipp_cost = 2*$crt->get_product->indoor_charge;
                                            $cost += 2*$crt->get_product->outdoor_charge;
                                        }elseif($crt->qty >6 && $crt->qty <=9){
                                            $shipp_cost = 3*$crt->get_product->indoor_charge;
                                            $cost += 3*$crt->get_product->outdoor_charge;
                                        }elseif ($crt->qty >9 && $crt->qty <=10) {
                                            $shipp_cost = 4*$crt->get_product->indoor_charge;
                                            $cost += 4*$crt->get_product->outdoor_charge;
                                        }else{
                                            $shipp_cost = $crt->get_product->outdoor_charge;
                                            $cost += $crt->get_product->outdoor_charge;
                                        }
                                    }
                                    $e_money += $crt->get_product->e_money;
                                    $indoor = $crt->shipp_des;
                                @endphp
                                @endif
                                @if ($crt->get_vendor_product)
                                @php $neet_cost += $crt->total; @endphp
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{$crt->get_vendor_product->product_name}}</h6>
                                        <small class="text-muted">{{$crt->get_vendor_product->color}}/{{$crt->size}}</small>
                                    </div>
                                    <div>
                                       
                                        <h6 class="my-0">= {{$crt->total}} TK</h6>
                                        @if ($crt->shipp_des == NULL)
                                            <small class="text-muted">Ship.Co.= 0.00 TK</small> 
                                        @else 
                                            @if ($crt->get_vendor_product->indoor_charge == null || $crt->get_vendor_product->outdoor_charge == null)
                                                <small style="margin-left: 22px;" class="text-muted">Free Shipping</small>
                                            @elseif($crt->shipp_des == 'indoor')

                                                @if ($crt->qty >3 && $crt->qty <=6)
                                                    <small class="text-muted">Ship.Co.= 2 x {{$crt->get_vendor_product->indoor_charge}} TK</small>
                                                @elseif($crt->qty >6 && $crt->qty <=9)
                                                    <small class="text-muted">Ship.Co.= 3 x {{$crt->get_vendor_product->indoor_charge}} TK</small>
                                                @elseif($crt->qty >9 && $crt->qty <=10)
                                                    <small class="text-muted">Ship.Co.= 4 x {{$crt->get_vendor_product->indoor_charge}} TK</small>
                                                @else
                                                    <small class="text-muted">Ship.Co.= {{$crt->get_vendor_product->indoor_charge}} TK</small>
                                                @endif
                                            @elseif($crt->shipp_des == 'outdoor')
                                                @if ($crt->qty >3 && $crt->qty <=6)
                                                    <small class="text-muted">Ship.Co.= 2 x {{$crt->get_vendor_product->outdoor_charge}} TK</small>
                                                @elseif($crt->qty >6 && $crt->qty <=9)
                                                    <small class="text-muted">Ship.Co.= 3 x {{$crt->get_vendor_product->outdoor_charge}} TK</small>
                                                @elseif($crt->qty >9 && $crt->qty <=10)
                                                    <small class="text-muted">Ship.Co.= 4 x {{$crt->get_vendor_product->outdoor_charge}} TK</small>
                                                @else
                                                    <small class="text-muted">Ship.Co.= {{$crt->get_vendor_product->outdoor_charge}} TK</small>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                </li>
                                @php
                                    if ($crt->shipp_des == 'indoor') {
                                        if ($crt->qty >3 && $crt->qty <=6) {
                                            $shipp_cost = 2*$crt->get_vendor_product->indoor_charge;
                                            $cost += 2*$crt->get_vendor_product->indoor_charge;
                                        }elseif($crt->qty >6 && $crt->qty <=9){
                                            $shipp_cost = 3*$crt->get_vendor_product->indoor_charge;
                                            $cost += 3*$crt->get_vendor_product->indoor_charge;
                                        }elseif ($crt->qty >9 && $crt->qty <=10) {
                                            $shipp_cost = 4*$crt->get_vendor_product->indoor_charge;
                                            $cost += 4*$crt->get_vendor_product->indoor_charge;
                                        }else{
                                            $shipp_cost = $crt->get_vendor_product->indoor_charge;
                                            $cost += $crt->get_vendor_product->indoor_charge;
                                        }
                                    }else if($crt->shipp_des == 'outdoor'){
                                        if ($crt->qty >3 && $crt->qty <=6) {
                                            $shipp_cost = 2*$crt->get_vendor_product->indoor_charge;
                                            $cost += 2*$crt->get_vendor_product->outdoor_charge;
                                        }elseif($crt->qty >6 && $crt->qty <=9){
                                            $shipp_cost = 3*$crt->get_vendor_product->indoor_charge;
                                            $cost += 3*$crt->get_vendor_product->outdoor_charge;
                                        }elseif ($crt->qty >9 && $crt->qty <=10) {
                                            $shipp_cost = 4*$crt->get_vendor_product->indoor_charge;
                                            $cost += 4*$crt->get_vendor_product->outdoor_charge;
                                        }else{
                                            $shipp_cost = $crt->get_vendor_product->outdoor_charge;
                                            $cost += $crt->get_vendor_product->outdoor_charge;
                                        }
                                    }
                                    $indoor = $crt->shipp_des;
                                @endphp
                                @endif
                                @endforeach


                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Shipping Cost</h6>
                                    </div>

                                    <strong>
                                        = {{$cost}} TK
                                    </strong>
                                    <input type="hidden" id="total_cost" value="{{$cost}}"/>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Total E-Money</h6>
                                    </div>
                                    <div>
                                        <strong>= </strong>
                                        <strong id="t_emoney">{{$e_money}}</strong>
                                        <strong> TK</strong>
                                    </div>

                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Total (BDT)</h6>
                                    </div>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart as $val)
                                        <input hidden type="text" readonly value="{{$val->total}}" style="border: none;text-align: end;">
                                        @php
                                            $total += $val->total;

                                        @endphp

                                    @endforeach
                                    @php
                                        $total += $cost;
                                    @endphp
                                    <div>
                                        <strong>=</strong>
                                        <strong id="total_amount">{{$total}}</strong>
                                        <strong>TK</strong>
                                    </div>

                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-8 order-md-1">
                            <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                            <div class="col-md-6" style="float: left;">
                            <h4 >Billing address</h4>
                            <p style="display: none;background-color:yellow;color:#000">Opps!Please select one.</p>

                            <div style=" font-weight: 700;
                                    background: rgb(191 221 101);
                                    padding: 5px; margin-bottom: 1rem;
                                    border-radius: 5px;">
                                    <label style="padding-left: 5px;"> Product Delivery Location
                                    </label>
                                </div>
                                
                                <div class="custom-control custom-checkbox" style="margin-top: 0px;margin-left: 3rem">
                                    <input onclick="productShippDes(this.value)" id="shippIn" class="custom-control-input" type="radio" name="exampleRadios" value="indoor" required>
                                    <label class="custom-control-label" for="shippIn">
                                        Inside Dhaka
                                    </label>
                                </div>
                                <div class="custom-control custom-checkbox" style="margin-top: 0px;margin-left: 3rem">
                                    <input onclick="productShippDes(this.value)" id="shippOut" class="custom-control-input" type="radio" name="exampleRadios" value="outdoor" required>
                                    <label class="custom-control-label" for="shippOut">
                                        Outside Dhaka
                                    </label>
                                </div>
                        
                                <div style=" font-weight: 700;
                                    background: rgb(191 221 101);
                                    padding: 5px; margin-bottom: 1rem;
                                    border-radius: 5px;">
                                    <label style="padding-left: 5px"> Select Payment Status</label>
                                </div>

                                <div class="custom-control custom-checkbox" style="margin-top: 0px; margin-left: 3rem">
                                    <input onclick="visibleOption(0,{{$total}})" class="custom-control-input" type="radio" name="payment" id="checkout2" value="cash on delivery" required>
                                    <label class="custom-control-label" for="checkout2">
                                        Cash On Delivery
                                    </label>
                                </div>
                                <div class="custom-control custom-checkbox" style="margin-top: 0px; margin-left: 3rem">
                                    <input onclick="visibleOption({{auth()->user()->e_money}},0)" class="custom-control-input" type="radio" name="payment" id="checkout3" value="card" required>
                                    <label class="custom-control-label" for="checkout3">
                                        Card
                                    </label>
                                </div>
                                
                                <div id="emoney_option" class="custom-control custom-checkbox" style="margin-top: 0px; margin-left: 3rem;display:none;">
                                    <input onclick="calByEmoney({{$total}},{{$cost}},{{$neet_cost}},{{auth()->user()->e_money}})" class="custom-control-input" type="checkbox" name="payment" id="checkout4" value="e-money">
                                    <label class="custom-control-label" for="checkout4">
                                        E-Money
                                    </label>
                                </div>
                                
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <input id="amount" type="hidden" name="amount" value="{{$total}}">
                                <input id="total_emoney" type="hidden" name="total_emoney" value="{{$e_money}}">
                                <input id="qty" type="hidden" name="qty" value="{{$count1}}">

                            </div>

                            <div class="col-md-6" style="float: right;">
                                <div >
                                    <label for="firstName">Full name</label>
                                    <input type="text" name="customer_name" class="form-control" id="customer_name"
                                    style="margin-bottom: 0.5rem;" 
                                     placeholder="full name" value="" required>
                                    <div class="invalid-feedback">
                                        Valid customer name is required.
                                    </div>
                                </div>

                                <div >
                                    <label for="mobile">Mobile</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="height: 4rem !important;">
                                            <span class="input-group-text">+88</span>
                                        </div>
                                        <input type="text" name="customer_phone" class="form-control"
                                        style="margin-bottom: 0.5rem;"
                                         id="mobile" placeholder="Mobile" value="" required>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            Your Mobile number is required.
                                        </div>
                                    </div>
                                </div>

                                <div >
                                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                    <input type="email" name="customer_email" class="form-control" 
                                    style="margin-bottom: 0.5rem;" id="email"
                                           placeholder="you@example.com" value="" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>

                                <div >
                                    <label for="address">Address</label>
                                    <input type="text" name="customer_address" class="form-control" id="address" 
                                    style="margin-bottom: 0.5rem;" placeholder="address"
                                           value="" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>

                            </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main>

    @section('js')
        <script>
            window.onload=(function(){
                $("#showCategory").hide();
                $.ajax({
                    url: "{{ route('get.shipp.des') }}",
                    type: "get",
                    success:function(response)
                    {
                        if(response.data.shipp_des == "outdoor"){
                            $("#shippOut").attr('checked',true);
                        }else if(response.data.shipp_des == "indoor"){
                            $("#shippIn").attr('checked',true);
                        }
                    }
                })
            });
            
            function calByEmoney(amount,cost,neet_cost,money){
                var e_money = money/2;
                var total = neet_cost+cost+(amount-cost-neet_cost)-e_money;
                $("#total_amount").text(total);
                $("#amount").val(total);
                $("#t_emoney").text("-"+e_money);
            }
            
            function visibleOption(emoney,total){
                if(emoney >= 100){
                    $("#emoney_option").show();
                    $("#total_amount").text(total);
                    $("#amount").val(total);
                }else if(emoney <= 100){
                    $("#total_amount").text();
                    $("#amount").val();
                
                }else{
                    $("#checkout4").prop("checked", false);
                    $("#emoney_option").hide();
                    $("#mobile").val('');
                    $("#total_amount").text(total);
                    $("#amount").val(total);
                }
                
            }

            function showDropdown(){
                $("#showCategory").show();
            }

            function getCost(){
                $("#trans_cost").val($("#cost").val());
            }

            function productShippDes(val){ 
                $.ajax({
                    url: "{{ route('product.shipp.des') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'val': val
                    },
                    success:function(response)
                    {
                        
                        window.location.reload();
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
