<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>{{env('APP_NAME')}}</title>
    <!-- Custom CSS -->
    <link href="{{asset('assets/css/style.min.css')}}" rel="stylesheet">
    <base href="{{url('')}}/">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .error-title{font-size: 150px!important;}
    </style>
</head>

<body>
<div class="main-wrapper">

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="error-box">
        <div class="error-body text-center">
        <h1 class="error-title text-info"><i class="fa fa-paper-plane"></i></h1>
        <h3 class="text-uppercase error-subtitle">Thank You for Your Interest <span class="text-info">{{ ucwords( auth()->user()->name ) }}</span>, </h3>
        <p class="text-muted m-t-30 m-b-30">We will be in touch within one business day</p>
        <a href="{{url('/')}}" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
    </div>
</div>

<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>
</body>
</html>