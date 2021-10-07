@extends('layouts.backend.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1589.56px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User List</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="card col-12">
                    <div class="card-header">
                        <h3 class="card-title">User List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <th style="padding-right:0 !important">Name</th>
                              <th style="padding-right:0 !important">Designation</th>
                              <th style="padding-right:0 !important">Address</th>
                              <th style="padding-right:0 !important">Email</th>
                              <th style="padding-right:0 !important">Phone</th>
                              <th style="padding-right:0 !important">Status</th>
                              <th style="padding-right:0 !important">Action</th>
                          
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr role="row" class="odd">
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <p class="badge badge-success">{{ $user->role }}</p>
                                        </td>
                                        <td>{{ Illuminate\Support\Str::limit($user->address,15) }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($user->email,30) }}</td>
                                        <td>{{ $user->phn }}</td>
                                        <td>
                                            @if ($user->verified == 0)
                                                <p class="badge badge-warning">Not Verified</p>
                                            @else
                                                <p class="badge badge-success">Verified</p>
                                            @endif
                                        </td>

                                        <td >
                                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModalCenter"
                                                onclick="updateUser({{ $user }})">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <!--<button onclick="deleteUser({{ $user->id }})"-->
                                            <!--    class="btn btn-danger btn-sm">-->
                                            <!--    <i class="fa fa-trash"></i>-->
                                            <!--</button>-->
                                        </td>
                                    </tr>
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
                    <div id="editUser" style="
                        height: 100%;
                        display: none;
                    ">
                        <form role="form" id="contact-form">
                            @csrf
                            <div class="card-body" style="padding-top: 5px !important;padding-bottom:5px !important;">
                                <div class="form-group">
                                    <input type="text" id="userId" name="userId" hidden>
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Name</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                        placeholder="Enter user name" />
                                </div>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Email</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                        placeholder="Enter user email" />
                                </div>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Phone Number</label>
                                    <input id="phn" name="phn" type="number" class="form-control"
                                        placeholder="Enter user phn number" />
                                </div>
                                <div class="form-group">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Address</label>
                                    <input id="address" name="address" type="text" class="form-control"
                                        placeholder="Enter user address" />
                                </div>
                            </div>
                            <button type="submit" style="width: 100%;" class="btn btn-success">
                                Update
                            </button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
        </section>
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
        function updateUser(user) {
            document.getElementById("editUser").style.display = "block";
            $('#name').val(user.name);
            $('#exampleModalLongTitle').text(user.name+" "+"Bio");
            $('#email').val(user.email);
            $('#phn').val(user.phn);
            $('#address').val(user.address);
            $('#userId').val(user.id);
        }

        function closeForm() {
            document.getElementById("editUser").style.display = "none";
            $('#name').val();
            $('#email').val();
            $('#phn').val();
            $('#address').val();
        }

        // function deleteUser(id) {
        //     id = id;
        //     $.ajax({
        //         url: "delete-user",
        //         type: "POST",
        //         data: {
        //             id: id
        //         },
        //         success: function(response) {
        //             window.location.reload();
        //         }
        //     });
        // }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#contact-form').on('submit', function(event) {
            event.preventDefault();

            userId = $('#userId').val();
            name = $('#name').val();
            email = $('#email').val();
            phn = $('#phn').val();
            address = $('#address').val();

            $.ajax({
                url: "update-user",
                type: "POST",
                data: {
                    userId: userId,
                    name: name,
                    email: email,
                    phn: phn,
                    address: address
                },
                success: function(response) {
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
    {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#contact-form').on('submit', function(event) {
            event.preventDefault();

            name = $('#name').val();
            email = $('#email').val();
            phn = $('#phn').val();
            address = $('#address').val();

            $.ajax({
                url: "search-user",
                type: "POST",
                data: {
                    name: name
                },
                success: function(response) {
                    console.log(response.search_user);
                    $("#test").val(response.search_user)[0].name;
                    // response.search_user.forEach(ele => {
                    //   $('#test').val(ele.name);
                    // });
                    // $('#test').val(response.search_user.name);
                    $("#contact-form")[0].reset();
                }
            });
        });

    </script> --}}
@endsection
@endsection
