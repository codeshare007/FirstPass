@extends('layouts.app')
@section('content')
    <style>
        .card{ background-color: #f5f5f5
        }
    </style>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Email Settings</h4>
                <div class="d-flex align-items-center">
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">EMAIL SUBJECTS</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SIGN UP EMAIL</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BLOCK USER EMAIL</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#account_confirm" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">ACCOUNT CONFIRM EMAIL</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#new_user" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">NEW USER EMAIL</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cancel_user" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">USER CANCEL EMAIL</span></a> </li>
            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#appt_email" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down text-uppercase">Booking EMAIL</span></a> </li>
        </ul>
        <!-- Tab panes -->
        <form class="form-horizontal" id="email_form" >
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active p-20" id="home" role="tabpanel">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>
                            <div class="form-group row">
                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Confirm Email Subject</label>
                                <div class="col-sm-9">
                                    <input value="{{ isset($setting->confirm_subject)? $setting->confirm_subject: '' }}" type="text" class="form-control" id="fname" name="confirm_subject" placeholder="Confirm Email Subject">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">Block Email Subject</label>
                                <div class="col-sm-9">
                                    <input value="{{ isset($setting->block_subject)? $setting->block_subject: '' }}" type="text" class="form-control" id="lname" name="block_subject" placeholder="Block Email Subject">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Sign-up Email Subject</label>
                                <div class="col-sm-9">
                                    <input value="{{ isset($setting->signup_subject)? $setting->signup_subject: '' }}" type="text" class="form-control" id="email1" name="signup_subject" placeholder="Sign Up Email Subject">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">New User Email Subject</label>
                                <div class="col-sm-9">
                                    <input value="{{ isset($setting->newuser_subject)? $setting->newuser_subject: '' }}" type="text" class="form-control" id="cono1" name="newuser_subject" placeholder="New User Email Subject">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label"> User Cancel Email Subject</label>
                                <div class="col-sm-9">
                                    <input value="{{ isset($setting->usercancel_subject)? $setting->usercancel_subject: '' }}" type="text" class="form-control" id="cono1" name="usercancel_subject" placeholder="Contact No Here">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label"> Booking Email Subject</label>
                                <div class="col-sm-9">
                                    <input value="{{ isset($setting->appt_subject)? $setting->appt_subject: '' }}" type="text" class="form-control" id="cono1" name="appt_subject" placeholder="Contact No Here">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-20" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Sign Up Email:</h4>

                                    <textarea id="signup_body" name="signup_body">
                                    {!! isset($setting->signup_body)? $setting->signup_body: ''  !!}
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-20" id="appt_email" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Booking Email:</h4>

                                    <textarea id="appt_body" name="appt_body">
                                    {!! isset($setting->appt_body)? $setting->appt_body: ''  !!}
                                </textarea>

                                    <div class="form-group d-block mt-2">
                                        <label for="">Choose Personalize...</label>
                                        <div class="btn-groups w-100">

                                            <button type="button" class="btn btn-primary" onclick="tinymce.get('appt_body').insertContent($(this).val());" value="%FIRST_NAME%">First Name</button>
                                            <button type="button" class="btn btn-primary" onclick="tinymce.get('appt_body').insertContent($(this).val());" value="%LAST_NAME%">Last Name</button>
                                            <button type="button" class="btn btn-primary" onclick="tinymce.get('appt_body').insertContent($(this).val());" value="%EMAIL%">Email</button>
                                            <button type="button" class="btn btn-primary" onclick="tinymce.get('appt_body').insertContent($(this).val());" value="%PHONE%">Phone</button>
                                            <button type="button" class="btn btn-primary" onclick="tinymce.get('appt_body').insertContent($(this).val());" value="%ADDRESS%">Address</button>
                                            <button type="button" class="btn btn-primary" onclick="tinymce.get('appt_body').insertContent($(this).val());" value="%BOOK_DATE%">Booking date</button>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-20" id="messages" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Block User Email:</h4>
                                    <textarea id="block_body" name="block_body">
                                   {!! isset($setting->block_body)? $setting->block_body: ''  !!}
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-20" id="account_confirm" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Account Confirm Email:</h4>
                                    <textarea id="confirm_body" name="confirm_body">
                                     {!! isset($setting->confirm_body)? $setting->confirm_body: ''  !!}
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-20" id="new_user" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">New User Email:</h4>
                                    <textarea id="new_body" name="new_body">
                                    {!! isset($setting->new_body)? $setting->new_body: ''  !!}
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-20" id="cancel_user" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">User Cancel Email:</h4>
                                    <textarea id="cancel_body" name="cancel_body">
                                    {!! isset($setting->cancel_body)? $setting->cancel_body: ''  !!}
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group m-b-0 text-right">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <h4 class="card-title m-t-40">Email Configration</h4>

            <div class="card">
                <div class="card-body">
                    <form id="mailSettingForm" novalidate autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ isset( $data->id ) ? $data->id : '' }}">

                        <!-- radio for Use Emailing API / Use SMTP -->
                        <label for="choose_emailing_type">Which type of emailing do you want to use?</label>
                        <div class="form-group" id="choose_emailing_type">
                            <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio2" value="smtp" name="email_type" <?php echo (isset($data->email_type)?( ($data->email_type=='smtp')?'checked':'' ):'');  ?> >
                                <label for="inlineRadio2"> Use SMTP</label>
                            </div>
                            <div class="radio radio-inline">
                                <input type="radio" id="inlineRadio1" value="api" name="email_type" <?php echo (isset($data->email_type)?( ($data->email_type=='api')?'checked':'' ):'');  ?> >
                                <label for="inlineRadio1"> Use Emailing API</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="clearfix"></div>
                        <!-- fields hiding and showing on radio selection for Emailing API / SMTP -->
                        <div class="form-group">
                            <div class="col-md-12 <?php if(isset($data->email_type)){ if($data->email_type=='smtp'){ echo ''; }else{ echo 'hide'; } }else{ echo 'hide'; }?>" id="smtp">

                                <div class="form-group">
                                    <label for="smtp_host">SMTP Host</label>
                                    <input type="text" name="smtp_host" value="{!! isset($data->smtp_host) ? $data->smtp_host : '' !!}" class="form-control" id="smtp_host" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="smtp_port">SMTP Port</label>
                                    <input type="text" name="smtp_port" value="{!! isset($data->smtp_port) ? $data->smtp_port : '' !!}" class="form-control" id="smtp_port" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="using_ssl"> Using SSL SMTP?</label>
                                    <div class="checkbox checkbox-inverse">
                                        <input id="using_ssl" type="checkbox" name="use_ssl" value="yes" <?php echo (isset($data->use_ssl)?( ($data->use_ssl=='yes')?'checked':'' ):'');  ?> >
                                        <label for="using_ssl"> Yes </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="smtp_username">SMTP Username</label>
                                    <input type="text" name="smtp_username" value="{!! isset($data->smtp_username) ? $data->smtp_username : '' !!}" class="form-control" id="smtp_username" placeholder="" >
                                </div>
                                <div class="form-group">
                                    <label for="smtp_password">SMTP Password</label>
                                    <div class="input-group">
                                        <input type="text" name="smtp_password" value="{!! isset($data->smtp_password) ? $data->smtp_password : '' !!}" class="form-control" id="smtp_password" placeholder="" >
                                        <div class="input-group-append">
                                            <button class="btn btn-success show_password" type="button"><i class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="smtp_from_name">SMTP From Name</label>
                                    <input type="text" name="smtp_fname" value="{!! isset($data->smtp_fname) ? $data->smtp_fname : '' !!}" class="form-control" id="smtp_from_name" placeholder="" >
                                </div>
                                <div class="form-group">
                                    <label for="smtp_from_email">SMTP From Email</label>
                                    <input type="email" name="smtp_femail" value="{!! isset($data->smtp_femail) ? $data->smtp_femail : '' !!}" class="form-control" id="smtp_from_email" placeholder="" >
                                </div>

                            </div>

                            <div class="col-md-12 <?php if(isset($data->email_type)){ if($data->email_type=='api'){ echo ''; }else{ echo 'hide'; } }else{ echo 'hide'; }?>" id="api">


                                <!-- show hide  api key service want to use -->
                                <div class="col-md-12" id="send_grid">
                                    <div class="form-group">
                                        <label for="sendgrid_email">SendGrid Email</label>
                                        <input type="email" name="sg_email" value="{!! isset($data->sg_email) ? $data->sg_email : '' !!}" class="form-control" id="sendgrid_email" placeholder="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="sendgrid_from_name">From Name</label>
                                        <input type="text" name="sg_fname" value="{!! isset($data->sg_fname) ? $data->sg_fname : '' !!}" class="form-control" id="sendgrid_from_name" placeholder="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="sendgrid_api_key">SendGrid API Key</label>
                                        <div class="input-group">
                                            <input type="password" name="sg_apikey" value="{!! isset($data->sg_apikey) ? $data->sg_apikey : '' !!}" class="form-control" id="sendgrid_api_key" placeholder="">
                                            <span onclick="change_type($('input[name=sg_apikey]'))" title="show/hide" class="input-group-addon btn btn-success b-0"><i class="fa fa-eye text-white"></i></span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" id="send_test"  style="<?php echo ($data->email_type!="")?"":"display:none;"?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sparkpost_api_key">Send Test Email</label>
                                        <div class="input-group m-t-10">
                                            <input type="email" id="example-input2-group2" name="test_email" class="form-control" placeholder="Email">
                                            <span class="input-group-btn">
                                         <button id="send_test_em" type="button" class="btn waves-effect waves-light btn-success">Send Test <i class="fa fa-spinner fa-spin hidden"></i> </button>
                                    </span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Save</button>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>


    </div>
