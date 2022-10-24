<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{url('')}}/">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="assets/css/style.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="{{ url('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="preloader" id="loading">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                    <i class="ti-menu ti-close"></i>
                </a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text text-white">
                           <srtong><b>FirstPass</b></srtong>
                    </span>
                </a>

                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti-more"></i>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="sl-icon-menu font-20"></i>
                        </a>
                    </li>

                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">
                    @if(auth()->user()->type == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('notifications') }}">
                                <i class="far fa-bell"></i>
                                <span class="badge badge-warning navbar-badge">{{ getNotificationCount() }}</span>
                            </a>
                        </li>
                    @endif

                     @if(auth()->user()->type == 'inst')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('instructor/notifications') }}">
                                <i class="far fa-bell"></i>
                                <span class="badge badge-warning navbar-badge">{{ getInstructorNotificationCount(auth()->user()->id) }}</span>
                            </a>
                        </li>
                    @endif
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            {{ auth()->user()->name }}
                            @if( auth()->user()->avatar == '')
                                <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="image_preview rounded-circle" width="31">
                            @else
                                <img src="{{ url('assets/images/users/'.auth()->user()->avatar) }}" alt="user" class="image_preview rounded-circle" width="31">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                            <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                <div class="">
                                    @if( auth()->user()->avatar == '')
                                        <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="image_preview img-circle" width="60">
                                    @else
                                        <img src="{{ url('assets/images/users/'.auth()->user()->avatar) }}" alt="user" class="image_preview img-circle" width="60">
                                    @endif
                                </div>
                                <div class="m-l-10">
                                    <h4 class="m-b-0"> {{ ucwords(Auth::user()->name) }}</h4>
                                    <p class=" m-b-0"> {{ auth()->user()->email }}</p>
                                </div>
                            </div>

                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="ti-user m-r-5 m-l-5"></i>@if(auth()->user()->type == 'inst') Personal Details @else  My Profile @endif </a>
                            @if(auth()->user()->type == 'inst')
                            <a class="dropdown-item" href="{{ route('profile/vehicle') }}">
                                <i class="ti-car m-r-5 m-l-5"></i> My Profile & Vehicle
                            </a>
                            <a class="dropdown-item" href="{{ route('services_availability') }}">
                                <i class="ti-car m-r-5 m-l-5"></i> Services & Availability
                            </a>
                            <a class="dropdown-item" href="{{ route('my_documents') }}">
                                <i class="ti-dashboard m-r-5 m-l-5"></i> My Documents
                            </a>
                            @endif

                            <?php
                            $session = Session::get('master_control');
                            if($session=="admin" || $session=="support"){
                            if($session == "admin"){
                                $back_to = "Back to Admin";
                            }elseif ($session == "support"){
                                $back_to= "Back to Support";
                            }
                            ?>
                            <a class="dropdown-item active" href="{{ route('back_to_admin') }}">
                                <i class="fa fa-sign-in-alt"></i> {{ $back_to }}
                            </a>
                            <?php
                            }
                            ?>

                            <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            <div class="dropdown-divider"></div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home') }}" aria-expanded="false">
                            <i class="icon-Car-Wheel"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    @if(auth()->user()->type == 'inst')
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('appointments.index') }}" aria-expanded="false">
                                <i class="fa fa-calendar-alt"></i>
                                <span class="hide-menu"> Lessons </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('settings.index') }}" aria-expanded="false">
                                <i class="fa fa-credit-card"></i>
                                <span class="hide-menu"> Payments </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('instructor_calendar') }}" aria-expanded="false">
                                <i class="fa fa-calendar"></i>
                                <span class="hide-menu"> Calendar </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('instructor/notifications') }}" aria-expanded="false">
                                <i class="far fa-bell"></i>
                                <span class="hide-menu">Notifications</span>
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->type == 'learner')
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('lessons.index') }}" aria-expanded="false">
                                <i class="fa fa-calendar-alt"></i>
                                <span class="hide-menu"> Lessons </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('learner.purchases') }}" aria-expanded="false">
                                <i class="fa fa-credit-card"></i>
                                <span class="hide-menu"> Purchases </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('learner.faqs') }}" aria-expanded="false">
                                <i class="fa fa-question-circle"></i>
                                <span class="hide-menu"> FAQ </span>
                            </a>
                        </li>
                    @endif


                    @if(auth()->user()->type == 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('users') }}" aria-expanded="false">
                            <i class="fa fa-user"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('regions') }}" aria-expanded="false">
                            <i class="fa fa-map-marker"></i>
                            <span class="hide-menu">Regions</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('test-package') }}" aria-expanded="false">
                            <i class="fa fa-map-marker"></i>
                            <span class="hide-menu">Test Package</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('cars') }}" aria-expanded="false">
                            <i class="fa fa-car"></i>
                            <span class="hide-menu">Manage Cars</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('notifications') }}" aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <span class="hide-menu">Notifications</span>
                        </a>
                    </li>

                    <!--<li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('twilio.index') }}" aria-expanded="false">
                            <i class="fa fa-map-marker"></i>
                            <span class="hide-menu">Twilio Messages</span>
                        </a>
                    </li>-->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('settings.index') }}" aria-expanded="false">
                                <i class="fa fa-credit-card"></i>
                                <span class="hide-menu"> Payments </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-cog"></i>
                                <span class="hide-menu">Settings </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('twiliosettings') }}" class="sidebar-link">
                                        <span class="hide-menu"> Twilio </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('email_settings') }}" class="sidebar-link">
                                        <span class="hide-menu"> Email </span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    @endif

                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <div class="page-wrapper">
        @yield('content')

    <footer class="footer text-center">
        All Rights Reserved by {{ env('APP_NAME') }}.
    </footer>

</div>
</div>

<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="assets/js/app.min.js"></script>
<script src="assets/js/app.init.iconbar.js"></script>
<script src="assets/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="assets/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="assets/js/custom.min.js"></script>
<script src="{{ url('assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="assets/libs/toastr/build/toastr.min.js"></script>

<script>
    /* ajax post setup for csrf token */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*base url*/
    var base_url = document.URL.substr(0,document.URL.lastIndexOf('/'));

    $(document).on('click', '.show_password', function () {
        console.log('ok');

        var input = $(this).parent().parent().find('input');

        if( input.attr('type') == 'password' ){
            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            input.attr('type', 'text');
        }else{
            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            input.attr('type', 'password');
        }
    })
    toastr.options = {
     "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000
    };
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@yield('scripts')
</body>
</html>

