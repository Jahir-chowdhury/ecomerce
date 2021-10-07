@extends('layouts.frontend.app')

@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('/assets/images/page-header-bg.jpg')">
		<div class="container" style="height: 200px !important">
			<h1 class="page-title" style="padding-top:5rem !important; color:#333 !important">About Us<span>Pages</span></h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        
                        {!! htmlspecialchars_decode($about->description) !!}
                        
                    </div><!-- End .about-text -->
                </div><!-- End .col-lg-10 offset-1 -->
            </div><!-- End .row -->
            
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
        
        <hr class="mt-4 mb-3">
@section('js')
    <script>
        window.onload=(function(){
            $("#showCategory").hide();
        });

        function showDropdown(){
            $("#showCategory").show();
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
                    window.location.reload();
                }
            })
        }
 
 
    </script>
    
@endsection
@endsection
