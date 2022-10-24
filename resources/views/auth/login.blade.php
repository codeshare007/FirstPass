<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{url('/')}}/">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>{{env('APP_NAME')}}</title>
    <!-- Custom CSS -->
    <link href="assets/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/banner.png) no-repeat center center; background-color:#f9f9f9 ">
        <div class="auth-box on-sidebarx" style=" opacity: 0.96;">
            <div id="loginform">
                <div class="logo">
                    <span class="db"><img src="assets/images/logo.png" alt="logo" height="50px" /></span>
                    <hr>
                    <h5 class="font-medium m-b-20">Sign In</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal m-t-20" id="loginform" method="POST" action="{{ route('login') }}" style="display: block;">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                </div>

                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>

                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-label="Password" aria-describedby="basic-addon1">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forget password?</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                                </div>
                            </div>
                            {{--<div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <div class="social">
                                        <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fab  fa-facebook"></i> </a>
                                        <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fab  fa-google-plus"></i> </a>
                                    </div>
                                </div>
                            </div>--}}
                            <div class="form-group m-b-0 m-t-10">
                                @if (Route::has('register'))
                                <div class="col-sm-12 text-center">
                                    Want to join our team? <a href="{{ route('register') }}" class="text-info m-l-5"><b>Request to register</b></a>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    $('form').submit(function () {
        $(".preloader").fadeIn();
    })

</script>
</body>

</html>
