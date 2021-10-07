@extends('layouts.backend.app')
@section('content')
  <div class="content-wrapper" style="min-height: 1589.56px;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>All Vendor</h1>

            </div>
          </div>
        </div>
      </section>
      <section class="content">
            <div class="row">
                <div class="card col-12">
                  <div class="card-header">
                    <h3 class="card-title">Vendor List</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr role="row">
                            <th class="sorting_asc">Name</th>
                            <th class="sorting_asc">Designation</th>
                            <th class="sorting">Address</th>
                            <th class="sorting">Email</th>
                            <th class="sorting">Phone</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        @if($user->role == 'vendor')
                        <tr role="row" class="odd">
                          <td class="sorting_1">{{$user->name}}</td>
                          <td class="sorting_1">
                            <p class="badge badge-success">{{$user->role}}</p>
                          </td>
                          <td>{{$user->address}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->phn}}</td>
                          {{-- <td style="display: inline-flex;">
                              <button style="margin-right: 5px;" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-sm" onclick="updateUser({{$user}})">
                                  <i class="fa fa-eye"></i>
                              </button>
                              @if(optional($validVendor)->multi_vendor == 1 || $data->role == "super_admin")
                              <button style="margin-right: 5px;" title="view single vendor" onclick="showSingleVen({{$user->id}})" class="btn btn-info btn-sm">
                                <i class="fas fa-industry"></i>
                              </button>
                              @endif
                              @if((optional($validVendor)->multi_vendor == 0 || $data->role == "super_admin"))
                              <button title="view product" onclick="showProduct({{$user->id}},'vendor_id')" class="btn btn-success btn-sm">
                                <i class="fab fa-pinterest-p"></i>
                              </button>
                              @endif
                          </td> --}}
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="text-transform:capitalize;"></h5>
                    <button onclick="closeForm()" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="editUser" class="card card-primary">
            
                        <form role="form" id="contact-form">
                            @csrf
                            <div class="card-body" style="padding-top: 5px !important;padding-bottom:5px !important;">
                              <div class="form-group">
                                <input type="text" id="userId" name="userId" hidden>
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                    >Name</label
                                  >
                                <input
                                  id="name"
                                  name="name"
                                  type="text"
                                  class="form-control"
                                  placeholder="Enter user name"
                                />
                              </div>
                              <div class="form-group">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                    >Email</label
                                  >
                                <input
                                  id="email"
                                  name="email"
                                  type="email"
                                  class="form-control"
                                  placeholder="Enter user email"
                                />
                              </div>
                              <div class="form-group">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                    >Phone Number</label
                                  >
                                <input
                                  id="phn"
                                  name="phn"
                                  type="number"
                                  class="form-control"
                                  placeholder="Enter user phn number"
                                />
                              </div>
                              <div class="form-group">
                                <label class="mr-sm-2" for="inlineFormCustomSelect"
                                    >Address</label
                                  >
                                <input
                                  id="address"
                                  name="address"
                                  type="text"
                                  class="form-control"
                                  placeholder="Enter user address"
                                />
                              </div>
                            </div>
                            <button
                              type="submit"
                              style="width: 100%;margin-bottom: 10px;"
                              class="btn btn-success"
                            >
                              Update
                            </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="modal fade bd-example-modal-lg" tabindex="-1" id="vendorByProduct" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Vendor Wise Product Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                             @include('layouts.backend.user.vendor_wise_product')
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" id="vendorBySingle" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Single Vendor Wise Product Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                             @include('layouts.backend.user.vendor_wise_single_vendor')
                            
                        </div>
                    </div>
                </div>
            </div> --}}
      </section>
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
      <script>

        function updateUser(user) {
          document.getElementById("editUser").style.display = "block";
          $('#name').val(user.name);
          $('#exampleModalLongTitle').text(user.name+" "+"Bio");
          $('#email').val(user.email);
          $('#phn').val(user.phn);
          $('#address').val(user.address);
          $('#userId').val(user.id);
        }
        function closeForm(){
          document.getElementById("editUser").style.display = "none";
          $('#name').val();
          $('#email').val();
          $('#phn').val();
          $('#address').val();
        }
        // function showProduct(id,data){
        //   $.ajax({
        //       url:  "{{ route('vendor.by.product') }}",
        //       type: "POST",
        //       dataType:"html",
        //       data:{
        //           "_token": "{{ csrf_token() }}",
        //           'id':id,
        //           'data':data
        //       },
        //       success:function(response){
        //           $("#vendor-wise-product").html(response);
        //           $("#vendorByProduct").modal('show');
        //           $("#vendorBySingle").modal('hide');
        //       }
        //     });
        // }
        
        // function showSingleVen(id){
            
        //     $.ajax({
        //       url:  "{{ route('vendor.by.single') }}",
        //       type: "POST",
        //       dataType:"html",
        //       data:{
        //           "_token": "{{ csrf_token() }}",
        //           'id':id
        //       },
        //       success:function(response){
        //           $("#vendor-wise-signle").html(response);
        //           $("#vendorBySingle").modal('show');
        //       }
        //     });
        // }

          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          $('#contact-form').on('submit', function(event){
            event.preventDefault();

            userId = $('#userId').val();
            name = $('#name').val();
            email =  $('#email').val();
            phn =  $('#phn').val();
            address =  $('#address').val();

            $.ajax({
              url: "update-user",
              type: "POST",
              data:{
                  userId : userId,
                  name:name,
                  email:email,
                  phn:phn,
                  address:address
              },
              success:function(response){
                  window.location.reload();
                // console.log(response);
                // $("#test").val(response.search_user)[0].name;
                // response.search_user.forEach(ele => {
                //   $('#test').val(ele.name);
                // });
                // $('#test').val(response.search_user.name);
                // $("#contact-form")[0].reset();
              }
            });
          });

      </script>
    @endsection
@endsection
