@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Instructor Details</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Instructor Details</li>
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
                                <img src="{{ asset('assets/images/users/default.png') }}" class="rounded-circle" width="150">
                            @else
                                <img src="{{ asset('assets/images/users/'.$user->avatar) }}" class="rounded-circle" width="150">
                            @endif
                            <h4 class="card-title m-t-10">{{ ucwords($user->name) }}</h4>
                                <div class="row text-center justify-content-md-center">
                                    <?php
                                    $langs=[];
                                    if($user->user_meta->language!=""){
                                        $langs = json_decode($user->user_meta->language);

                                        foreach ($langs as $lang ){
                                            echo '<div class="col-4"> <span class="label label-info">'.$lang.'</span> </div>';
                                        }
                                    }
                                    ?>
                                </div>
                        </center>
                    </div>
                    <div><hr></div>
                    <div class="card-body">
                        <small class="text-muted">Email address </small>
                        <h6>{{ $user->email }}</h6> <small class="text-muted p-t-30 db">Phone</small>
                        <h6>{{ $user->phone }}</h6>
                        <div><hr></div>
                        <h6>BIO</h6>
                        {!! $user->user_meta->bio !!}
                    </div>
                    </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#vehicle_details" data-toggle="pill" role="tab" aria-controls="pills-vehicle_details" aria-selected="true">Vehicle Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#inst_docs"  data-toggle="pill" role="tab" aria-controls="pills-inst_docs">Documents</a>
                        </li>

                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="inst_docs" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">

                                        <?php

                                        $driving=$inst_l = "";
                                        if( @$docs->driving_licence !='' ){
                                            $driving = json_decode($docs->driving_licence);
                                        }
                                        if( @$docs->instructor_licence !='' ){
                                            $inst_l = json_decode($docs->instructor_licence);
                                        }

                                        ?>
                                            @if( isset($docs))
                                            <div id="licence-container">
                                            <h3 class="pull-left">Driver’s Licence (C)</h3>
                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-md-6 small-margin-top-5">
                                                    <label for="">Expiration Date</label>
                                                    <input type="text" class="form-control" value="{{ @$driving->exp_month}}-{{ @$driving->exp_day}}-{{ @$driving->exp_year}}"  readonly>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row m-t-15">
                                                        <div class="col-md-6">
                                                            <p>Driver's Licence (C) - Front</p>

                                                            @if(@$driving->file_front=='')
                                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                            @else
                                                                <a data-fancybox="gallery" href="{{ asset('assets/images/documents/'.@$driving->file_front) }}"><img src="{{ asset('assets/images/documents/'.@$driving->file_front) }}" alt="" class="img-responsive"></a>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Driver's Licence (C) - Back</p>
                                                            @if(@$driving->file_back=='')
                                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                            @else
                                                                <a data-fancybox="gallery" href="{{ asset('assets/images/documents/'.@$driving->file_back) }}"><img src="{{ asset('assets/images/documents/'.@$driving->file_back) }}" alt="" class="img-responsive"></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button onclick="appr_doc(this, 'driving_licence_status', 'app')" class="btn btn-success pull-right mt-2" {{ $docs->driving_licence_status ==1? 'disabled': '' }}>{{ $docs->driving_licence_status ==1? 'Approved': 'Approve' }}</button>
                                                        <button onclick="appr_doc(this,'driving_licence_status', 'rej')" class="btn btn-danger pull-right mt-2 mr-1" {{ $docs->driving_licence_status ==2? 'disabled': '' }}> {{ $docs->driving_licence_status ==2? 'Rejected': 'Reject' }} </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @else
                                            <h3 class="text-danger">Driver’s Licence (C) not submitted by Instructor</h3>
                                            <hr>
                                        @endif

                                        @if( isset($docs))
                                        <div id="inst-licence-container">
                                            <h3 class="pull-left">Driving Instructor’s Licence (C)</h3>

                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row m-t-15">
                                                        <div class="col-md-6 small-margin-top-5">
                                                            <label for="">Expiration Date</label>
                                                            <input type="text" class="form-control" value="{{ @$inst_l->exp_month}}-{{ @$inst_l->exp_day}}-{{ @$inst_l->exp_year}}" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>Driver's Licence (C) - Front</p>
                                                            @if(@$inst_l->file=='')
                                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                            @else
                                                                <a data-fancybox="gallery" href=""><img src="{{ asset('assets/images/documents/'.@$inst_l->file) }}" alt="" class="img-responsive"></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                   <div>
                                                       <button onclick="appr_doc(this, 'instructor_licence_status', 'app')" class="btn btn-success pull-right mt-2" {{ $docs->instructor_licence_status ==1? 'disabled': '' }}>{{ $docs->instructor_licence_status ==1? 'Approved': 'Approve' }}</button>
                                                       <button onclick="appr_doc(this,'instructor_licence_status', 'rej')" class="btn btn-danger pull-right mt-2 mr-1" {{ $docs->instructor_licence_status ==2? 'disabled': '' }}> {{ $docs->instructor_licence_status ==2? 'Rejected': 'Reject' }} </button>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @else
                                            <h3 class="text-danger">Driver’s Licence (C) not submitted by Instructor</h3>
                                            <hr>
                                        @endif
                                        @if( isset($docs))
                                        <div id="wwcc-container">
                                            <h3 class="pull-left">Working with Children Check (WWCC)</h3>
                                            <div class="clearfix"></div>
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <div class="row m-t-15">
                                                        <div class="col-md-6 small-margin-top-5">

                                                            <div class="form-group">
                                                                <label for="">Full name</label>
                                                                <input type="text" class="form-control" readonly>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">WWCC number (or application number)</label>
                                                                <input type="text" class="form-control" readonly>
                                                            </div>

                                                            <label for="">WWCC expiry date</label>
                                                            <div class="form-group sl">
                                                                <select name="" id="" disabled>
                                                                    <option value="">8</option>
                                                                </select>
                                                                <select name="" id="" disabled>
                                                                    <option value="">October</option>
                                                                </select>
                                                                <select name="" id="" disabled>
                                                                    <option value="">1998</option>
                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group sl">
                                                                <p>Date of Birth</p>
                                                                <select name="" id="" disabled>
                                                                    <option value="">8</option>
                                                                </select>
                                                                <select name="" id="" disabled>
                                                                    <option value="">October</option>
                                                                </select>
                                                                <select name="" id="" disabled>
                                                                    <option value="">1998</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                            </div>

                                                            <div class="form-group sl">
                                                                <p> Verification date</p>
                                                                <select name="" id="" disabled>
                                                                    <option value="">8</option>
                                                                </select>
                                                                <select name="" id="" disabled>
                                                                    <option value="">October</option>
                                                                </select>
                                                                <select name="" id="" disabled>
                                                                    <option value="">1998</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button onclick="appr_doc(this, 'wwcc_status', 'app')" class="btn btn-success pull-right mt-2" {{ $docs->wwcc_status ==1? 'disabled': '' }}>{{ $docs->wwcc_status ==1? 'Approved': 'Approve' }}</button>
                                                        <button onclick="appr_doc(this,'wwcc_status', 'rej')" class="btn btn-danger pull-right mt-2 mr-1" {{ $docs->wwcc_status ==2? 'disabled': '' }}> {{ $docs->wwcc_status ==2? 'Rejected': 'Reject' }} </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <h3 class="text-danger">Working with Children Check (WWCC) not submitted by Instructor</h3>
                                            <hr>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="vehicle_details" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="" for="">Member of a driving instructor association?</label>
                                        <div class="input-group">
                                            <select disabled class="form-control" required="required" name="association_member" id="association_member">
                                                <option {{ $user->user_meta->association_member == "No"? 'selected' : '' }} value="No">No</option>
                                                <option {{ $user->user_meta->association_member == "Australia Driver Trainers Association (NSW & QLD)"? 'selected' : '' }} value="Australia Driver Trainers Association (NSW &amp; QLD)">Australia Driver Trainers Association (NSW &amp; QLD)</option>
                                                <option {{ $user->user_meta->association_member == "NSW Driver Trainers Association"? 'selected' : '' }} value="NSW Driver Trainers Association">NSW Driver Trainers Association</option>
                                                <option {{ $user->user_meta->association_member == "Australian Driver Trainers Association (Victoria) Inc"? 'selected' : '' }} value="Australian Driver Trainers Association (Victoria) Inc">Australian Driver Trainers Association (Victoria) Inc</option>
                                                <option {{ $user->user_meta->association_member == "Other"? 'selected' : '' }} value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="member_input" style="display: none;">
                                        <div class="field-wrap">
                                            <div class="">
                                                <label class="" for="instructor_user_instructor_association_member">Name of your association</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{ $user->user_meta->association_name }}" name="association_name" id="association_member">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Are you accredited for the 'Keys2Drive' program?</label>
                                        <div class="input-group ">
                                            <select class="form-control" required="required" name="keys2drive">
                                                <option {{ $user->user_meta->keys2drive == "true"? 'selected' : '' }} value="true">Yes</option>
                                                <option {{ $user->user_meta->keys2drive == "false"? 'selected' : '' }} value="false">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>How long have you been a licensed driving instructor?</label>
                                        <div class="input-group">
                                            <input class="form-control" required="required" placeholder="No. of years" type="number" value="{{$user->user_meta->years_for_instructing}}" name="years_for_instructing" >
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 m-t-5">
                                        <label>Services &amp; Accreditation</label>

                                        <div class="input-group">
                                            <?php

                                            $services_accreditation=[];
                                            if($user->user_meta->services_accreditation!=""){
                                                $services_accreditation = json_decode($user->user_meta->services_accreditation);
                                            }
                                            ?>
                                            <label for="instructor_user_1">
                                                <input type="checkbox" @if( in_array(1, $services_accreditation)) checked @endif value="1" name="services_accreditation[]" id="instructor_user_1"> Driving test package: existing customers</label>
                                        </div>
                                        <div class="input-group">
                                            <label for="instructor_user_2">
                                                <input type="checkbox" @if( in_array(2, $services_accreditation)) checked @endif value="2" name="services_accreditation[]" id="instructor_user_2"> Driving test package: new customers</label>
                                        </div>
                                        <div class="input-group">
                                            <label for="instructor_user_12">
                                                <input type="checkbox" @if( in_array(3, $services_accreditation))  checked @endif value="3" name="services_accreditation[]" id="instructor_user_12"> Manual Instructor accredited - no vehicle</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h3>VEHICLES</h3>

                                        <label>Which transmission(s) do you offer?</label>
                                        <div class="input-group ">
                                            <div class="radio m-r-5">
                                                <label for="ansmission_type_0">
                                                    <input class="radio_buttons optional" type="radio" @if($user->user_meta->transmission_type == "auto") checked @endif value="auto" name="transmission_type" id="ansmission_type_0"> Auto </label>
                                            </div>
                                            <div class="radio m-r-5">
                                                <label for="ansmission_type_1">
                                                    <input class="radio_buttons optional" type="radio" @if($user->user_meta->transmission_type == "manual") checked @endif value="manual" name="transmission_type" id="ansmission_type_1"> Manual </label>
                                            </div>
                                            <div class="radio m-r-5">
                                                <label for="ansmission_type_2">
                                                    <input class="radio_buttons optional" type="radio" @if($user->user_meta->transmission_type == "both") checked @endif value="both" name="transmission_type" id="ansmission_type_2"> Both Transmissions </label>
                                            </div>
                                        </div>

                                        <div class="nested-field-blocks bordered" id="instructor_user_vehicle">
                                            <div class="fields" style="display: block;">
                                                <div class="vehicle_container" style="display: block;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="" for="">
                                                                ANCAP safety rating</label>

                                                            <div class="input-group">
                                                                <select class="form-control" required="required" name="ancap_rating" id="">
                                                                    <option @if($user->user_meta->ancap_rating =="1") selected @endif value="1">1 Star</option>
                                                                    <option @if($user->user_meta->ancap_rating =="2") selected @endif value="2">2 Stars</option>
                                                                    <option @if($user->user_meta->ancap_rating =="3") selected @endif value="3">3 Stars</option>
                                                                    <option @if($user->user_meta->ancap_rating =="4") selected @endif value="4">4 Stars</option>
                                                                    <option @if($user->user_meta->ancap_rating =="5") selected @endif value="5">5 Stars</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="" for="">
                                                                Do you instruct with 'dual controls'?</label>
                                                            <div class="input-group ">
                                                                <select class="form-control" required="required" name="dual_controls" id="">
                                                                    <option @if($user->user_meta->dual_controls =="true") selected @endif value="true">Yes</option>
                                                                    <option @if($user->user_meta->dual_controls =="false") selected @endif value="false">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row m-t-10">
                                                        <div class="col-md-6">
                                                            <label class="" for="">Vehicle registration number</label>

                                                            <div class="input-group">
                                                                <input class=" form-control" required="required" type="text" value="{{ $user->user_meta->registration_number }}" name="registration_number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="" for="">Transmission</label>
                                                            <div class="input-group">
                                                                <select class="form-control" readonly="readonly" required="required">
                                                                    <option @if($user->user_meta->dual_controls =="auto") selected @endif  value="Auto">Auto</option>
                                                                    <option @if($user->user_meta->dual_controls =="manual") selected @endif value="Manual">Manual</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row m-t-10">
                                                        <div class="col-md-4">
                                                            <label class="" for=""> Make</label>
                                                            <div class="input-group">
                                                                <select class="form-control" required="required" name="vehicle_make" id="vehicle_make">
                                                                    <option value=""></option>
                                                                    @foreach($car_make as $make)
                                                                        <option @if($user->user_meta->vehicle_make == $make->id) selected @endif  value="{{$make->id}}">{{$make->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="" for=""> Model</label>
                                                            <div class="input-group ">
                                                                <select class=" form-control"  required="required" name="vehicle_model" id="vehicle_model">
                                                                    @if($user->user_meta->vehicle_model =="")
                                                                        <option value=""></option>
                                                                    @else
                                                                        @php
                                                                            $car_model = \App\CarModel::whereId($user->user_meta->vehicle_model)->first();
                                                                            if($car_model){
                                                                                echo "<option value='$car_model->id'>$car_model->title</option>";
                                                                            }else{
                                                                                echo "<option value=''></option>";
                                                                            }
                                                                        @endphp
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">

                                                            <label class="" for="">Year</label>

                                                            <div class="input-group ">
                                                                <select class="form-control" required="required" name="vehicle_year" id="vehicle_year">
                                                                    <option value=""></option>
                                                                    <option value="2021">2021</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2016">2016</option>
                                                                    <option value="2015">2015</option>
                                                                    <option value="2014">2014</option>
                                                                    <option value="2013">2013</option>
                                                                    <option value="2012">2012</option>
                                                                    <option value="2011">2011</option>
                                                                    <option value="2010">2010</option>
                                                                    <option value="2009">2009</option>
                                                                    <option value="2008">2008</option>
                                                                    <option value="2007">2007</option>
                                                                    <option value="2006">2006</option>
                                                                    <option value="2005">2005</option>
                                                                    <option value="2004">2004</option>
                                                                    <option value="2003">2003</option>
                                                                    <option value="2002">2002</option>
                                                                    <option value="2001">2001</option>
                                                                    <option value="2000">2000</option>
                                                                    <option value="1999">1999</option>
                                                                    <option value="1998">1998</option>
                                                                    <option value="1997">1997</option>
                                                                    <option value="1996">1996</option>
                                                                    <option value="1995">1995</option>
                                                                    <option value="1994">1994</option>
                                                                    <option value="1993">1993</option>
                                                                    <option value="1992">1992</option>
                                                                    <option value="1991">1991</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>

        function appr_doc(x, type, status){

            $.post('{{ route('document_status') }}', { user_id:{{ $user->id }}, status:status, type:type },
                function (res){
                    if(res.success == true){
                        swal('Success', res.message, 'success');
                        $(x).text(res.btn_text);
                        $(x).parent().find('button').prop('disabled', true);

                    }
                });
        }


        $(document).ready(function (){
            $('#vehicle_details input, #vehicle_details select').attr('disabled', true)
            $('#vehicle_year').val('{{$user->user_meta->vehicle_year}}');
            $('#vehicle_model').val('{{$user->user_meta->vehicle_model}}');
            $('#vehicle_make').val('{{$user->user_meta->vehicle_make}}');
        })
    </script>

@endsection
