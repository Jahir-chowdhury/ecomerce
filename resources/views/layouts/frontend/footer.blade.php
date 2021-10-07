<footer class="footer footer-3">

    <div class="footer-middle border-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="widget widget-about">
                        <a href="{{ route('home') }}">
                            <img src="/images/{{ optional($setting)->logo }}" class="footer-logo" alt="Footer Logo"
                            width="105" height="25">
                        </a>
                        
                        <p>{{ optional($setting)->description }} </p>

                        <div class="widget-about-info">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <span class="widget-about-title">Got Question? Call us 24/7</span>
                                    <a href="tel:123456789">{{ optional($setting)->contact }}</a>
                                </div>
                                <!-- End .col-sm-6 -->
                                <div class="col-sm-6 col-md-8">
                                    <span class="widget-about-title">Payment Method</span>
                                    <figure class="footer-payments">
                                        <img src="/assets/images/payments.png" alt="Payment methods" width="272"
                                            height="20">
                                    </figure>
                                    <!-- End .footer-payments -->
                                </div>
                                <!-- End .col-sm-6 -->
                            </div>
                            <!-- End .row -->
                        </div>
                        <!-- End .widget-about-info -->
                    </div>
                    <!-- End .widget about-widget -->
                </div>
                <!-- End .col-sm-12 col-lg-3 -->

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">Information</h4>
                        <!-- End .widget-title -->
                        <ul class="widget-list">
                            <li><a href="{{ route('about.us') }}">About Us</a></li>
                            <li><a href="{{ route('user.contact') }}">Contact Us</a></li>
                        </ul>
                        <!-- End .widget-list -->
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-sm-4 col-lg-3 -->

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <!-- End .widget-title -->
                        <ul class="widget-list">
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Terms and Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                        <!-- End .widget-list -->
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-sm-4 col-lg-3 -->

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <!-- End .widget-title -->

                        <ul class="widget-list">
                        @auth
                            <li><a href="{{route('cart',auth()->user()->name)}}">View Cart</a></li>
                            <li><a href="{{route('wishlist',auth()->user()->name)}}">My Wishlist</a></li>
                            <li>
                                <a href="{{ route('user.logout') }}">
                                    <i style="font-size: 15px;
                                        margin-right: 5px;cursor: pointer;" class="la la-sign-out"></i>
                                    Sign Out
                                </a>
                            </li>
                        @else
                            <li><a href="#signin-modal" data-toggle="modal">Sign In</a></li>
                        @endauth
                            
                        </ul>
                        <!-- End .widget-list -->
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-sm-64 col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .footer-middle -->

    <div class="footer-bottom footer-dark">
        <div class="container">
            <p class="footer-copyright">Developed by <a style="margin-right:100px;" href="https://www.ideatechsolution.com/">Idea Tech Solution.</a>Copyright Anar.com.bd © 2020.</p>
            <!-- End .footer-copyright -->
            <ul class="footer-menu">
                <li><a href="#">Terms Of Use</a></li>
                <li><a href="#">Privacy Policy</a></li>
            </ul>
            <!-- End .footer-menu -->

            <div class="social-icons social-icons-color">
                <span class="social-label">Social Media</span>

                <a href="{{ optional($setting)->fb_link }}" class="social-icon social-facebook" title="Facebook" target="_blank"><i
                        class="icon-facebook-f"></i></a>
                <a href="{{ optional($setting)->twitt_link }}" class="social-icon social-twitter" title="Twitter" target="_blank"><i
                        class="icon-twitter"></i></a>
                <a href="{{ optional($setting)->insta_link }}" class="social-icon social-instagram" title="Instagram" target="_blank"><i
                        class="icon-instagram"></i></a>
                <a href="{{ optional($setting)->tube_link }}" class="social-icon social-youtube" title="Youtube" target="_blank"><i
                        class="icon-youtube"></i></a>
            </div>
            <!-- End .soial-icons -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .footer-bottom -->
</footer>
<!-- End .footer -->
</div>
<!-- End .page-wrapper -->

<button style="background: #9889a0;border-radius: 10px;color: #fff;" id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>







