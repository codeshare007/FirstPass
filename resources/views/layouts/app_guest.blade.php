<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/regular.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/main.css') }}" class="color-switcher-link">
    <script src="{{ asset('assets/front/js/vendor/modernizr-custom.js')}}"></script>
    <link href="{{ url('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/front/js/vendor/html5shiv.min.js')}}"></script>
    <script src="{{ asset('assets/front/js/vendor/respond.min.js')}}"></script>
    <script src="{{ asset('assets/front/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <![endif]-->
    <style>
        .page_header{
            background-color: white!important;
        }
    </style>
</head>

<body class="front">

<div class="preloader" id="loading">
    <div class="preloader_image"></div>
</div>

<!--[if lt IE 9]>
<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="color-main">upgrade your browser</a> to improve your experience.</div>
<![endif]-->

<!-- wrappers for visual page editor and boxed version of template -->
<div id="canvas">
    <div id="box_wrapper">
        <!-- template sections -->

        <!--topline section visible only on small screens|-->
        <div class="header_absolute header_under_sliderx ds">
            <section class="page_topline ds c-my-10 s-overlay">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-5 text-left">
                            <span class="social-icons">
                                <a href="#" class="fa fa-facebook " title="facebook"></a>
                                <a href="#" class="fab fa-youtube " title="youtube"></a>
                                <a href="#" class="fab fa-linkedin-in " title="linkedin"></a>
                                <a href="#" class="fa fa-twitter " title="twitter"></a>
                                <a href="#" class="fa fa-google " title="google"></a>

                            </span>
                        </div>
                        <div class="col-12 col-sm-7 text-right">

                            <ul class="small-text">
                                <li>
                                    <p class="phone_number"><span>Questions?</span><a href="tel:855374-6211">(855) 374-6211</a></p>
                                </li>

                                <li>

                                    <span>
                                        @if(auth()->guest())
                                            <a href="{{ route('login') }}"><span>Login</span></a>
                                        @else
                                            <a href="{{ route('login') }}"><span>My Account</span></a>
                                            <a href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span>LogOut</span></a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                            </form>
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!--eof topline-->


            <header class="page_header ds justify-nav-end">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-4 col-md-5 col-11">
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{ asset('assets/images/logo1.png')}}" alt="">
                            </a>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-7 col-1">
                            <div class="nav-wrap">

                                <!-- main nav start -->
                                <nav class="top-nav">
                                    <ul class="nav sf-menu">
                                        <li class="active">
                                            <a href="{{ url('/') }}">Home</a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ url('driving-lessons/test-package') }}">Test Package</a>
                                        </li>
                                        <li class="active">
                                            <a href="{{ url('/contact') }}">Contact</a>
                                        </li>
                                    </ul>


                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- header toggler -->
                <span class="toggle_menu"><span></span></span>
            </header>
        </div>

        @yield('content')


        <footer class="page_footer ds s-pt-77 s-pb-60 c-gutter-60">
            <div class="container">
                <div class="row">
                    <div class="divider-20 d-none d-xl-block"></div>

                    <div class="col-md-6 col-xl-4 animate" data-animation="fadeInUp">

                        <div class="widget widget_text ">

                            <img src="{{ asset('assets/images/logo1.png')}}" style="width: 60%" alt="">
                            <p>The Leader in Defensive Driving, Traffic School & Drivers Education for both Teens and Adults.</p>
                            <p class="copyright"><i>Example.com Copyright <span class="copyright_year">&copy;{{ date('Y') }}</span></i></p>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-2 animate" data-animation="fadeInUp">
                        <div class="widget widget_working_hours">
                            <h3>Company</h3>
                            <ul class="list-not-style">

                                <li>
                                    <a href="#">About us</a>
                                </li>

                                <li>
                                    <a href="#">Courses</a>
                                </li>

                                <li>
                                    <a href="#">Instructors</a>
                                </li>

                                <li>
                                    <a href="#">Pricing</a>
                                </li>

                                <li>
                                    <a href="#">Contact us</a>
                                </li>

                            </ul>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3 animate" data-animation="fadeInUp">
                        <div class="widget widget_icons_list">
                            <h3>Contacts</h3>

                            <div class="media side-icon-box">
                                <div class="icon-styled color-main fs-14">
                                    <i class="ico icon-facebook-placeholder-for-locate-places-on-maps"></i>
                                </div>
                                <p class="media-body">USA, 3280 Cabell Avenue Alexandria, VA 22301</p>
                            </div>
                            <div class="media side-icon-box">
                                <div class="icon-styled color-main fs-14">
                                    <i class="ico icon-phone-receiver"></i>
                                </div>
                                <p class="media-body">Tel.: +1 703-518-6099</p>
                            </div>
                            <div class="media side-icon-box">
                                <div class="icon-styled color-main fs-14">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <p class="media-body">
                                    <a href="#">info@ustudi.com</a>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 animate" data-animation="fadeInUp">
                        <div class="widget widget_mailchimp">

                            <h3 class="widget-title">Subscribe</h3>

                            <p>
                                Get latest updates and offers
                            </p>

                            <form class="signup" action="">
                                <label for="mailchimp_email">
                                    <span class="screen-reader-text">Subscribe:</span>
                                </label>

                                <input id="mailchimp_email" name="email" type="email" class="form-control mailchimp_email" placeholder="Enter Your E-mail">

                                <button type="submit" class="search-submit">
                                    <span class="screen-reader-text">Subscribe</span>
                                </button>
                                <div class="response"></div>
                            </form>

                        </div>
                        <div class="row c-gutter-30">
                            <div class="col-sm-12 col-xl-6">
                                <a href="#" class="fa fa-facebook" title="facebook"><span>facebook</span></a>
                                <a href="#" class="fa fa-twitter" title="twitter"><span>twitter</span></a>
                            </div>
                            <div class="col-sm-12 col-xl-6">
                                <a href="#" class="fab fa-linkedin-in" title="linkedin"><span>linkedin</span></a>
                                <a href="#" class="fa fa-google" title="google"><span>google</span></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div><!-- eof #box_wrapper -->
