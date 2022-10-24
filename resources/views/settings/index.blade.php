@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #4798e8;
        }
        .select2-selection--single{
            height: 37px !important;
            border: 1px solid #e9ecef !important;
        }
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Settings</h4>
                <div class="d-flex align-items-center"></div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#stripe" role="tab">
                <span class="hidden-sm-up"><i class="fa fa-stripe"></i></span>
                <span class="hidden-xs-down">Stripe</span></a>
            </li>
            @if(auth()->user()->type == 'admin')
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#twilio" role="tab" style="display: none">
                <span class="hidden-sm-up"><i class="fa fa-stripe"></i></span>
                <span class="hidden-xs-down">Twilio</span></a>
            </li>
            @endif
        </ul>
        <!-- Tab panes -->
            <div class="tab-content tabcontent-border">
                @if(auth()->user()->type == 'admin')
                <div class="tab-pane pt-20" id="twilio" role="tabpanel" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                            <form id="twilio_form" method="post">
                            <input type="hidden" name="type" value="twilio">
                            @csrf
                            <input type="hidden" id="twilio_id" name="id" value="{{ @$twilio_settings->id }}">
                            <div class="modal-body">
                                <ol class="hidden form-alert"></ol>
                                <div class="form-group">
                                    <label for="">Twilio SID* </label>
                                    <input type="text" name="twilio_sid" value="{{ @$twilio_settings->twilio_sid }}" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Twilio Token* </label>
                                    <input type="text" name="twilio_token" value="{{ @$twilio_settings->twilio_token }}" class="form-control" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select name="from_number" id="" class="form-control" required>
                                            <option value="">Select twilio number</option>
                                            @foreach($phone_numbers as $number)
                                                <option @if($twilio_settings->from_number == $number) selected @endif value="{{$number}}">{{$number}}</option>
                                            @endforeach
                                        </select>
                                        <span onclick="get_number()" class="input-group-addon btn btn-success b-0">Get Number</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                @endif

                <div class="tab-pane active p-20" id="stripe" role="tabpanel">
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php
                                    if(Auth::user()->type == 'inst'){
                                        $AdminClientID = \App\StripeSetting::where('user_id', \App\User::where('type', 'admin')->first()->id)->first()->client_id;
                                        $rurl = route("redirect_url");
                                        echo '<a href="'. env('STRIPE_AUTHORIZE_URL') .'?response_type=code&client_id='. $AdminClientID .'&scope=read_write&redirect_uri='.$rurl.'">
                                          <button class="stripe-button btn btn-info">Connect With Admin</button></a>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="" id="stripe_settings_form">
                                @csrf
                                <input type="hidden" id="stripe_id" name="stripe_id" value="{{@$stripe_settings->id}}">
                                <input type="hidden" name="type" value="stripe">
                                <div class="form-group">
                                    <label for="sendgrid_api_key">Stripe Public Key</label>
                                    <div class="input-group">
                                        <input type="password"  name="public_key" id="public_key" value="{{ @$stripe_settings->public_key }}" class="form-control" placeholder="">
                                        <span title="show/hide" class="input-group-addon btn btn-success show_password b-0"><i class="fa fa-eye text-white"></i></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sendgrid_api_key">Stripe Secret Key</label>
                                    <div class="input-group">
                                        <input type="password"  name="secret_key" id="secret_key" value="{{ @$stripe_settings->secret_key }}" class="form-control" placeholder="">
                                        <span title="show/hide" class="input-group-addon btn btn-success show_password b-0"><i class="fa fa-eye text-white"></i></span>
                                    </div>
                                </div>
                                @if(Auth::user()->type == 'admin')
                                    <div class="form-group">
                                        <label for="sendgrid_api_key">Client ID</label>
                                        <div class="input-group">
                                            <input type="password"  name="client_id" value="{{ @$stripe_settings->client_id }}" class="form-control" placeholder="">
                                            <span title="show/hide" class="input-group-addon btn btn-success show_password b-0"><i class="fa fa-eye text-white"></i></span>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button class="btn btn-success">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <!-- /.modal -->
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>

    <script>

        function get_number(){
            let sid = $('input[name=twilio_sid]');
            let token = $('input[name=twilio_token]');


            if( sid.val() == '' ){
                swal('Oops!', 'Twilio Sid Required!');
                return false;
            }
            if( token.val() == '' ){
                swal('Oops!', 'Twilio Tokem Required!');
                return false;
            }

            $.post("{{ route('settings.store') }}",
                {sid: sid.val(), token: token.val(), type: 'get_number'}, function (res) {
                    if(res.success == true){
                        $('input[name=twilio_number]').html(res.html);
                        swal('Success', res.message, 'success');
                    }else if(res.success == false){
                        swal('Warning!', res.message, 'error');
                    }

                    $('#loading').hide();
            });
        }

        $(document).ready(function() {
            var ConnectAccountStatus = '<?= session('success'); ?>';
            var ConnectAccountMessage = '<?= session('message'); ?>';
            if(ConnectAccountStatus == '1'){
                swal('Success', ConnectAccountMessage, 'success');
            }else if(ConnectAccountStatus == '0'){
                swal('Error!', ConnectAccountMessage, 'error');
            }

            $('#language').select2();

            $('#stripe_settings_form').submit(function (){
                
                
                var public_key=$('#public_key').val();
                var secret_key=$('#secret_key').val();
                if( secret_key == '' ){
                swal('Oops!', 'Stripe Secrete Key Required!');
                return false;
            }
            if( public_key == '' ){
                swal('Oops!', 'Stripe Public Key Required!');
                return false;
            }
               $('#loading').show(); 
                var data = new FormData(this);

                $.ajax({
                    url: "{{ route('settings.store') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            $('#stripe_id').val(res.id);
                            swal('Success', res.message, 'success');
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });


            $('#twilio_form').submit(function (){

                $('#loading').show();
                var data = new FormData(this);

                $.ajax({
                    url: "{{ route('settings.store') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            $('#twilio_id').val(res.id);
                            swal('Success', res.message, 'success');
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });


        });
    </script>
@endsection
