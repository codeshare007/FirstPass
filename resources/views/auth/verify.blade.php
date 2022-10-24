<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{url('')}}/">
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
    <style>
        .auth-wrapper .auth-box{max-width: 500px}
    </style>
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
                    <h5 class="font-medium m-b-20">Verify Your Email Address</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
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
