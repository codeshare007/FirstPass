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

                            <?php
                            $driving=$inst_l = "";
                            if( isset($docs) && $docs->driving_licence !='' ){
                                $driving = json_decode($docs->driving_licence);
                            }

                            if( isset($docs) && $docs->instructor_licence !='' ){
                                $inst_l = json_decode($docs->instructor_licence);
                            }
                            if( isset($docs) && $docs->wwcc !='' ){
                                $wwcc = json_decode($docs->wwcc);
                            }

                            ?>

                            <div id="licence-container">
                                <h3 class="pull-left">Driver’s Licence (C)</h3>
                                
                                @if(isset($docs->driving_licence_status) && $docs->driving_licence_status == '2')<button style="margin-left: 10px;" class="btn btn-danger pull-right" type="button" disabled>Status : Rejected</button>@endif

                                @if(isset($docs->driving_licence_status) && $docs->driving_licence_status == '1')<button style="margin-left: 10px;" class="btn btn-success pull-right" type="button" disabled>Status : Approved</button>@endif

                                <button class="btn btn-success pull-right" type="button" @if(isset($docs->driving_licence_status) && $docs->driving_licence_status == 'pending') disabled @else data-toggle="modal" data-target=".driving-modal" @endif> @if(isset($docs->driving_licence_status) && $docs->driving_licence_status == 'pending') Waiting for Approval @else Update Driver's Licence @endif </button>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6 small-margin-top-5">
                                        <label for="">Expiration Date</label>
                                        <input type="text" class="form-control"  value="{{ @$driving->exp_month}}-{{ @$driving->exp_day}}-{{ @$driving->exp_year}}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Front</p>
                                                @if(@$driving->file_front=='')
                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$driving->file_front) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Back</p>
                                                @if(@$driving->file_back=='')
                                                    <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$driving->file_back) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div id="inst-licence-container">
                                <h3 class="pull-left">Driving Instructor’s Licence (C)</h3>
                                
                                @if(isset($docs->instructor_licence_status) && $docs->instructor_licence_status == '2')<button style="margin-left: 10px;" class="btn btn-danger pull-right" type="button" disabled>Status : Rejected</button>@endif

                                @if(isset($docs->instructor_licence_status) && $docs->instructor_licence_status == '1')<button style="margin-left: 10px;" class="btn btn-success pull-right" type="button" disabled>Status : Approved</button>@endif

                                <button class="btn btn-success pull-right" type="button" @if(isset($docs->instructor_licence_status) && $docs->instructor_licence_status =='pending') disabled @endif  data-toggle="modal" data-target=".driving-instructor-modal"> @if(isset($docs->instructor_licence_status) && $docs->instructor_licence_status =='pending') Waiting for Approval @else Update Driving Instructor’s Licence (C) @endif</button>
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
                                                    <img src="{{ asset('assets/images/documents/'.@$inst_l->file) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div id="wwcc-container">
                                <h3 class="pull-left">Working with Children Check (WWCC)</h3>
                                
                                @if(isset($docs->wwcc_status) && $docs->wwcc_status == '2')<button style="margin-left: 10px;" class="btn btn-danger pull-right" type="button" disabled>Status : Rejected</button>@endif

                                @if(isset($docs->wwcc_status) && $docs->wwcc_status == '1')<button style="margin-left: 10px;" class="btn btn-success pull-right" type="button" disabled>Status : Approved</button>@endif

                                <button class="btn btn-success pull-right" type="button" @if(isset($docs->wwcc_status) && $docs->wwcc_status =='pending') disabled @endif  data-toggle="modal" data-target=".driving-wwcc-modal"> @if(isset($docs->wwcc_status) && $docs->wwcc_status =='pending') Waiting for Approval @else Update WWCC @endif</button>

                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-sm-12 small-margin-top-5">

                                                <div class="form-group">
                                                    <label for="">Full name</label>
                                                    <input type="text" class="form-control" value="{{ @$wwcc->full_name }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">WWCC number (or application number)</label>
                                                    <input type="text" class="form-control" value="{{ @$wwcc->wwcc }}"  readonly>
                                                </div>

                                                <label for="">WWCC expiry date</label>
                                                <div class="form-group ">
                                                    <select name="" id="" disabled>
                                                        <option value="">{{ @$wwcc->dob_day_expire }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="">{{ @$wwcc->dob_month_expire }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="">{{ @$wwcc->dob_year_expire }}</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group ">
                                                    <p>Date of Birth</p>
                                                    <select name="" id="" disabled>
                                                        <option value="{{ @$wwcc->dob_day }}">{{ @$wwcc->dob_day }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="{{ @$wwcc->dob_month }}">{{ @$wwcc->dob_month }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="{{ @$wwcc->dob_year }}">{{ @$wwcc->dob_year }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    @if(@$docs->wwcc_image=='')
                                                        <div class="form-group">
                                                            <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <img src="{{ asset('assets/images/documents/'.$docs->wwcc_image) }}" alt="" class="img-responsive">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group" id="verification_date">
                                                    <p> Verification date</p>
                                                    @if(@$docs->status=='1' || @$docs->status=='2')
                                                        
                                                        <?php $datetime = $docs->updated_at;
                                                        $dt_array = explode(' ', $datetime);
                                                        $final = explode('-', $dt_array[0]); ?>

                                                        <select name="" id="" disabled>
                                                            <option value=""><?php echo $final[2]; ?></option>
                                                        </select>
                                                        <select name="" id="" disabled>
                                                            <option value=""><?php echo $final[1]; ?></option>
                                                        </select>
                                                        <select name="" id="" disabled>
                                                            <option value=""><?php echo $final[0]; ?></option>
                                                        </select>
                                                    @endif
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
                                <input type="file" class="custom-file-input" required name="file_front" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                        <label for=""><span class="text-danger">*</span> Licence Back Side</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input driving_back" required name="file_back" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>

                        <label for=""><span class="text-danger">*</span>  Expiration Date</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="exp_year" id="dl_xy" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <?php
                                        $last_year=date('Y')+50;
                                          for($i = date('Y') ; $i < $last_year; $i++){
                                             echo "<option value='$i'>$i</option>";
                                          }
                                       ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_month" id="dl_xm" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_day" id="dl_xd" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
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
                                <input type="file" class="custom-file-input instructor_back" name="file" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                            <small>You can only upload images of type PNG or JPG. Please take a clear photo of the front of your driving instructor licence.</small>
                        </div>

                        <label for=""><span class="text-danger">*</span>  Expiration Date</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="exp_day" id="il_xd" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_month" id="il_xm" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_year" id="il_xy" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <?php
                                        $last_year=date('Y')+50;
                                          for($i = date('Y') ; $i < $last_year; $i++){
                                             echo "<option value='$i'>$i</option>";
                                          }
                                       ?>
                                </select>
                            </div>
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
                            <input type="text" class="form-control" name="wwcc" required>
                        </div>

                        <label for=""><span class="text-danger">*</span> Date of Birth</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="dob_day" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_month" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_year" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <?php
                                       for($i = 1950 ; $i < date('Y'); $i++){
                                          echo "<option>$i</option>";
                                       }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for=""><span class="text-danger">*</span> Expire Date</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="dob_day_expire" id="wc_xd" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_month_expire" id="wc_xm" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_year_expire" id="wc_xy" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <?php
                                        $last_year=date('Y')+50;
                                          for($i = date('Y') ; $i < $last_year; $i++){
                                             echo "<option value='$i'>$i</option>";
                                          }
                                       ?>
                                </select>
                            </div>
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

                $('#loading').show();
            
                var mnth = "";
                var Eday = $("#dl_xd").val();
                var Emonth = $("#dl_xm").val();
                var Eyear = $("#dl_xy").val();

                if(Emonth=='january'){ var mnth='01'; }
                if(Emonth=='february'){ var mnth='02'; }
                if(Emonth=='march'){ var mnth='03'; }
                if(Emonth=='april'){ var mnth='04'; }
                if(Emonth=='may'){ var mnth='05'; }
                if(Emonth=='june'){ var mnth='06'; }
                if(Emonth=='july'){ var mnth='07'; }
                if(Emonth=='august'){ var mnth='08'; }
                if(Emonth=='september'){ var mnth='09'; }
                if(Emonth=='october'){ var mnth='10'; }
                if(Emonth=='november'){ var mnth='11'; }
                if(Emonth=='december'){ var mnth='12'; }

                var CurrentDate = new Date('<?php echo date('Y-m-d h:i:s');?>');
                var SelectedDate = new Date(Eyear+"-"+mnth+"-"+Eday+" <?php echo date('h:i:s');?>");

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

                $('#loading').show();
                
                var mnth = "";
                var Eday = $("#il_xd").val();
                var Emonth = $("#il_xm").val();
                var Eyear = $("#il_xy").val();

                if(Emonth=='january'){ var mnth='01'; }
                if(Emonth=='february'){ var mnth='02'; }
                if(Emonth=='march'){ var mnth='03'; }
                if(Emonth=='april'){ var mnth='04'; }
                if(Emonth=='may'){ var mnth='05'; }
                if(Emonth=='june'){ var mnth='06'; }
                if(Emonth=='july'){ var mnth='07'; }
                if(Emonth=='august'){ var mnth='08'; }
                if(Emonth=='september'){ var mnth='09'; }
                if(Emonth=='october'){ var mnth='10'; }
                if(Emonth=='november'){ var mnth='11'; }
                if(Emonth=='december'){ var mnth='12'; }

                var CurrentDate = new Date('<?php echo date('Y-m-d h:i:s');?>');
                var SelectedDate = new Date(Eyear+"-"+mnth+"-"+Eday+" <?php echo date('h:i:s');?>");

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
                
                var mnth = "";
                var Eday = $("#wc_xd").val();
                var Emonth = $("#wc_xm").val();
                var Eyear = $("#wc_xy").val();

                if(Emonth=='january'){ var mnth='01'; }
                if(Emonth=='february'){ var mnth='02'; }
                if(Emonth=='march'){ var mnth='03'; }
                if(Emonth=='april'){ var mnth='04'; }
                if(Emonth=='may'){ var mnth='05'; }
                if(Emonth=='june'){ var mnth='06'; }
                if(Emonth=='july'){ var mnth='07'; }
                if(Emonth=='august'){ var mnth='08'; }
                if(Emonth=='september'){ var mnth='09'; }
                if(Emonth=='october'){ var mnth='10'; }
                if(Emonth=='november'){ var mnth='11'; }
                if(Emonth=='december'){ var mnth='12'; }

                var CurrentDate = new Date('<?php echo date('Y-m-d h:i:s');?>');
                var SelectedDate = new Date(Eyear+"-"+mnth+"-"+Eday+" <?php echo date('h:i:s');?>");

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

        });
    </script>
    
    <style>
     #verification_date select {
            appearance: none;
            padding: 2px 10px;
        }
    </style>

@endsection