<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div>
<!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>
        @auth
        <div class="classMy">
            <a href="{{route('user',auth()->user()->name)}}">
                <h4 style="color: #2a2a3299; font-size: 15px !important; padding: 5px;"> {{ auth()->user()->name }}</h4>
            </a>
        </div>
        @endauth

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab"
                    aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab"
                    aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                    @auth
                        <li><a href="#">E-Money
                            <span class="badge badge-warning">{{auth()->user()->e_money}}</span></a>
                        </li>
                        <li><a href="{{route('cart',auth()->user()->name)}}">Cart List
                            <span class="badge badge-primary" id="count1">{{$count1}}</span></a>
                        </li>
                        <li><a href="{{route('wishlist',auth()->user()->name)}}">Wish List
                            <span class="badge badge-primary" id="count">{{$count}}</span></a>
                        </li>
                        <li><a href="{{route('user',auth()->user()->name)}}">View Profile</a></li>
                        <li><a href="{{ route('user.logout') }}">Logout</a></li>
                    @else
                        <li><a href="#">Visible only for authenticated users</a></li>
                    @endauth


                   </ul>
                </nav>
                <!-- End .mobile-nav -->
            </div>
            <!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        @foreach ($categories as $cat)
                            <li><a href="{{route('category',$cat->cat_name)}}">{{ $cat->cat_name }}</a></li>
                        @endforeach

                    </ul>
                    <!-- End .mobile-cats-menu -->
                </nav>
                <!-- End .mobile-cats-nav -->
            </div>
            <!-- .End .tab-pane -->
        </div>
        <!-- End .tab-content -->

        <div class="social-icons">
            <a href="{{ optional($setting)->fb_link }}" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="{{ optional($setting)->twitt_link }}" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="{{ optional($setting)->insta_link }}" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="{{ optional($setting)->tube_link }}" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div>
        <!-- End .social-icons -->
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab"
                                    aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                    aria-controls="register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                aria-labelledby="signin-tab">
                                <form action="{{route('user.login')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="singin-email">Email address *</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter username / email"
                                            required>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" class="form-control"
                                            name="password" placeholder="Enter password" required>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember
                                                Me
                                            </label>
                                        </div>
                                        <!-- End .custom-checkbox -->

                                        <a style="float: left" href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div>
                                    <!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <a href="{{url('/login/google')}}" class="btn btn-login btn-g">
                                                <i class="icon-google"></i> Login With Google
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="{{url('/login/facebook')}}" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i> Login With Facebook
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .form-choice -->
                            </div>
                            <!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="{{route('user.store')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="register-email">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                name="name" placeholder="Enter name" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="email"
                                                name="email" placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="register-email">Phone Number</label>
                                            <input type="text" class="form-control" id="phn"
                                                name="phn" placeholder="01xxxxxxxxx" maxlength="11" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="password"
                                                name="password" placeholder="Enter password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="register-email">Address</label>
                                            <input type="text" class="form-control" id="address"
                                                name="address" placeholder="Enter address" required>
                                        </div>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy"
                                                required>
                                            <label class="custom-control-label" for="register-policy">I agree to the <a
                                                    href="#">privacy policy</a> *</label>
                                        </div>
                                        <!-- End .custom-checkbox -->
                                    </div>
                                    <!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">Or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i> Login With Google
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i> Login With Facebook
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .form-choice -->
                            </div>
                            <!-- .End .tab-pane -->
                        </div>
                        <!-- End .tab-content -->
                    </div>
                    <!-- End .form-tab -->
                </div>
                <!-- End .form-box -->
            </div>
            <!-- End .modal-body -->
        </div>
        <!-- End .modal-content -->
    </div>
    <!-- End .modal-dialog -->
</div>
<!-- End .modal -->



<script>
    //page top advertisements
    function closeAdd() {
        $('#newsletter-headadd').css('display', 'none')
    }

</script>


<!-- Plugins JS File -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/superfish.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>

<script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/demos/demo-13.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
@yield('js')

<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>


</body>
</html>
