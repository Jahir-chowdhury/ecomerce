
@extends('layouts.backend.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <div id="disableDiv" style="width: 70%;
                            padding: 5px;
                            background-color: white;
                            border: 1px solid #ddd;
                            box-shadow: 1px 1px #ddd;
                            border-radius: 5px;display: inline-flex;">
                            <a href="{{route('attributes')}}" style="padding: 10px;" class="btn btn-primary">
                                <i style="margin-right: 5px;font-size: 25px;margin-left: 5px;" class="fa fa-plus"
                                style="margin-right: 5px;"></i>
                            </a>
                            <p style="margin-left: 5px;
                            font-weight: 700;
                            margin-bottom: 0px;">Add Attribute
                                <span style="float: left;
                            margin-left: 15px;" class="badge badge-warning">0/0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Brand List</h3>
                        <button data-toggle="modal" data-target="#addModal" class="btn btn-primary" style="float: right;">
                            <i style="padding-right: 5px;" class="fas fa-plus"></i>Add Brand
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SI #</th>
                                    <th>Brand Name</th>
                                    <th style="width:200px !important">Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td style="width:200px !important">{{ Illuminate\Support\Str::limit($brand->br_description,50) }}</td>
                                        <td>
                                            <button onclick="editBrand({{ $brand }})" data-toggle="modal" data-target="#editModal" style="margin-right: 5px;"
                                                class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
        </div>


        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNewLabel">Add Banner</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form id="brandInfo" role="form" action="{{ route('brand.add') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Brand Name</label>
                                    <input name="brand_name" type="text" class="form-control"
                                        placeholder="Brand name" />
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Brand Description</label>
                                <textarea name="br_description" type="text"
                                class="form-control" placeholder="Enter brand description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
    </section>
</div>



<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addNewLabel">Update Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="brandUpdate">
                {{-- <input hidden type="text" value="{{ csrf_token() }}" class="form-control"/> --}}
                <input type="text" value="" id="slug" name="slug" hidden>

                <div>
                    <div class="form-group">
                        <label>Brand Name</label>
                        <input type="text" id="brand_name" name="brand_name" placeholder="Brand Name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label class="mr-sm-2">Brand Description</label>
                        <textarea id="brand_description" name="brand_description" type="text"
                        class="form-control" placeholder="Enter brand description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="updateBrand()" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>

    </div>
</div>
@section('js')

<script>
    $(function () {
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

<script type="text/javascript">

    function editBrand(brand) {
         $("#slug").val(brand.slug);
         $("#brand_name").val(brand.brand_name);
         $("#brand_description").val(brand.br_description);
     }


    // function subChildId(){
    //     $.ajax({
    //         url: "{{ route('get.cat.subCat') }}",
    //         type: "POST",
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             "id": $('#sub_child_category_id option:selected').val() ? $('#sub_child_category_id option:selected').val() : ''
    //         },
    //         success: function(response) {
    //             $('#cat').val(response.datas.get_child_category.get_category.cat_name);
    //             $('#child').val(response.datas.get_child_category.child_name);
    //             $('#get_category_id').val(response.datas.category_id);
    //             $('#get_child_category_id').val(response.datas.child_category_id);

    //         }
    //     })
    // }


    function updateBrand() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('brand.update') }}",
            method: "POST",
            data: new FormData(document.getElementById("brandUpdate")),
            enctype: 'form-data',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // window.location.reload();
            }
        })
    };


</script>

@endsection
@endsection
