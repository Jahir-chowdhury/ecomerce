@extends('layouts.frontend.app')

@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('/assets/images/page-header-bg.jpg')">
		<div class="container" style="height: 200px !important">
			<h1 class="page-title" style="padding-top:5rem !important; color:#333 !important">Contact Us<span>Pages</span></h1>
		</div><!-- End .container -->
	</div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact us</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content pb-0">
        <div class="container">
        	<div class="row">
        		<div class="col-lg-4 mb-2 mb-lg-0">
        			<h2 class="title mb-1">Contact Address</h2><!-- End .title mb-2 -->
        			<div class="row">
        				<div class="col-sm-12">
        					<div class="contact-info">
        						<ul class="contact-list">
        							<li>
        								<i class="icon-map-marker"></i>
            							{{ optional($setting)->address }}
            						</li>
        							<li>
        								<i class="icon-phone"></i>
        								<a href="tel:{{ optional($setting)->contact }}">{{ optional($setting)->contact }}</a>
        							</li>
        							<li>
        								<i class="icon-envelope"></i>
        								<a href="mailto:{{ optional($setting)->email }}">{{ optional($setting)->email }}</a>
        							</li>
        						</ul><!-- End .contact-list -->
        					</div><!-- End .contact-info -->
        				</div><!-- End .col-sm-7 -->

        			</div><!-- End .row -->
        		</div><!-- End .col-lg-6 -->
        		<div class="col-lg-8">
        			<h2 class="title mb-1">Got Any Questions?</h2><!-- End .title mb-2 -->
        			<p class="mb-2">Use the form below to get in touch with us.</p>

        			<form action="{{ route('contact.store') }}" method="POST" class="contact-form mb-3">
        			        @csrf
        				<div class="row">
        					<div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
        						<input type="text" name="name" class="form-control" id="cname" placeholder="Name *" required>
        					</div><!-- End .col-sm-6 -->

        					<div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
        						<input type="email" name="email" class="form-control" id="cemail" placeholder="Email *" required>
        					</div><!-- End .col-sm-6 -->
        				</div><!-- End .row -->

        				<div class="row">
        					<div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
        						<input type="tel" name="phone" class="form-control" id="cphone" placeholder="Phone *" required>
        					</div><!-- End .col-sm-6 -->

        					<div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
        						<input type="text" name="subject" class="form-control" id="csubject" placeholder="Subject">
        					</div><!-- End .col-sm-6 -->
        				</div><!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
        				<textarea class="form-control" name="message" cols="30" rows="4" id="cmessage" required placeholder="Message *"></textarea>

        				<button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
        					<span>SUBMIT</span>
    						<i class="icon-long-arrow-right"></i>
        				</button>
        			</form><!-- End .contact-form -->
        		</div><!-- End .col-lg-6 -->
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