</div><!-- eof #canvas -->

<div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="pull-right" aria-hidden="true">&times;</span>
            </button>


            <div class="modal-body">
                <div class="intl_conv" style="display: none">
                    <h5>Intl conversions</h5>
                    <p>Need to convert your overseas licence or simply looking to build your confidence on Australian roads?</p>
                    <p>Our instructors welcome the opportunity to assist those who may have learnt to drive in another country.</p>
                    <p>Simply book an ordinary driving lesson or lesson package. Leave a lesson note after booking if you wish to provide some additional detail regarding your driving history and specific needs.</p>
                    <p>The lesson charge is no different to a standard driving lesson.</p>
                </div>

                <div class="your_car" style="display: none">
                    <h5>Learn in your car</h5>
                    <p>Learning in your own car can be a good idea if:</p>
                    <ul>
                        <li>You are a confident learner driver about to take a driving test</li>
                        <li>You are on a provisional or unrestricted licence</li>
                        <li>You have a new car to familiarise yourself with</li>
                    </ul>
                    <p>Learning in your own car is not suitable for inexperienced or new learner drivers.</p>
                    <p>Our instructors are happy to offer lessons in your car if it is registered, roadworthy, comprehensively insured &amp; clean. Our instructors reserve the right to refuse instruction in your car if they believe your driving skills or vehicle condition are a safety risk. The instructor may wish to conduct one or more lessons in their own vehicle prior.</p>
                    <p>To learn in your own car, simply add a lesson note upon booking.</p>
                </div>

                <div class="logbook" style="display: none">
                    <h5>Logbook 1 hr = 3 hrs</h5>
                    <p>For every 1 hour structured driving lesson you complete with a licensed driving instructor, you can record 3 hours driving experience in your log book. A maximum of 10 hours of lessons will be accepted and recorded as 30 hours driving experience.</p>
                    <p>Driving lessons at night (between sunset and sunrise) count for only 1 hour of night driving. The other 2 hours are added to your day driving hours.</p>
                </div>

                <div class="driving_test" style="display: none">
                    <h5>Driving test package</h5>
                    <p>A driving test package can take much of the stress out of your test day &amp; improve your chances of getting a PASS.</p>
                    <p>You can book a driving test package with Ben as a stand alone booking or in conjunction with ordinary driving lessons. The booking form is accessed from the instructors profile page. All {{ env('APP_NAME') }} learners can also book a driving test package at any time in the future from their online account.</p>
                    <p>A driving test package is priced at $199 &amp; includes:</p>
                    <ul>
                        <li>Pick-up 1hr prior to test start time</li>
                        <li>45 min pre-test warm up</li>
                        <li>Use of instructors vehicle to sit the test</li>
                        <li>Drop-off after the test result is received</li>
                    </ul>
                    <p>Ben provides driving test packages for tests conducted at the following testing centres:</p>
                    <ul>
                        <li> Macarthur Service Centre</li>
                        <li>Liverpool Service Centre</li>
                        <li>Wetherill Park Service Centre</li>
                    </ul>
                    <br>

                    <div class="alert alert-success">
                        <ul class="fa-ul">
                            <li>

                                <i class="color-darkgrey fa fa-info-circle fa-lg fa-li" aria-hidden="true"></i>
                                <strong class="sr-only">Note:</strong>
                                Our test package books the instructor & vehicle only. You must book your own driving test with your local roads authority.

                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
    var base_url = "{{url('/')}}/";
</script>
<script src="{{ asset('assets/front/js/compressed.js')}}"></script>
<script src="{{ asset('assets/front/js/main.js')}}"></script>
<script src="{{ asset('assets/front/js/switcher.js')}}"></script>
<script src="{{ url('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
    function show_inf(id){
        $('.intl_conv, .your_car, .logbook, .driving_test').hide();
        $('.'+id).show();
        $('#info_modal').modal('show');
    }
    /* ajax post setup for csrf token */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*base url*/
    var base_url = "{{url('/')}}/";
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
</script>
@yield('script')
</body>
</html>