@endsection
@section('scripts')
    <!-- This Page JS -->
    <script src="assets/libs/tinymce/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($("#signup_body").length > 0) {
                tinymce.init({
                    selector: "textarea#signup_body",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($("#block_body").length > 0) {
                tinymce.init({
                    selector: "textarea#block_body",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            if ($("#confirm_body").length > 0) {
                tinymce.init({
                    selector: "textarea#confirm_body",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }

            if ($("#new_body").length > 0) {
                tinymce.init({
                    selector: "textarea#new_body",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }

            if ($("#cancel_body").length > 0) {
                tinymce.init({
                    selector: "textarea#cancel_body",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }

            if ($("#appt_body").length > 0) {
                tinymce.init({
                    selector: "textarea#appt_body",
                    theme: "modern",
                    height: 300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                });
            }


        });


        $('#email_form').submit(function(){
            //alert("yes");
            $("#loading").show();
            var dd = new FormData(this);
            dd.append("signup_body",tinymce.get('signup_body').getContent());
            dd.append("block_body",tinymce.get('block_body').getContent());
            dd.append("confirm_body",tinymce.get('confirm_body').getContent());
            dd.append("new_body",tinymce.get('new_body').getContent());
            dd.append("cancel_body",tinymce.get('cancel_body').getContent());
            dd.append("appt_body",tinymce.get('appt_body').getContent());

            //dd.append('id',$("input[name='template_id']").val());
            $.ajax({
                url: "{{Route('save-emails')}}",
                data: dd,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {
                    $("#loading").hide();
                    if (res.success == true) {
                        Swal.fire(
                            'Good job!',
                            'Email settings saved successfully!',
                            'success'
                        )

                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: res.message,
                            footer: '<a href>Why do I have this issue?</a>'
                        })
                    }
                }
            });
            return false;
        });


        $(document).ready(function () {

            $('.personlize button').click(function (){



            })



            $("input[name='email_type']").on('click', function(){
                $("#send_test").show();
                if($(this).val()=='smtp'){
                    hideShow('api', 'smtp');
                }else{
                    hideShow('smtp', 'api');
                }
            });

            $("input[name='email_api']").on('click', function(){
                if($(this).val()=='spark_post'){
                    hideShow('send_grid', 'spark_post');
                }else{
                    hideShow('spark_post', 'send_grid');
                }
            });

            $('#choose_emailing_type input').on('click', function(){
                if($(this).val()=='smtp'){
                    hideShow('api', 'smtp');
                }else{
                    hideShow('smtp', 'api');
                }

            });

            /* setting form */
            $('#mailSettingForm').submit(function(){
                //alert("yes");
                //$("#loading").show();
                var dd = new FormData(this);

                $.ajax({
                    url: "{{Route('store-mailing')}}",
                    data: dd,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        $("#loading").hide();
                        if (res.success == true) {
                            Swal.fire(
                                'Good job!',
                                'Account saved successfully!',
                                'success'
                            );

                            $('#accounts_table').DataTable().ajax.reload();
                            $('.bs-example-modal-lg').modal('hide');
                            $('#account_form')[0].reset();

                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: res.message
                            })
                        }
                    }
                });

                return false;
            });

            $("#send_test_em").click(function(){
                var test_email = $('input[name="test_email"]').val();
                var req = {};
                req['_token'] = '{{ csrf_token() }}';
                if($("input[name='email_type']:checked").val()=="smtp")
                {
                    $("#smtp").find("input").each(function(){
                        if($(this).val()=="")
                        {
                            swal("Error!","Please enter all smtp info!", "error");
                            return false;
                        }
                    });
                    req['gate'] = "smtp"
                    req['smtp_host'] = $("input[name='smtp_host']").val();
                    req['smtp_port'] = $("input[name='smtp_port']").val();
                    req['using_ssl'] = "tls";
                    if($("input[name='using_ssl']:checked").val()=="yes")
                    {
                        req['using_ssl'] = "ssl";
                    }

                    req['smtp_username'] = $("input[name='smtp_username']").val();
                    req['smtp_password'] = $("input[name='smtp_password']").val();
                    req['smtp_fname'] = $("input[name='smtp_fname']").val();
                    req['smtp_femail'] = $("input[name='smtp_femail']").val();

                }else
                {
                    req['gate'] = "api";
                    req['type'] = "sendgrid";
                    if($("input[name='sg_email']").val()=="")
                    {
                        swal("Error!","Please enter sendgrid email!", "error");
                        return false;
                    }
                    if($("input[name='sg_apikey']").val()=="")
                    {
                        swal("Error!","Please enter sendgrid api key!", "error");
                        return false;
                    }

                    req['from_email'] = $("input[name='sg_email']").val();
                    req['from_name'] = $("input[name='sg_fname']").val();
                    req['api_key'] = $("input[name='sg_apikey']").val()
                }


                if(test_email!="")
                {
                    $('#send_test_em i').removeClass('hidden');
                    //$("#loading").show();
                    req['test_email'] = test_email;

                    $.post('{{ url("/mail-send-test") }}',req,function(res){
                        $('#send_test_em i').addClass('hidden');
                        if (res.success == true)
                        {
                            swal("Email Sent!","Please check your inbox!", "success");
                        }else
                        {
                            swal("Error!",res.message, "error");
                        }
                    });
                }else
                {
                    swal("Error!","Please enter an email!", "error");
                }
            });

        });

        function change_type(el) {
            if( $(el).attr('type') == 'password' ){
                $(el).attr('type', 'text');
            }else{
                $(el).attr('type', 'password');
            }
        }
        function hideShow(hide, show){
            $("#"+hide).addClass('hide');
            $("#"+show).removeClass('hide');
        }
    </script>
@endsection
