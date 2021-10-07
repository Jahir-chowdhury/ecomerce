<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Anar.com.bd') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet"http://code.ionicframework.com/1.3.3/css/ionic.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/image49.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/image49.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/image49.png') }}">

    <link rel="stylesheet"http://code.ionicframework.com/1.3.3/css/ionic.min.css">

    {{-- <link rel="stylesheet" href="../../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}

    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-bs4.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">

    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
@include('sweetalert::alert')
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
          </li>
        </ul>

 

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            
            <!--<li class="form-inline ml-3">-->
            <!--    <a href="{{route('sales.history')}}" class="btn btn-outline-info btn-sm">-->
            <!--        Orders Pending-->
            <!--        <span style="margin-left:10px;" class="badge badge-warning navbar-badge">-->
            <!--            1-->
            <!--        </span>-->
            <!--    </a>-->
            <!--</li>-->
            
          <!-- Notifications Dropdown Menu -->
          <!--<li class="nav-item dropdown">-->
          <!--  <a class="nav-link" data-toggle="dropdown" href="#">-->
          <!--    <i class="far fa-bell"></i>-->
          <!--    <span class="badge badge-warning navbar-badge">15</span>-->
          <!--  </a>-->
          <!--  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
          <!--    <span class="dropdown-header">15 Notifications</span>-->
          <!--    <div class="dropdown-divider"></div>-->
          <!--    <a href="{{route('sales.history')}}" class="dropdown-item">-->
          <!--      <i class="fas fa-envelope mr-2"></i> Pending Orders-->
          <!--      <span class="float-right badge badge-warning text-sm">-->
          <!--          5-->
          <!--      </span>-->
          <!--    </a>-->
          <!--    <div class="dropdown-divider"></div>-->
          <!--    <a href="{{ route('refund.view') }}" class="dropdown-item">-->
          <!--      <i class="fas fa-users mr-2"></i> Refund Orders-->
          <!--      <span class="float-right badge badge-warning text-sm">-->
                    
          <!--      </span>-->
          <!--    </a>-->
          <!--</li>-->
          
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i style="color:red;" class="fas fa-power-off"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            <a href="{{route('logout')}}" class="dropdown-item">
               Logout <i style="float: right; padding-top:5px;" class="fas fa-sign-out-alt"></i>
              </a>
            </div>
          </li>
          
          
        </ul>
      </nav>
