@extends('layouts.app')
@section('content')

    <style>
        .sl select{
            width: 32.8%;
            border-color: lightgrey;
            height: 2.2em;
            padding: 0px 5px;
            border-radius: 3px;
        }
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">MY Documents</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">MY Documents</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <div id="licence-container">
                                <h3 class="pull-left">Driver’s Licence (C)</h3>

                                @php
                                    $drivingLicenceStatus = drivingLicenceStatus(auth()->user()->id);
                                @endphp
                                
                                {{-- @if (@$docs->driving_licence->driving_licence_status)
                                    <button style="margin-left: 10px;" class="btn btn-success pull-right" type="button" disabled>Status : {{ @$docs->driving_licence->driving_licence_status }}</button>
                                @endif --}}
                                

                                <button class="btn btn-success pull-right" type="button" @if(isset($drivingLicenceStatus) && $drivingLicenceStatus == 'Requested') disabled @else data-toggle="modal" data-target=".driving-modal" @endif> @if(isset($drivingLicenceStatus) && $drivingLicenceStatus == 'Requested') Waiting for Approval @else Update Driver's Licence @endif </button>

                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6 small-margin-top-5">
                                        <label for="">Expiration Date</label>
                                        <input type="text" class="form-control"  value="{{ @$docs->driving_licence->expiration_date }}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Front</p>
                                                @if(@$docs->driving_licence->driving_licence_front=='')
                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$docs->driving_licence->driving_licence_front) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Back</p>
                                                @if(@$docs->driving_licence->driving_licence_back=='')
                                                    <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$docs->driving_licence->driving_licence_back) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <center>
                                    <h4>Request Driver’s Licence History</h4>
                                    <hr>
                                </center>
                                <table class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Licence-Front</th>
                                            <th>Licence-Back</th>
                                            <th>Expiration Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($driving_licences as $licence)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a data-fancybox="gallery" href="{{ asset('assets/images/documents/'.@$licence->driving_licence_front) }}"><img src="{{ asset('assets/images/documents/'.@$licence->driving_licence_front) }}" alt="" class="img-responsive" style="width: 40px;"></a>
                                                </td>
                                                <td>
                                                    <a data-fancybox="gallery" href="{{ asset('assets/images/documents/'.@$licence->driving_licence_back) }}"><img src="{{ asset('assets/images/documents/'.@$licence->driving_licence_back) }}" alt="" class="img-responsive" style="width: 40px;"></a>
                                                </td>
                                                <td>{{ $licence->expiration_date ?? '' }}</td>
                                                <td>{{ $licence->driving_licence_status ?? '' }}</td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                                
                            </div>

                            <hr>

                            <div id="inst-licence-container">
                                <h3 class="pull-left">Driving Instructor’s Licence (C)</h3>
                                
                                @php
                                    $instructorLicencesStatus = instructorLicencesStatus(auth()->user()->id);
                                @endphp

                                {{-- @if (@$docs->driving_licence->driving_licence_status)
                                    <button style="margin-left: 10px;" class="btn btn-success pull-right" type="button" disabled>Status : {{ @$docs->instructor_licence->instructor_licence_status }}</button>
                                @endif --}}

                                <button class="btn btn-success pull-right" type="button" @if(isset($instructorLicencesStatus) && $instructorLicencesStatus =='Requested') disabled @endif  data-toggle="modal" data-target=".driving-instructor-modal"> @if(isset($instructorLicencesStatus) && $instructorLicencesStatus =='Requested') Waiting for Approval @else Update Driving Instructor’s Licence (C) @endif</button>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-md-6 small-margin-top-5">
                                                <label for="">Expiration Date</label>
                                                <input type="text" class="form-control" value="{{ @$docs->instructor_licence->expiration_date}}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Front</p>
                                                @if(@$docs->instructor_licence->instructor_licence_image=='')
                                                    <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$docs->instructor_licence->instructor_licence_image) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <center>
                                    <h4>Instructor’s Licence History</h4>
                                    <hr>
                                </center>
                                <table class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Instructor Licence</th>
                                            <th>Expiration Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($instructor_licences as $ilicence)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a data-fancybox="gallery" href="{{ asset('assets/images/documents/'.@$ilicence->instructor_licence_image) }}"><img src="{{ asset('assets/images/documents/'.@$ilicence->instructor_licence_image) }}" alt="" class="img-responsive" style="width: 40px;"></a>
                                                </td>
                                                
                                                <td>{{ $ilicence->expiration_date ?? '' }}</td>
                                                <td>{{ $ilicence->instructor_licence_status ?? '' }}</td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <div id="wwcc-container">
                                <h3 class="pull-left">Working with Children Check (WWCC)</h3>

                                @php
                                    $wwccLicencesStatus = wwccLicencesStatus(auth()->user()->id);
                                @endphp
                                
                                {{-- @if (@$docs->wwcc_licence->wwcc_licence_status)
                                    <button style="margin-left: 10px;" class="btn btn-success pull-right" type="button" disabled>Status : {{ @$docs->wwcc_licence->wwcc_licence_status }}</button>
                                @endif --}}

                                <button class="btn btn-success pull-right" type="button" @if(isset($wwccLicencesStatus) && $wwccLicencesStatus =='Requested') disabled @endif  data-toggle="modal" data-target=".driving-wwcc-modal"> @if(isset($wwccLicencesStatus) && $wwccLicencesStatus =='Requested') Waiting for Approval @else Update WWCC @endif</button>

                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-sm-12 small-margin-top-5">

                                                <div class="form-group">
                                                    <label for="">Full name</label>
                                                    <input type="text" class="form-control" value="{{ @$docs->wwcc_licence->name }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">WWCC number (or application number)</label>
                                                    <input type="text" class="form-control" value="{{ @$docs->wwcc_licence->wwcc_number }}"  readonly>
                                                </div>

                                                <label for="">WWCC expiry date</label>
                                                <input type="text" class="form-control" value="{{ @$docs->wwcc_licence->expiration_date}}" readonly>

                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group ">
                                                    <p>Date of Birth</p>
                                                    <input type="date" class="form-control" value="{{ @$docs->wwcc_licence->dob}}" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    @if(@$docs->wwcc_licence->wwcc_image=='')
                                                        <div class="form-group">
                                                            <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <img src="{{ asset('assets/images/documents/'.@$docs->wwcc_licence->wwcc_image) }}" alt="" class="img-responsive">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group" id="verification_date">
                                                    <p> Verification date</p>
                                                    <input type="text" class="form-control" value="{{ @$docs->wwcc_licence->verification_date}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <center>
                                        <h4>WWCC History</h4>
                                        <hr>
                                    </center>
                                    <table class="table table-light">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>WWCC Number</th>
                                                <th>Date of Birth</th>
                                                <th>Expiration Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wwcc_licences as $wlicence)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $wlicence->name ?? '' }}</td>
                                                    
                                                    <td>{{ $wlicence->wwcc_number ?? '' }}</td>
                                                    <td>{{ $wlicence->dob ?? '' }}</td>
                                                    <td>{{ $wlicence->expiration_date ?? ''}}</td>
                                                    <td>{{ $wlicence->wwcc_licence_status ?? '' }}</td>
                                                </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade driving-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="driving_licence_form" action="" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Driver’s Licence </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="driving_licence">
                        <label for=""><span class="text-danger">*</span> Licence Front Side</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" required name="driving_licence_front" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                        <label for=""><span class="text-danger">*</span> Licence Back Side</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input driving_back" required name="driving_licence_back" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>

                        <label for=""><span class="text-danger">*</span>  Expiration Date</label>
                        <div class="form-group mb-3">
                            <input type="date" class="form-control" name="expiration_date" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left" >Save</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade driver_instructor_modal driving-instructor-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" id="driver_instructor_form">
                    <div class="modal-header">
                        <h4 class="modal-title">DRIVING INSTRUCTOR’S LICENCE (C)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="driving_instructor">
                        <label for=""><span class="text-danger">*</span> Upload File</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input instructor_back" name="instructor_licence_image" id="inputGroupFile02" required>
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                            <small>You can only upload images of type PNG or JPG. Please take a clear photo of the front of your driving instructor licence.</small>
                        </div>

                        <label for=""><span class="text-danger">*</span>  Expiration Date</label>
                        <div class="form-group mb-3">
                            <input type="date" class="form-control" id="expiration_date_driving_instructor" name="expiration_date" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left" >Save</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade driving-wwcc-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" id="wwcc_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Children Check (WWCC)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="wwcc">

                        <label for=""><span class="text-danger">*</span> Full Name </label>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <label for=""><span class="text-danger">*</span> WWCC number </label>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="wwcc_number" required>
                        </div>

                        <label for=""><span class="text-danger">*</span> Date of Birth</label>
                        <div class="form-group mb-3">
                            <input type="date" class="form-control" name="dob" required>
                        </div>
                        <label for=""><span class="text-danger">*</span> Expire Date</label>
                        <div class="form-group mb-3">
                            <input type="date" class="form-control" id="expiration_date_wwcc" name="expiration_date" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left" >Save</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection

