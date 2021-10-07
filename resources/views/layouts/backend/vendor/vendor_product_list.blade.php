@extends('layouts.backend.app')
@section('content')
<div class="content-wrapper" style="min-height: 1589.56px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <div id="disableDiv" style="width: 100%;
                padding: 5px;
                background-color: white;
                border: 1px solid #ddd;
                box-shadow: 1px 1px #ddd;
                border-radius: 5px;display: inline-flex;">
                <button class="btn btn-primary" onclick="addBrand()" style="padding: 10px;">
                    <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                        style="margin-right: 5px;"></i>
                </button>
                <p style="margin-left: 5px;
                font-weight: 700;
                margin-bottom: 0px;">Add Brnad
                    <span style="float: left;
                margin-left: 15px;" class="badge badge-warning">0/0</span>
                </p>
            </div>
        </div>
        <div class="col-sm-2">
            <div id="disableDiv" style="width: 100%;
                padding: 5px;
                background-color: white;
                border: 1px solid #ddd;
                box-shadow: 1px 1px #ddd;
                border-radius: 5px;display: inline-flex;">
                <button class="btn btn-primary" onclick="addProduct()" style="padding: 10px;">
                    <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                        style="margin-right: 5px;"></i>
                </button>
                <p style="margin-left: 5px;
                font-weight: 700;
                margin-bottom: 0px;">Add Product
                    <span style="float: left;
                margin-left: 15px;" class="badge badge-warning">0/0</span>
                </p>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="disableDiv" style="width: 85%;
                padding: 5px;
                background-color: white;
                border: 1px solid #ddd;
                box-shadow: 1px 1px #ddd;
                border-radius: 5px;display: inline-flex;">
                <button class="btn btn-primary" onclick="addProductAvatar()" style="padding: 10px;">
                    <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                        style="margin-right: 5px;"></i>
                </button>
                <p style="margin-left: 5px;
                font-weight: 700;
                margin-bottom: 0px;">Add Product Images
                    <span style="float: left;
                margin-left: 15px;" class="badge badge-warning">0/0</span>
                </p>
            </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div id="addProductForm" class="card card-primary col-10 offset-1" style="padding-top: 8px;
                    border: 1px solid #ddd;
                    padding-bottom: 8px;
                    display: none;
                ">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Add New Product Info</h3>
                  <button
                    onclick="formClose()"
                    class="close"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
                @include('layouts.backend.vendor.add_vendor_brand')
                <form id="productInfo" action="{{route('vendor.product.store')}}" method="POST" style="display: none;">
                 @csrf

                  <div class="card-body row col-12">
                    <div class="row col-12">
                        <div class="form-group col-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                            >Select Vendor</label
                            >
                            <select class="form-control" onclick="get_vendor_id()" name="vendor_id" id="ven_id">
                                <option value="" selected="selected" hidden>select</option>
                                @foreach ($vendors as $ven)
                                @if($ven->status == 1)
                                <option value="{{ $ven->id }}">
                                    {{ $ven->brand_name }}
                                </option>
                                @endif
                                @endforeach
                                <input type="hidden" id="allVendor" name="vendors" value="{{$vendors}}">
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                            >Select Single Vendor</label
                            >
                            <select class="form-control" name="single_vendor_id" id="single_vendor_id">
                                <option value="" selected="selected" hidden>select</option>
                                @foreach ($vendors as $item)
                                    @if($item->multi_vendor == 1)
                                        @foreach($item->get_single_vendor as $single)
                                            <option value="{{optional($single)->id }}">
                                                {{$single->brand_name}}
                                            </option>
                                        @endforeach
                                    @endif 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Product Name</label
                                >
                            <input
                                id="product_name"
                                name="product_name"
                                type="text"
                                class="form-control"
                                placeholder="Enter product name"
                            />
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Product Code</label
                                >
                            <input
                                id="product_code"
                                name="product_code"
                                type="text"
                                class="form-control"
                                placeholder="Enter product code"
                            />
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Product Color</label
                                >
                            <input
                                id="color"
                                name="color"
                                type="text"
                                class="form-control"
                                placeholder="Enter product color"
                            />
                        </div>
                        <div class="form-group col-3">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Admin Commission</label>
                            <input value="" id="admin_percent" name="admin_percent"
                                type="number" step="any" class="form-control"
                                placeholder="0.00 tk " />
                        </div>
                    </div>
                    <div class="form-group row col-12">
                        <div class="form-group col-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">
                                Indoor Shipping Charege
                            </label>
                            <input
                                value=""
                                id="indoor_charge"
                                name="indoor_charge"
                                type="number"
                                step="any"
                                class="form-control"
                                placeholder="indoor charge"
                            />
                        </div>
                        <div class="form-group col-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">
                                Outdoor Shipping Charege
                            </label>
                            <input
                                value=""
                                id="outdoor_charge"
                                name="outdoor_charge"
                                type="number"
                                step="any"
                                class="form-control"
                                placeholder="outdoor charge"
                            />
                        </div>
                        
                        
                    </div>
                    <div class="form-group row col-12">
                        <label class="mr-sm-2" for="inlineFormCustomSelect"
                            >Product Description</label
                        >
                        <textarea
                        id="description"
                        name="description"
                        type="text"
                        class="form-control"
                        placeholder="Enter product description"
                        ></textarea>
                    </div>
                 </div>
                    <button
                        id="submit"
                        type="submit"
                        style="width: 100%"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>
                </form>
                <div id="productAvatarInfo" class="card-body row col-12" style="display: none;">

                    <div class="form-group">
                        <input type="text" id="single_error" name="single_error" readonly style="display:none;border: none;
                        width: 22%;
                        background-color: #f15353;
                        color: #fff;
                        font-size: 10px; margin-top:2px;">
                        <p id="stayImageWarning" style="background-color: rgb(241, 230, 83);
                        color: #000;
                        font-weight: 700;
                        width: 33%;
                        display:none;
                        padding: 5px;">This product images already uploaded.</p>
                        <form id="imageUpload" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-12">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Select Product</label
                                >
                                <select class="form-control" onclick="getId()" name="vendor_product_name" id="vendor_product_name">
                                    <option value="" selected="selected" hidden>select product name</option>
                                    @foreach ($vendor_products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input style="display:none;border: none;
                                width: 22%;
                                background-color: #f15353;
                                color: #fff;
                                font-size: 10px; margin-top:2px;" type="text" id="error" name="error" readonly>
                            </div>
                            <div class="row col-12" id="imgField">
                                  <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Front Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                      <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="front" type="file" class="form-control" name="front">
                                      <img src="#" id="front-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;margin-top: -134px;"/>
                                    </div>
                                    <input style="display:none;border: none;
                                        width: 75%;
                                        background-color:#f15353;;
                                        color: #fff;
                                        font-size: 10px;margin-top:2px;" type="text" id="frontError" name="frontError" readonly>
                                  </div>
                                  <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Back Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                      <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="back" type="file" class="form-control" name="back">
                                      <img src="#" id="back-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;"/>
                                    </div>
                                  </div>
                                  <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Left Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                      <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="left" type="file" class="form-control" name="left">
                                      <img src="#" id="left-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;"/>
                                    </div>
                                  </div>
                                  <div class="form-group col-3">
                                    <label for="image" class="col-form-label">Right Side Image</label>
                                    <div style="height: 100px;
                                        border: dashed 1.5px blue;
                                        background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                        width: 60% !important;
                                        cursor: pointer;">
                                      <input style="opacity: 0;
                                      height: 100px;
                                      cursor: pointer;
                                      padding: 0px;" id="right" type="file" class="form-control" name="right">
                                      <img src="#" id="right-img" style="height: 100px;
                                      width: 100% !important;
                                      cursor: pointer;
                                      margin-top: -134px;"/>
                                    </div>
                                  </div>
                            </div>
                            <button id="submitData" class="btn btn-primary" style="width:100%" type="submit">Submit</button>
                        </form>
                    </div>

                </div>

            </div>
            <div id="editProductForm" class="card card-primary col-8 offset-2"

                style="padding-top: 8px;
                    border: 1px solid #ddd;
                    padding-bottom: 8px;
                    display: none;
                ">
                <div class="card-header" style="color: #fff;
                background-color: #28a745;
                border-color: #28a745;
                box-shadow: none;">
                  <h3 class="card-title">Update Product</h3>
                  <a
                    href="#"
                    onclick="closeForm()"
                    class="close"
                    >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </a>
                </div>
              <form role="form" id="contact-form" action="#" method="POST">
                  @csrf
                  <div class="card-body">
                      <input type="text" id="id" name="id" hidden>
                    <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Select SubCategory</label
                        >
                        <select class="form-control" name="edit_child_category_id" id="edit_child_category_id">
                            {{-- @foreach ($childs as $sub_cat)
                            <option selected="selected" value="{{ $sub_cat->id }}">
                                {{ $sub_cat->child_name }}
                            </option>
                            @endforeach --}}
                        </select>

                    </div>
                    <div class="form-group">
                      <label class="mr-sm-2" for="inlineFormCustomSelect"
                          >Sub SubCategory Name</label
                        >
                      <input
                        required
                        id="edit_sub_child_name"
                        name="edit_sub_child_name"
                        type="text"
                        class="form-control"
                        placeholder="Enter sub sub-category name"
                      />
                    </div>
                  </div>
                  <button
                    type="submit"
                    style="width: 100%"
                    class="btn btn-success"
                  >
                    Submit
                  </button>
                </form>
            </div>

            <div id="product_table" class="card col-12" style="border: 1px solid #ddd;display:block;">
                <div class="card-header">
                <h3 class="card-title">All Products is here</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" style="width: 166px;">
                                Product Name
                            </th>
                            <th class="sorting_asc" style="width: 166px;">
                                Color
                            </th>
                            <th class="sorting_asc" style="width: 166px;">
                                Admin Commision
                            </th>
                            <th class="sorting" style="width: 204px;">
                                Status
                            </th>
                            <th class="sorting" style="width: 99px;">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($vendor_products as $pro)
                                @if($pro->get_vendor->user_id == auth()->user()->id)

                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$pro->product_name}}</td>
                                    <td class="sorting_1">{{$pro->color}}</td>
                                    <td class="sorting_1">{{$pro->admin_percent}}</td>
                                    <td>
                                        @if ($pro->status == 0)
                                        <button class="badge badge-warning">Inactive</button>
                                        @else
                                        <button class="badge badge-success">Active</button>
                                        @endif
                                        @php
                                        $id = '';
                                        @endphp
                                        @foreach ($pro->get_vendor_product_avatar  as $avtr)
                                            @php
                                                $id = $avtr->vendor_product_id;
                                            @endphp
                                            <a href="{{route('vendor.product.avatars',$pro->slug)}}" class="badge badge-info">Images</a>
                                        @endforeach

                                        @if ($pro->id != $id)
                                        <p style="cursor: pointer" onclick="addProductAvatar()"
                                            class="badge badge-danger">Images</p>
                                        @endif
                                        

                                    </td>
                                    <td style="display: inline-flex;">
                                        <a href="{{route('vendor.product.edit',$pro->slug)}}" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <button class="btn btn-danger btn-sm" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
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
          function get_vendor_id(){
            $("#single_vendor_id").attr('disabled',false);
            data = $("#allVendor").val();
            data1 = JSON.parse(data);
            data1.forEach(element => {
                if (element.multi_vendor == 0) {
                    val = $("#ven_id").val();
                    if(val == element.id){
                        // $("#single_vendor_id").val(element.brand_name);
                        $("#single_vendor_id").attr('disabled',true);
                        $("#single_vendor_id").val('');
                    }
                }

            });
            // $("#banar").attr('disabled',false);
          }

            function getVendorId(){
                dt = $("#vendor_id").val()
                if(dt != ''){
                    $("#info").show();
                }
            }
            function active(){
                $("#logoDiv").css({
                    'display':'none'
                });
                $("#logoDiv1").css({
                    'display':'block'
                });
                $("#info").hide();
                data = $("#vendors").val();
                data1 = JSON.parse(data);
                data1.forEach(element => {
                    val = $("#vendor_id").val();
                    if(val == element.id){
                        $("#brand_name").val(element.brand_name);
                        $("#brand_name").attr('readonly',true);
                    }
                });
                $("#banar").attr('disabled',false);
            }
            function inactive(){
                $("#logoDiv").css({
                    'display':'block'
                });
                $("#logoDiv1").css({
                    'display':'none'
                });
                $("#info").hide();
                $("#brand_name").attr('readonly',false);
                $("#banar").attr('disabled',false);
                $("#logo").attr('disabled',false);
                $("#brand_name").val('');
            }
            function getId(){

                $.ajax({
                    url:"{{ route('avatar.index') }}",
                    method:"get",
                    dataType:'JSON',
                    success:function(response)
                    {
                        response.data.forEach(element => {

                            if(element.vendor_product_id == $("#vendor_product_name").val()){
                                $("#imgField").hide();
                                $("#submitData").hide();
                                setTimeout(() => {
                                    $("#stayImageWarning").show();

                                },100);
                            }else{
                                $("#imgField").show();
                                $("#submitData").show();
                                $("#stayImageWarning").hide();
                            }
                        });

                    }
                })
            }
            function frontUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#front-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            function backUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#back-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            function leftUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#left-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            function rightUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#right-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#front").change(function(){
                frontUrl(this);
            });
            $("#back").change(function(){
                backUrl(this);
            });
            $("#left").change(function(){
                leftUrl(this);
            });
            $("#right").change(function(){
                rightUrl(this);
            });
            $(document).ready(function(){

                $('#imageUpload').on('submit', function(event){
                    event.preventDefault();
                    $("#submitData").prop('disabled',true);
                    $.ajax({
                        url:"{{ route('vendor.product.avatar') }}",
                        method:"POST",
                        data:new FormData(this),
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {   if(response.errors){
                                if(response.errors[0] && !response.errors[1]){
                                    $('#single_error').val( response.errors[0]);
                                    document.getElementById("single_error").style.display = "block";
                                    setTimeout('$("#single_error").hide()',6000);

                                }else{
                                    $('#error').val( response.errors[0]);
                                    $('#frontError').val( response.errors[1]);
                                    document.getElementById("error").style.display = "block";
                                    document.getElementById("frontError").style.display = "block";
                                    setTimeout('$("#frontError").hide()',6000);
                                    setTimeout('$("#error").hide()',6000);
                                }
                            }else{
                                window.location.reload();

                            }
                        }
                    })
                });

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#logo-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#logo").change(function(){
                readURL(this);
            });

            function banarUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#banar-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#banar").change(function(){
                banarUrl(this);
            });

          function formClose(){
            document.getElementById("addProductForm").style.display = "none";
            document.getElementById("product_table").style.display = "block";
          }

        function editProduct(){
          document.getElementById("addProductForm").style.display = "none";
          document.getElementById("editProductForm").style.display = "block";
        }
        function closeForm(){
          document.getElementById("editProductForm").style.display = "none";
          document.getElementById("addProductForm").style.display = "block";
        }

        function addProduct(){
            document.getElementById("addProductForm").style.display = "block";
            document.getElementById("product_table").style.display = "none";
            document.getElementById("productInfo").style.display = "block";
            document.getElementById("addBrandForm").style.display = "none";
            document.getElementById("productAvatarInfo").style.display = "none";
        }

        function addBrand(){
            document.getElementById("addProductForm").style.display = "block";
            document.getElementById("product_table").style.display = "none";
          document.getElementById("productInfo").style.display = "none";
          document.getElementById("productAvatarInfo").style.display = "none";
          document.getElementById("addBrandForm").style.display = "block";
        }

        function addProductAvatar(){
            document.getElementById("addProductForm").style.display = "block";
            document.getElementById("product_table").style.display = "none";
          document.getElementById("productInfo").style.display = "none";
          document.getElementById("addBrandForm").style.display = "none";
          document.getElementById("productAvatarInfo").style.display = "block";
        }


      </script>
      {{-- <script type="text/javascript">
            Dropzone.options.dropzone=
            {
                maxFiles : 4,
                renameFile: function (file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 30000,
                accept: function (file, done) {
                    window.location.reload();
                },
                error: function (file, response) {
                    return false;
                }
            };
        }
       </script> --}}
       <script>
        $(document).ready(function(){

            $('#singleVendor').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"{{ route('vendor.brand.add') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        window.location.reload();
                        Toast.fire({
                            icon:"success",
                            title:"Brand add successfull."
                        });
                    }
                })
            });

        });


        </script>
    @endsection
@endsection
