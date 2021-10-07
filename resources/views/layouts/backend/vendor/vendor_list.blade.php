@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <div id="msg" style="display: none;
        width: 20%;
        float: right;
        z-index: 9999;
        opacity: .8;" class="btn btn-success">Vendor Approve Successfull.</div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                    <div class="col-sm-3" style="max-width:20% !important">
                        <div style="width: 100%;
                        padding: 10px;
                        background-color: white;
                        border: 1px solid #ddd;
                        box-shadow: 1px 1px #ddd;
                        border-radius: 5px;display: inline-flex;">
                            <button class="btn btn-primary" onclick="showPendingRequest()" style="padding: 10px;">
                                <i class="fa fa-eye" style="margin-right: 5px;font-size: 25px;margin-left: 5px;"></i>

                            </button>
                            <p style="margin-left: 5px;
                        font-weight: 700;
                        margin-bottom: 0px;">Vendor Request
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">{{ $count }}</span>
                            </p>
                        </div>
                    </div>
                    @endif
                   @php $val = '';@endphp
                   @foreach($vendors as $ven)
                    @if($ven->user_id == auth()->user()->id)
                    @php $val = $ven->user_id;@endphp
                    @endif
                   @endforeach
                   
                    @if(!$val || auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                    <div class="col-sm-3" style="max-width:19% !important">
                        <div style="width: 100%;
                        padding: 10px;
                        background-color: white;
                        border: 1px solid #ddd;
                        box-shadow: 1px 1px #ddd;
                        border-radius: 5px;display: inline-flex;">
                            <button id="createBtn" class="btn btn-primary" onclick="createVendor()" style="padding: 10px;">
                                <i class="fa fa-plus" style="margin-right: 5px;font-size: 25px;margin-left: 5px;"></i>

                            </button>
                            <p style="margin-left: 5px;
                        font-weight: 700;
                        margin-bottom: 0px;">Create Vendor
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">00</span>
                            </p>
                        </div>
                    </div>
                    @endif
                 
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                
                <div id="new_vendor_table" class="card col-10" style="border: 1px solid #ddd; float:left; display:none;">
                    <div class="card-header" style="color: #fff;
                    background-color: #28a745;
                    border-color: #28a745;
                    box-shadow: none;
                    margin-top: 10px;">
                        <h3 class="card-title">Pending Request</h3>
                        <button onclick="closeTable()" class="close" aria-label="Close">
                            <span style="color: #fff" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>
                                        Vendor Name
                                    </th>
                                    <th>
                                        Logo
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Vendor Type
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendors as $ven)
                                    @if ($ven->status == 0)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $ven->brand_name }}</td>
                                            <td class="sorting_1">
                                                <img style="height: 50px;width: 120px;"
                                                    src="{{ asset('/images/' . $ven->logo) }}" />

                                            </td>
                                            <td>
                                                @if ($ven->status == 0)
                                                    <input hidden type="text" id="id" name="id">
                                                    <p style="cursor: pointer;"
                                                        onclick="approveVendor({{ $ven }})"
                                                        class="badge badge-warning">Pending</p>

                                                @endif
                                            </td>
                                            <td>
                                                @if ($ven->multi_vendor == 0)
                                                    <p class="badge badge-warning">Single</p>
                                                @else
                                                    <p class="badge badge-success">Group</p>
                                                @endif
                                            </td>
                                            <td style="display: inline-flex;">
                                                <p onclick="editVendorReq({{ $ven }})"
                                                    style="margin-right: 5px;cursor: pointer;"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </p>
                                                <form action="{{ route('req.vendor.delete', $ven->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                <div id="vendor_table" class="card col-7" style="border: 1px solid #ddd;float:left; display:block;">
                    <div class="card-header">
                        <h3 class="card-title">Vendor List</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr role="row">
                                    <th>
                                        Vendor Name
                                    </th>
                                    <th>
                                        Logo
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Vendor Type
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($vendors as $ven)

                                    @if ($ven->status == 1 && $ven->user_id == $data->id || $ven->status == 1 && $data->role == 'super_admin')
                                        <input type="hidden" id="getId" value="{{$ven->user_id}}">
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $ven->brand_name }}</td>
                                            <td class="sorting_1">
                                                <img style="height: 50px;width: 120px;"
                                                    src="{{ asset('/images/' . $ven->logo) }}" />

                                            </td>
                                            <td>
                                                @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                                                <p style="cursor: pointer;" onclick="disableVendor({{ $ven }})"
                                                    class="badge badge-success">Approved</p>
                                                @else 
                                                <p class="badge badge-success">Approved</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ven->multi_vendor == 0)
                                                    <p class="badge badge-warning">Single</p>
                                                @else
                                                    <p class="badge badge-success">Group</p>
                                                @endif
                                            </td>
                                            <td style="display: inline-flex;">
                                                <button onclick="editVendorReq({{$ven}})" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <!--<form action="#" method="POST">-->
                                                <!--    @csrf-->
                                                <!--    <button disabled class="btn btn-danger btn-sm">-->
                                                <!--        <i class="fa fa-trash"></i>-->
                                                <!--    </button>-->
                                                <!--</form>-->
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                @if(auth()->user()->role == "vendor")
                                    @foreach ($vendors as $ven)
                                    @if ($ven->status == 0 && $ven->user_id == $data->id)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $ven->brand_name }}</td>
                                            <td class="sorting_1">
                                                <img style="height: 50px;width: 120px;"
                                                    src="{{ asset('/images/' . $ven->logo) }}" />

                                            </td>
                                            <td>
                                                @if ($ven->status == 0)
                                                    <input hidden type="text" id="id" name="id">
                                                    <p class="badge badge-warning">Pending</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ven->multi_vendor == 0)
                                                    <p class="badge badge-warning">Single</p>
                                                @else
                                                    <p class="badge badge-success">Group</p>
                                                @endif
                                            </td>
                                            <td style="display: inline-flex;">
                                                <p onclick="editVendorReq({{ $ven }})"
                                                    style="margin-right: 5px;cursor: pointer;"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </p>
                                                <!--<form action="{{ route('req.vendor.delete', $ven->slug) }}"-->
                                                <!--    method="POST">-->
                                                <!--    @csrf-->
                                                <!--    <button class="btn btn-danger btn-sm" type="submit">-->
                                                <!--        <i class="fa fa-trash"></i>-->
                                                <!--    </button>-->
                                                <!--</form>-->
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                
                
                
                
                
                
                
                
                <div id="addProductForm" class="card card-primary col-4" style="padding-top: 8px;
                    border: 1px solid #ddd; float:right;
                    padding-bottom: 8px;
                    display: none;
                    height:360px !important;
                ">
                <div class="card-header" style="background-color: #007bff;
                color: #fff;">
                  <h3 class="card-title">Create Vendor</h3>
                  <button
                    onclick="formClose()"
                    class="close"
                    aria-label="Close"
                  >
                    <span style="color: #fff" aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="card-body row col-12">
                    <form  role="form" method="POST" id="upload_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Brand Name</label
                                >
                            <input
                                id="brand_name"
                                name="brand_name"
                                type="text"
                                class="form-control"
                                placeholder="Enter brand name"
                            />
                        </div>
                        <div class="row col-12">
                            <div class="form-group col-6">
                                <label for="image" class="mr-sm-2">logo</label>
                                <div style="height: 100px;
                                    border: dashed 1.5px blue;
                                    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                    width: 100% !important;
                                    cursor: pointer;">
                                <input style="opacity: 0;
                                    height: 100px;
                                    cursor: pointer;
                                    padding: 0px;" id="vendor_logo" type="file" class="form-control" name="vendor_logo">
                                <img src="#" id="create-vendor-logo" style="height: 100px;
                                    width: 100% !important;
                                    cursor: pointer;
                                    margin-top: -134px;"/>
                                </div>

                            </div>
                            <div class="form-group col-6">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                >Vendor Type</label
                                >
                                <select class="form-control" name="status" id="status">
                                        <option value="" selected="selected" hidden>Select</option>
                                        <option value="1">Group</option>
                                        <option value="0">Single</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary" style="width: 100%" type="submit">Submit</button>
                    </form>
                </div>
                

              </div>
              
                <div class="card col-4" id="editDefaultVendor" style="height:200px; float:right; background:#ddd; opacity:0.5;">
                        <h3 style="text-align:center; margin-top:100px;">Vendor ...</h3>
                    
                </div>
                
                <div class="card-body col-4" id="vendorlogoInfo" style="display:none; float:right; border: 1px solid rgb(221, 221, 221);
                    height: 350px;
                    background-color: #fff;">
                    <div class="card-header" style="color: #fff;
                    background-color: #28a745;
                    border-color: #28a745;
                    box-shadow: none;">
                        <h3 class="card-title">Update Vendor Info</h3>

                    </div>
                    <form role="form" method="POST" id="edit_vendor" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Brand Name</label>
                            <input id="br_name" name="brand_name" type="text" class="form-control"
                                placeholder="Enter brand name" />
                        </div>
                        <div class="row col-12">
                            <div class="form-group col-6">
                                <label for="image" class="mr-sm-2">logo</label>
                                <div style="height: 100px;
                                    border: dashed 1.5px blue;
                                    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                    width: 100% !important;
                                    cursor: pointer;">
                                    <input style="opacity: 0;
                                    height: 100px;
                                    cursor: pointer;
                                    padding: 0px;" id="logo" type="file" class="form-control" name="logo">
                                    <img src="" id="vendor-logo-img" style="height: 100px;
                                    width: 100% !important;
                                    cursor: pointer;
                                    margin-top: -134px;" />
                                    <input type="text" id="slug" name="slug" hidden>
                                </div>

                            </div>
                            <div class="form-group col-6">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Vendor Type</label>
                                <select class="form-control" name="multi_vendor" id="multi_vendor">
                                    <option value="" selected="selected" hidden>Select</option>
                                    <option value="1">Group</option>
                                    <option value="0">Single</option>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-success" style="width: 100%" type="submit">Submit</button>
                    </form>
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
        window.onload =(function(){
            var auth = {{auth()->user()->id}};
                console.log($("#id").val());
        })


        function createVendor(){
            document.getElementById("addProductForm").style.display = "block";
            document.getElementById("vendorlogoInfo").style.display = "none";
            document.getElementById("editDefaultVendor").style.display = "none";
            document.getElementById("new_vendor_table").style.display = "none";
            document.getElementById("vendor_table").style.display = "block";
        }
        function formClose(){
            document.getElementById("addProductForm").style.display = "none";
            document.getElementById("vendorlogoInfo").style.display = "none";
            document.getElementById("editDefaultVendor").style.display = "block";
        }

        $(document).ready(function(){

            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"{{ route('vendor.add') }}",
                    method:"POST",
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        window.location.reload();
                    }
                })
            });

        });

        function vendorLogoUrl(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#create-vendor-logo').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

        $("#vendor_logo").change(function(){
            vendorLogoUrl(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#vendor-logo-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logo").change(function() {
            readURL(this);
        });

        function editVendorReq(ven) {
            document.getElementById("vendorlogoInfo").style.display = "block";
            document.getElementById("editDefaultVendor").style.display = "none";
            
            $('#br_name').val(ven.brand_name);
            $('#multi_vendor').val(ven.multi_vendor);
            $('#slug').val(ven.slug);
            document.getElementById("vendor-logo-img").src = "{{ asset('/images/') }}/" + ven.logo;
        }

        function showPendingRequest() {
            document.getElementById("vendor_table").style.display = "none";
            document.getElementById("editDefaultVendor").style.display = "none";
            document.getElementById("vendorlogoInfo").style.display = "none";
            document.getElementById("addProductForm").style.display = "none";
            
            var newstl = document.getElementById("new_vendor_table").style.display = "block";
            $('#brand_name').val('');
            $('#status').val('');
            $('#slug').val('');
            document.getElementById("vendor-logo-img").src = "#";
        }

        function closeTable() {
            document.getElementById("vendor_table").style.display = "block";
            document.getElementById("new_vendor_table").style.display = "none";
            document.getElementById("editDefaultVendor").style.display = "block";
            $('#brand_name').val();
            $('#status').val();
            $('#slug').val();
            document.getElementById("vendor-logo-img").src = "#";
        }

        function approveVendor(ven) {
            id = ven.id;

            $.ajax({
                url: "approve-vendor",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }

        function disableVendor(ven) {
            id = ven.id;

            $.ajax({
                url: "disable-vendor",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
        $(document).ready(function() {

            $('#edit_vendor').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('vendor.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        window.location.reload();
                    }
                })
            });

        });

    </script>

@endsection
@section('css')
    <style>
        /* .table-visible{
                    display:block !important;
                    max-width: 100% !important;
                }
                .table-new-style{
                    max-width: 60% !important;
                    transition: .3s;
                    margin-left: 40%;
                } */

    </style>
@endsection
@endsection
