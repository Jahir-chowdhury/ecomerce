@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Single Vendor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Single Vendor</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        </section>
        <section class="content">
            <div class="row">
                <div class="card-body col-4" id="Info" style="border: 1px solid rgb(221, 221, 221);
                    height: 511px;
                    background-color: #fff;">
                    <div class="card-header" style="color: #fff;
                    background-color: #28a745;
                    border-color: #28a745;
                    box-shadow: none;">
                        <h3 class="card-title">Update Vendor Info</h3>

                    </div>
                    <form role="form" method="POST" id="edit" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Brand Name</label>
                            <input id="br_name" name="brand_name" type="text" class="form-control"
                                placeholder="Enter brand name" />
                        </div>
                        <div class="row col-12">
                            <div class="form-group col-md-4">
                                <label for="image" class="mr-sm-2">logo</label>
                                <div style="height: 100px;
                                    border: dashed 1.5px blue;
                                    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                    width: 100% !important;
                                    cursor: pointer;">
                                    <input style="opacity: 0;
                                    height: 100px;
                                    cursor: pointer;
                                    padding: 0px;" id="editlogo" type="file" class="form-control" name="logo">
                                    <img src="" id="edit_logo" style="height: 100px;
                                    width: 100% !important;
                                    cursor: pointer;
                                    margin-top: -134px;" />
                                    <input type="text" id="slug" name="slug" hidden>
                                </div>

                            </div>
                            <div class="form-group col-md-7 offset-1">
                                <label for="image" class="col-form-label">Banar</label>
                                <div style="height: 100px;
                                    border: dashed 1.5px blue;
                                    background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                                    width: 100% !important;
                                    cursor: pointer;">
                                  <input style="opacity: 0;
                                  height: 100px;
                                  cursor: pointer;
                                  padding: 0px;" id="editban" type="file" class="form-control" name="banar">
                                  <img src="#" id="edit_banar" style="height: 100px;
                                  width: 100% !important;
                                  cursor: pointer;
                                  margin-top: -134px;"/>
                                </div>
                             </div>
                             <div class="form-group col-12">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                    >Address</label
                                    >
                                <textarea
                                    style="min-height: 106px;"
                                    id="ven_address"
                                    name="address"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter address"
                                ></textarea>
                            </div>
                        </div>

                        <button class="btn btn-success" style="width: 100%" type="submit">Submit</button>
                    </form>
                </div>
                <div id="vendor_table" class="card col-7 offset-1" style="border: 1px solid #ddd;display:block;">
                    <div class="card-header">
                        <h3 class="card-title">Single Vendor List</h3>

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
                                        Banar
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

                                @foreach ($single_vendors as $ven)
                                    @if($ven->user_id == auth()->user()->id || auth()->user()->role == 'super_admin')
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $ven->brand_name }}</td>
                                        <td class="sorting_1">
                                            <img style="height: 50px;width: 120px;"
                                                src="{{ asset('/images/' . $ven->logo) }}" />

                                        </td>
                                        <td class="sorting_1">
                                            <img style="height: 50px;width: 150px;"
                                                src="{{ asset('/images/' . $ven->banar) }}" />

                                        </td>
                                        <td>
                                            @if ($ven->multi_vendor == 0)
                                                <p class="badge badge-warning">Single</p>
                                            @else
                                                <p class="badge badge-success">Group</p>
                                            @endif
                                        </td>
                                        <td style="display: inline-flex;">
                                            <button onclick="editSingleVen({{$ven}})" style="margin-right: 5px;" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="#" method="POST">
                                                @csrf
                                                <button disabled class="btn btn-danger btn-sm">
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

    </script>
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#edit_logo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#editlogo").change(function(){
            readURL(this);
        });

        function banarUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#edit_banar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#editban").change(function(){
            banarUrl(this);
        });

        function editSingleVen(ven) {
            $('#br_name').val(ven.brand_name);
            $('#ven_address').val(ven.address);
            $('#slug').val(ven.id);
            document.getElementById("edit_logo").src = "{{ asset('/images/') }}/" + ven.logo;
            document.getElementById("edit_banar").src = "{{ asset('/images/') }}/" + ven.banar;
        }
        
        $(document).ready(function(){

            $('#edit').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:"{{ route('single.vendor.update') }}",
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

    </script>

@endsection

@endsection