@section('scripts')

    <script>

        $(document).ready(function() {

            $('#driving_licence_form').submit(function (){
                var SelectedDateNew = $("input[name=expiration_date]").val();
               
                $('#loading').show();

                var CurrentDate = new Date('<?php echo date('Y-m-d h:i:s');?>');
                var SelectedDate = new Date(SelectedDateNew+" <?php echo date('h:i:s');?>");
                // console.log(CurrentDate);
                // return false;

                if(CurrentDate >= SelectedDate)
                {
                    swal('Warning!', 'Select a future date!', 'error');
                    $('#loading').hide();
                }
                
                else
                {
                    var data = new FormData(this);

                    $.ajax({
                        url: "{{Route('save_my_documents')}}",
                        data: data,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function (res) {
                            if(res.success == true){
                                
                                swal('Success', res.message, 'success').then((value) => {
                                    location.reload(true);
                                });

                                $('.driving-wwcc-modal').modal('hide');
                                $('.driving-modal').modal('hide');
                                $('.driver_instructor_modal').modal('hide');

                            }else if(res.success == false){
                                swal('Warning!', res.message, 'error');
                            }

                            $('#loading').hide();
                        },
                        error: function () {
                            $('#loading').hide();
                        }

                    });
                }

                return false;
            });


            $('#driver_instructor_form').submit(function (){
                var SelectedDateNew = $("#expiration_date_driving_instructor").val();
                $('#loading').show();
                

                var CurrentDate = new Date('<?php echo date('Y-m-d h:i:s');?>');
                var SelectedDate = new Date(SelectedDateNew+" <?php echo date('h:i:s');?>");

                if(CurrentDate >= SelectedDate)
                {
                    swal('Warning!', 'Select a future date!', 'error');
                    $('#loading').hide();
                }
                
                else
                {
                    var data = new FormData(this);

                    $.ajax({
                        url: "{{Route('save_my_documents')}}",
                        data: data,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function (res) {
                            if(res.success == true){
                                
                                swal('Success', res.message, 'success').then((value) => {
                                    location.reload(true);
                                });

                                $('.driving-wwcc-modal').modal('hide');
                                $('.driving-modal').modal('hide');
                                $('.driver_instructor_modal').modal('hide');

                            }else if(res.success == false){
                                swal('Warning!', res.message, 'error');
                            }

                            $('#loading').hide();
                        },
                        error: function () {
                            $('#loading').hide();
                        }

                    });
                }

                return false;
            });


            $('#wwcc_form').submit(function (){

                $('#loading').show();
                var SelectedDateNew = $("#expiration_date_wwcc").val();
                $('#loading').show();
                

                var CurrentDate = new Date('<?php echo date('Y-m-d h:i:s');?>');
                var SelectedDate = new Date(SelectedDateNew+" <?php echo date('h:i:s');?>");

                //alert('<?php echo date('h:i:s');?>');
                //alert(CurrentDate);
                //alert(SelectedDate);

                if(CurrentDate >= SelectedDate)
                {
                    swal('Warning!', 'Select a future date!', 'error');
                    $('#loading').hide();
                }
                
                else
                {
                    var data = new FormData(this);

                    $.ajax({
                        url: "{{Route('save_my_documents')}}",
                        data: data,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function (res) {
                            if(res.success == true){
                                
                                swal('Success', res.message, 'success').then((value) => {
                                    location.reload(true);
                                });

                                $('.driving-wwcc-modal').modal('hide');
                                $('.driving-modal').modal('hide');
                                $('.driver_instructor_modal').modal('hide');

                            }else if(res.success == false){
                                swal('Warning!', res.message, 'error');
                            }

                            $('#loading').hide();
                        },
                        error: function () {
                            $('#loading').hide();
                        }

                    });
                }

                return false;
            });


            $('#association_member').change(function (){
                if($(this).val() == 'Other'){
                    $('#member_input').show();
                }else{
                    $('#member_input').hide();
                }
            });


            $('#inputGroupFile01').change(function (e){
                var fileName = e.target.files[0].name;
                $('#inputGroupFile01').next('label').html(fileName);
            });
            $('.driving_back').change(function (e){
                var fileName = e.target.files[0].name;
                $('.driving_back').next('label').html(fileName);
            });
            $('.instructor_back').change(function (e){
                var fileName = e.target.files[0].name;
                $('.instructor_back').next('label').html(fileName);
            });

            $('#inputGroupFile032').change(function (e){
                var fileName = e.target.files[0].name;
                $('#inputGroupFile032').next('label').html(fileName);
            });

        });
    </script>
    
    <style>
     #verification_date select {
            appearance: none;
            padding: 2px 10px;
        }
    </style>

@endsection
