@extends('layouts.app')
@section('content')
    <style>
        .hidden{
            display: none;
        }
    </style>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">My Profile</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            @if($user->avatar == '')
                            <img src="{{ asset('assets/images/users/default.png') }}" id="profile-image-preview" class="image_preview img-circle avatar-default" width="150">
                            @else
                            <img src="{{ asset('assets/images/users/'.$user->avatar) }}" class="image_preview img-circle" width="150">
                            @endif
                            <h4 class="card-title m-t-10">{{ ucwords($user->name) }}</h4>
                            <h6 class="card-subtitle">{{ $user->email }}</h6>

                        </center>
                    </div>

                </div>
            </div>

            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="tab-pane fade active show" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                        <div class="card-body">
                            <form class="form-horizontal form-material" id="profileForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ @$user->id }}" name="id">
                                <div class="form-group">
                                    <label class="col-md-12">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ @$user->name }}" name="name" required placeholder="User first name" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ @$user->lname }}" name="lname" placeholder="User last name" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Preferred Name</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{ @$user->preferred_name }}" name="preferred_name" placeholder="Preferred Name" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" value="{{ @$user->email }}" placeholder="User email" class="form-control form-control-line" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Gender</label>
                                    <div class="col-md-12">
                                        <input {{ @$user->gender == 'male' ? 'checked' : '' }} type="radio" class="profile-gender" name="gender" value="male"> Male &emsp;
                                        <input {{ @$user->gender == 'female' ? 'checked' : '' }} type="radio" class="profile-gender" name="gender" value="female"> Female
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone Number</label>
                                    <div class="col-md-12">
                                        <input type="tel" value="{{ @$user->phone }}" name="phone" placeholder="Phone Number" class="form-control form-control-line">
                                    </div>
                                </div>

                                <?php /*
                                <div class="form-group">
                                    <label class="col-md-12">Profile picture</label>
                                    <div class="col-md-12">
                                        <input type="file" name="profile" id="profile" onchange="readURL(this, '.image_preview')">
                                        <input type="hidden" name="avatar" value="{{ @$user->avatar }}">
                                        <p class="m-t-5"><span class="text-danger">*</span>File size must be less than 1MB and type of jpeg, png, jpg, svg</p>
                                    </div>
                                </div>
                                */ ?>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="is_password_reset" value="1" class="custom-control-input" id="is_password">
                                        <label class="custom-control-label" for="is_password">Change Password</label>
                                    </div>
                                </div>

                                <div id="password_container" class="hidden">
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Old Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="" name="old_password" placeholder="Old password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="" name="new_password" placeholder="New password" class="form-control form-control-line">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="" name="confirm_password" placeholder="Confirm password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile <i class="fa fa-spin fa-spinner hidden"></i></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            
            $(".profile-gender").change(function(){
                if($(this).val() == "male"){
                    $("#profile-image-preview").attr("src", "{{ asset('assets/images/users/default.png') }}");
                }
                else{
                    $("#profile-image-preview").attr("src", "{{ asset('assets/images/users/default-female.png') }}");
                }
               // console.log(); 
            });

            $('#profile').bind('change', function() {

                var file_type = this.files[0].type.split('/');
                if(file_type[1] != 'png' && file_type[1]!='jpeg'&& file_type[1]!='jpg' && file_type[1]!='svg'){
                    swal('Warning', 'The profile image must be a file of type: jpeg, png, jpg, svg', 'error');
                    $(this).val('');
                    return false;
                }else {
                    var file_size = this.files[0].size;
                    if (file_size >= 1000000) {
                        swal('Warning', 'File size must be less than 1MB', 'error');
                        $(this).val('');
                        return false;
                    }
                }

            });


            $('#is_password').click(function () {

                if( $(this).is(':checked') ){
                    $('#password_container').removeClass('hidden');
                }else{
                    $('#password_container').addClass('hidden');
                }
            });

            $('#profileForm').submit(function () {

                $('#profileForm .fa-spin').removeClass('hidden');

                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('save-profile')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success');
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#profileForm .fa-spin').addClass('hidden');
                    },
                    error: function () {
                        $('#profileForm .fa-spin').addClass('hidden');
                    }
                });

                return false;
            })

        });
    </script>

@endsection
