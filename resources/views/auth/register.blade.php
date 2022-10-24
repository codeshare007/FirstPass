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
    <link href="{{ asset('assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/intlTelInput.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .auth-wrapper .auth-box{
            max-width: 460px;
            width: 100%;
        }
        .lbl{width: 100%; display: block; margin-bottom: 2px}
        .radio{margin-right: 15px}
        .radio input {
            margin-right: 5px;
        }
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

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="position: relative; background:url(assets/images/banner.png) no-repeat left center; background-color:#f9f9f9 ">
        <p style="position: absolute;  top: 3%;left: 27%;"><img height="55" src="assets/images/logo.png" alt=""></p>
        <div style="position: absolute;  top: 15%;left: 21%;">
            <h2>It’s easy to get started!</h2>
            <p style="font-size: 16px">No contracts, no exclusivity & no franchise fees. Enter your details and <br> we’ll be in touch to answer your questions and get you started.</p>
        </div>
        <div class="auth-box on-sidebar">
            <div id="loginform">
                <div class="logo">
                    <h5 class="font-medium m-b-20">Instructor Sign Up</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form id="reg_form">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <label class="lbl">First Name<span class="text-danger">*</span></label>
                                        <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <label class="lbl">Last Name<span class="text-danger">*</span></label>
                                        <input id="lname" type="text" class="form-control form-control-lg @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus>

                                        @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-2">
                                <label class="lbl">Email<span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-2">
                                <label class="lbl">Phone<span class="text-danger">*</span></label>
                                <input id="phone" type="tel" placeholder="0433 111 222" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-group mb-2">
                                <label class="lbl">Postcode<span class="text-danger">*</span></label>
                                <input id="postcode" type="text" placeholder="2000" class="form-control form-control-lg @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode">
                                @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- <div class="input-group mb-2">
                                <label class="lbl">Password<span class="text-danger">*</span></label>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> -->

                            <div class="input-group mb-2">
                                <label class="lbl">Vehicle transmission/s<span class="text-danger">*</span></label>
                                <div class="input-group m-t-10">
                                    <input type="hidden" name="enquiry_message[vehicle_transmissions]" value="">
                                    <div class="radio">
                                        <label for="auto">
                                            <input required="required" type="radio"  @if(old('vehicle_transmissions') == "auto") checked @endif value="auto" name="vehicle_transmissions" id="auto">Auto</label>
                                    </div>
                                    <div class="radio">
                                        <label for="manual">
                                            <input required="required" type="radio" @if(old('vehicle_transmissions') == "manual") checked @endif value="manual" name="vehicle_transmissions" id="manual">Manual</label>
                                    </div>
                                    <div class="radio">
                                        <label for="both">
                                            <input required="required" type="radio" @if(old('vehicle_transmissions') == "both") checked @endif value="both" name="vehicle_transmissions" id="both">Both</label>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-2">
                                <label class="lbl">Leave us a message</label>
                                <textarea name="message" class="form-control" style="resize: none;" rows="3">{!! old('message') !!}</textarea>
                            </div>

                            <div class="form-group text-center ">
                                <div class="col-xs-12 p-b-20 ">
                                    <button type="submit" class="btn btn-block btn-lg btn-info ">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group m-b-0 m-t-5 ">
                                <div class="col-sm-12 text-center ">
                                    Already have an account? <a href="{{ route('login') }}" class="text-info m-l-5 "><b>Sign In</b></a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="{{ asset('assets/front/js/intlTelInput.js') }}"></script>

<script src="assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

<script>

    $(document).ready(function(){

        //Swal.fire('Success', 'hi', 'success');

        $('input[name="phone"]').intlTelInput({
            utilsScript: '{{ asset('assets/front/js/intlTelInput.js') }}',
            autoPlaceholder: true,
            preferredCountries: ['au'],
            allowDropdown: false,
            separateDialCode: true,
            onlyCountries: ["au"],
        });

        $('input[name="phone"]').intlTelInput("setCountry", "au");




        $('#reg_form').submit(function (){

                $('.preloader').show();

                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('register_inst')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            Swal.fire('Success', res.message, 'success');
                            $('#reg_form')[0].reset();
                        }else if(res.success == false){
                            Swal.fire('Warning!', res.message, 'error');
                        }

                        $('.preloader').hide();
                    },
                    error: function () {
                        $('.preloader').hide();
                    }

                });

                return false;
            });

    });


    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    $('form').submit(function () {
        $(".preloader").fadeIn();
    })
</script>
</body>

</html>



