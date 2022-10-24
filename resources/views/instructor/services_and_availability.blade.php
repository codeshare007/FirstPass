@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            background-color: #4798e8;
        }
        .sunday_{ background-color: #f8f9f9 }
        .monday_{ background-color: #f2f3f4}
        .tuesday_{ background-color: #e5e7e9 }
        .wednesday_{ background-color: #d7dbdd }
        .thursday_{ background-color: #cacfd2 }
        .friday_{ background-color: #bdc3c7 }
        .saturday_{ background-color: #a6acaf }

            #times select {
                min-width: 5rem;
            }

        .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple{height: auto}
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Services and Availability</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Services and Availability</li>
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
                            <form id="edit_instructor">
                                <div id="instrutor-profile-container">
                                    <p class="pull-left">Please set the areas you service & the times you instruct.</p>
                                    <button type="button" onclick="edit_service_region()" class="btn btn-default pull-right mb-2"> Edit Service Regions </button>
                                    <div class="clearfix"></div>
                                    <div id="service_regions">
                                        @foreach($user_regions as $region)
                                        <label class="label label-inverse m-r-5 m-b-5 p-2"> {{  $region->region->title }} </label>
                                        @endforeach
                                    </div>

                                    <hr>

                                    <div class='m-b-15' id='mymap' style='height: 400px;'></div>

                                    <label for=""><span class="text-danger">*</span> Your operating hours</label>
                                        <p>To show your live availability to new learners, we firstly need to know your operating hours. Please define the hours you operate your business currently. You can update your operating hours at any time.
                                        The management of your real time availability within your operating hours is done via your {{ env('APP_NAME') }} calendar, you will have access to this once you have completed the signup process. Before we begin showing your live availability to learners, your {{ env('APP_NAME') }} calendar will need to be updated with all your existing bookings, this is to prevent double bookings. Your {{ env('APP_NAME') }} calendar needs to be updated by you each time you make new or change existing bookings. You are only required to add the duration of the lessons, not any learner detail. We also provide the opportunity to nominate travel times.</p>

                                    <div class="card" id="times">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <ol id="errors" class="text-danger"></ol>
                                                <div class="table-responsive">
                                                    <table id="service_time" class="table" width="100%">
                                                    @if( count($working_time) ==0 )
                                                    <?php
                                                    $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                                                    foreach ($days as $day){
                                                    ?>
                                                    <tr class="{{$day}}_">
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="is_enabled[{{ $day }}]" value="yes" id="customCheck_{{$day}}" class="custom-control-input">
                                                                        <input type='hidden' value='no' name='is_enabled[{{ $day }}]'>
                                                                        <!--<input type='hidden' name='days[{{ $day }}][]' value="{{ $day }}">-->
                                                                        <input type="hidden" class="form-control" name="service_time_id[{{$day}}]" value="">

                                                                        <label class="custom-control-label" for="customCheck_{{$day}}">{{ ucwords($day) }} <i class="fa fa-times text-danger"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-5 col-sm-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <select name="start_interval[{{ $day }}][]" id="{{$day}}_start"  class="form-control">
                                                                            <?php
                                                                                foreach($timeslot as $slot){
                                                                                    $selected = "";
                                                                                    if($slot->time_value == 9){$selected = 'selected="selected"';}
                                                                                    echo "<option data-dt='".ltrim(date('H', strtotime($slot->time_value)), '0')."' value='$slot->time_value' $selected  >$slot->time_value</option>";
                                                                                }

                                                                            ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-md-2 text-center">:</div>
                                                                <div class="col-md-5 col-sm-12">
                                                                    <select name="start_minutes[{{ $day }}][]" class="form-control">
                                                                        <option value="00">00</option>
                                                                        <option selected value="15">15</option>
                                                                        <option value="30">30</option>
                                                                        <option value="45">45</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                              <div class="col-md-12 text-center"> - </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-5 col-sm-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <select name="end_interval[{{ $day }}][]" id="{{$day}}_end"  class="form-control">
                                                                                <?php
                                                                                foreach(@$timeslot as $slot){
                                                                                    $selected = "";
                                                                                    if($slot->time_value == 9){$selected = 'selected="selected"';}
                                                                                    echo "<option data-dt='".ltrim(date('H', strtotime($slot->time_value)), '0')."' value='$slot->time_value' $selected  >$slot->time_value</option>";
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-md-2 text-center">:</div>
                                                                <div class="col-md-5 col-sm-12">
                                                                    <select name="end_minutes[{{ $day }}][]" class="form-control">
                                                                        <option value="00">00</option>
                                                                        <option value="15">15</option>
                                                                        <option value="30">30</option>
                                                                        <option selected value="45">45</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button onclick="add_time(this, '{{ $day }}')" type="button" class="btn btn-xs btn-primary pull-right"> <i class="fa fa-clock"></i> Add another time </button>
                                                        </td>

                                                    </tr>
                                                    <?php } ?>
                                                        @else
                                                        @foreach($working_time as $val)
                                                            <?php
                                                            $data = json_decode($val->data);
                                                            foreach($data as $i => $value){
                                                            ?>

                                                            <tr class="{{$val->day}}_">
                                                                <td>
                                                                    <?php if($i==0 ){ ?>
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input {{ $val->is_enabled == "yes"? 'checked':'' }} data-a="" type="checkbox" name="is_enabled[{{ $val->day }}]" value="yes" id="customCheck_{{$val->day}}" class="custom-control-input">
                                                                                <input type='hidden' value='no' {{ $val->is_enabled == "yes"? 'disabled':'' }} name='is_enabled[{{ $val->day }}]'>
                                                                                <label class="custom-control-label" for="customCheck_{{$val->day}}">{{ ucwords($val->day) }} <i class="ml-1 fa {{ $val->is_enabled == "yes"? 'fa-check text-success':'fa-times text-danger' }}"></i></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                        <input type="hidden" class="form-control" name="service_time_id[{{ $val->day }}]" value="{{ $val->id }}">
                                                                </td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-5 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <select name="start_interval[{{ $val->day }}][]" id="{{$val->day}}_start"  class="form-control">
                                                                                        <?php
                                                                                        foreach($timeslot as $slot){
                                                                                            if($slot->time_value!='11:55 AM'){
                                                                                                $selected = "";
                                                                                                if($value->start_hour ==  $slot->time_value){$selected = 'selected="selected"';}

                                                                                                echo "<option data-dt='".ltrim(date('H', strtotime($slot->time_value)), '0')."' value='$slot->time_value' $selected  >$slot->time_value</option>";
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-2 text-center">:</div>
                                                                        <div class="col-md-5 col-sm-12">
                                                                            <select name="start_minutes[{{ $val->day }}][]" class="form-control">
                                                                                <option {{ $value->start_min == "00" ? "selected" : "" }} value="00">00</option>
                                                                                <option {{ $value->start_min == "15" ? "selected" : "" }} value="15">15</option>
                                                                                <option {{ $value->start_min == "30" ? "selected" : "" }} value="30">30</option>
                                                                                <option {{ $value->start_min == "45" ? "selected" : "" }} value="45">45</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-12 text-center"> - </div>
                                                                </td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-5 col-sm-12">
                                                                            <div class="form-group">
                                                                                <div class="controls">
                                                                                    <select name="end_interval[{{ $val->day }}][]" id="{{$val->day}}_end"  class="form-control">
                                                                                        <?php
                                                                                        foreach(@$timeslot as $slot){
                                                                                            $selected = "";
                                                                                            if($value->end_hour ==  $slot->time_value){$selected = 'selected="selected"';}
                                                                                            echo "<option data-dt='".ltrim(date('H', strtotime($slot->time_value)), '0')."' value='$slot->time_value' $selected  >$slot->time_value</option>";
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12 col-md-2 text-center">:</div>
                                                                        <div class="col-md-5 col-sm-12">
                                                                            <select name="end_minutes[{{ $val->day }}][]" class="form-control">
                                                                                <option {{ $value->end_min == "00" ? "selected" : "" }} value="00">00</option>
                                                                                <option {{ $value->end_min == "15" ? "selected" : "" }} value="15">15</option>
                                                                                <option {{ $value->end_min == "30" ? "selected" : "" }} value="30">30</option>
                                                                                <option {{ $value->end_min == "45" ? "selected" : "" }} value="45">45</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </td>

                                                                <td>
                                                                    <?php if($i!=0){ ?>
                                                                    <button onclick="remove_time(this, {{ $val->id }})" type="button" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button>
                                                                    <?php }else{ ?>
                                                                    <button onclick="add_time(this, '{{ $val->day }}')" type="button" class="btn btn-xs btn-primary pull-right"> <i class="fa fa-clock"></i> Add another time </button>
                                                                    <?php } ?>
                                                                </td>

                                                            </tr>
                                                            <?php }  ?>
                                                        @endforeach
                                                    @endif
                                                </table>
                                                </div>
                                                <div class="form-group">

                                                    <label for=""><span class="text-danger">*</span> Driving test locations</label> <br>
                                                    <select multiple="" class="select2_test_locations form-control" name="test_location_ids[]" id="test_location_ids">
                                                        <?php foreach($user_location_ids as $test_location){
                                                        $selected="";
                                                        ?>
                                                        <option selected value="{{ $test_location->id }}">{{ $test_location->title }}</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">* Default travel time between lessons (mins)</label>
                                                            <select name="lesson_travel_time" id="" class="form-control">
                                                                <option {{ auth()->user()->lesson_travel_time==15? 'selected': '' }} value="15">15</option>
                                                                <option {{ auth()->user()->lesson_travel_time==30? 'selected': '' }} value="30">30</option>
                                                                <option {{ auth()->user()->lesson_travel_time==45? 'selected': '' }} value="45">45</option>
                                                                <option {{ auth()->user()->lesson_travel_time==60? 'selected': '' }} value="60">60</option>
                                                                <option {{ auth()->user()->lesson_travel_time==75? 'selected': '' }} value="75">75</option>
                                                                <option {{ auth()->user()->lesson_travel_time==90? 'selected': '' }} value="90">90</option>
                                                                <option {{ auth()->user()->lesson_travel_time==105? 'selected': '' }} value="105">105</option>
                                                                <option {{ auth()->user()->lesson_travel_time==120? 'selected': '' }} value="120">120</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for=""><span class="text-danger">*</span> Calendar Default view</label> <br>
                                                    <label for="day">
                                                        <input id="day" name="calendar_default_view" {{ auth()->user()->calendar_default_view == "day"? 'checked': '' }} value="day" type="radio"> Day
                                                    </label>
                                                    <label for="week">
                                                        <input id="week" name="calendar_default_view" {{ auth()->user()->calendar_default_view == "week"? 'checked': auth()->user()->calendar_default_view == ""? 'checked':'' }} value="week" type="radio"> Week
                                                    </label>
                                                    <label for="month">
                                                        <input id="month" name="calendar_default_view" {{ auth()->user()->calendar_default_view == "month"? 'checked': '' }} value="month" type="radio"> Month
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <button class="btn btn-block btn-success btn-lg"> SAVE </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-xl" style="width: 900px; max-width: 900px">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">SERVICE REGION</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">

                                                <label for=""><span class="text-danger">*</span> Service regions </label>
                                                <p>Please click on the map or use the text box to define your service area. Learners in your chosen area will be able to view your profile and book a lesson with you. You can add and remove suburbs at any time.</p>

                                                <div class='m-b-15 m-t-15' id='editMap' style='height: 450px;'></div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="" for="instructor_user_language_spoken">Select Regions</label>
                                                        <div class="input-group">

                                                            <select name="user_regions[]" multiple="" class="form-control select2_regions" id="user_regions" style="width: 100%">
                                                                <?php foreach($regions as $region){

                                                                $selected="";
                                                                if( in_array( $region->id , $user_region_ids )){
                                                                    $selected = "selected";
                                                                }
                                                                ?>
                                                                <option {{ $selected }} value="{{ $region->id }}">{{ $region->title }}</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a onclick="update_regions()" class="btn btn-success waves-effect text-left" >Save</a>
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $lat = "-33.865143";
    $long = "151.2099";
    foreach($user_regions as $region){
        $reg = \App\Region::whereId($region->region_id)->select('data')->where('data', '!=', '')->first();

        if($reg){

            $data = json_decode($reg->data);
            foreach ($data->base as $item){
                if(isset($item->lng) && isset($item->lat) ){
                    $lat = $item->lat;
                    $long = $item->lng;
                    break;
                }
            }
        }
    }
    ?>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        function update_regions()
        {
             var service_regions = $("#user_regions").val();
             console.log(service_regions);
               $.ajax({
                    url: "{{Route('update_user_region')}}",
                    data: {region_id:service_regions},

                    //contentType: false,
                   // processData: false,
                   dataType: "json",
                    type: 'POST',
                    success: function (res) {
                        if(res == '1'){
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Data has been saved',
                                showConfirmButton: false,
                                timer: 1500
                                })
                              location.reload();
                        }
                    }
                });
        }
    </script>
    <script>

        var modal_opend = false;
        function edit_service_region(){

            if(modal_opend == false){
                console.log('ok')
                initMap('editMap');
                modal_opend = true;
            }

            $('#edit_modal').modal('show');
        }

        function add_time(e, day){

            var htm = '<tr class="'+day+'_">' +
                '<td>' +
                '<input type="hidden" class="form-control" name="service_time_id['+day+']">'+
                '</td>' +
                '<td>' +
                '    <div class="row">' +
                '        <div class="col-md-5 col-sm-12">' +
                '            <div class="form-group">' +
                '                <div class="controls">' +
                '<select name="start_interval['+day+'][]" id="'+day+'_start" class="form-control">'+
                @foreach($timeslot as $slot)
                    '<option data-dt="" {{$slot->time_value == 9? 'selected':''}} value="{{$slot->time_value}}">{{$slot->time_value}}</option>'+
                @endforeach
                '</select>' +
                '</div>'+
                '            </div>'+
                '        </div>'+
                '<div class="col-sm-12 col-md-2 text-center">:</div>'+
                '<div class="col-md-5 col-sm-12">'+
                '            <select name="start_minutes['+day+'][]" class="form-control">'+
                '                <option value="00">00</option>'+
                '                <option value="15">15</option>'+
                '                <option value="30">30</option>'+
                '                <option value="45">45</option>'+
                '            </select>'+
                '        </div>'+
                '    </div>'+
                '</td>'+
                '<td>'+
                '<div class="col-md-12 text-center"> - </div>'+
                '</td>'+
                '<td>'+
                '<div class="row">'+
                '    <div class="col-md-5 col-sm-12">'+
                '        <div class="form-group">'+
                '            <div class="controls">'+
                '               <select name="end_interval['+day+'][]" id="'+day+'_end" class="form-control">' +
                @foreach($timeslot as $slot)
                    '<option data-dt="" {{$slot->time_value == 9? 'selected':''}} value="{{$slot->time_value}}">{{$slot->time_value}}</option>'+
                @endforeach
                '                </select>'+
                '            </div>'+
                '        </div>'+
                '    </div>'+
                '<div class="col-sm-12 col-md-2 text-center">:</div>'+
                '    <div class="col-md-5 col-sm-12">'+
                '        <select name="end_minutes['+day+'][]" class="form-control">'+
                '            <option value="00">00</option>'+
                '            <option value="15">15</option>'+
                '            <option value="30">30</option>'+
                '            <option value="45">45</option>'+
                '        </select>'+
                '    </div>'+
                '</div>'+
                '</td>'+
                '<td>'+
                '    <button onclick="remove_time(this, null)" type="button" class="btn btn-xs btn-danger pull-right"> <i class="fa fa-trash"></i> </button>'+
                '</td>'+
                '</tr>';

                var c_name = $(e).parent().parent().attr('class');

            var num = $('table tr.'+c_name).length;

            if( num == 1 ){
                $('table tr.'+c_name).after(htm);
            }else{
                $('table tr.'+c_name).last().after(htm);
            }
        }

        function remove_time(x)
        {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $(x).parent().parent().remove();
                }
            });
        }

        function get_region_data(e) {
            var t = [e.base];
            return "undefined" != typeof e.except_regions && e.except_regions.length > 0 && t.push(e.except_regions), "undefined" != typeof e.plus_regions && e.plus_regions.length > 0 && t.push(e.plus_regions), t
        }

        $(document).ready(function() {
            $('.select2_regions').select2();

            $('.select2_test_locations').select2({
                placeholder: 'Select your Test Locations',
                minimumInputLength: 2,
                ajax: {
                    url: '{{ url('autocomplete-test-locations') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.title,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });



            $('#user_regions').change(function (){
                 service_regions = $("#user_regions").val();
                 initMap('editMap');
            })

            /*remove element*/
            var removed_options = [];
            var removed_locations = [];

            $('#user_regions').on('select2:unselecting', function (e) {
                removed_options.push(e.params.args.data.id);
            });
            $('#test_location_ids').on('select2:unselecting', function (e) {
                removed_locations.push(e.params.args.data.id);
            });

            $(document).on('change', '#service_time .custom-checkbox input.custom-control-input', function () {
                if( $(this).is(':checked') ){
                    $(this).parent().find('input[value=yes]').prop('checked', true);
                    $(this).parent().find('input[value=no]').prop('disabled', true);

                    $(this).parent().find('.custom-control-label .fa').addClass('fa-check text-success').removeClass('fa-times text-danger');


                }else{
                    $(this).parent().find('input[value=yes]').prop('checked', false);
                    $(this).parent().find('input[value=no]').prop('disabled', false);
                    $(this).parent().find('.custom-control-label .fa').removeClass('fa-check text-success').addClass('fa-times text-danger');

                }
            });

            $('#edit_instructor').submit(function (){

               let errors = $('#errors');
               errors.html('');
                $('tr').removeClass('bg-danger-l');

                $('#loading').show();
                var data = new FormData(this);

                data.append('removed_options', removed_options);
                data.append('removed_locations', removed_locations);

                $.ajax({
                    url: "{{Route('save_service_regions')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){

                            Swal.fire({
                                type: 'success',
                                title: 'Stored',
                                text: res.message,
                                showConfirmButton: true,

                            }).then((result) => {
                                if (result.value) {
                                    document.location.href = "{{ route('services_availability') }}";
                                }
                            })


                        }else if(res.success == false){

                            if(res.errors!=false){

                                $('tr.'+res.day+'_').addClass('bg-danger-l');
                                $("html, body").animate({ scrollTop: 500 }, 1000);

                                errors.html(res.errors);
                            }else {
                                swal('Warning!', res.message, 'error');
                            }
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

        function initMap(map_id=null) {

            var lat = parseFloat("{{ $lat }}");
            var lng = parseFloat("{{ $long }}");

            var uluru = {lat: lat, lng: lng};

            service_regions = $("#user_regions").val();

            if(!Array.isArray(service_regions))
                service_regions = service_regions.split(',');

            if(map_id == null){
                map_id = "mymap";
            }

            var map = new google.maps.Map(document.getElementById(map_id), {
                zoom: 11,
                center: uluru
            });

            // console.log(uluru);
            if(map_id != "mymap") {

                if(service_regions !=''){
                    for (var i = 0, len = service_regions.length; i < len; i++) {
                        let id = service_regions[i];
                        (function(i){
                            window.setTimeout(function(){


                        $.getJSON(base_url + "/instructor-map-suburb?id=" + id, function (res) {
                            var data = JSON.parse(res.data);

                            if (data && data.base) {

                                var region_data = get_region_data(data);
                                var polygon = new google.maps.Polygon({
                                    paths: region_data,
                                    strokeColor: '#ffc20e',
                                    strokeOpacity: 0.95,
                                    strokeWeight: 2,
                                    fillColor: '#ffc20e',
                                    fillOpacity: 0.4
                                });
                                polygon.setMap(map);
                            }
                        });
                            }, i * 500);
                        }(i));
                    }
                }
            }
        }
    </script>
    <script async='' defer='defer' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAD3HqytidVYlVLYRCXCjuXCYeRWZDb4DA&amp;libraries=places&amp;language=en&amp;region=AU&amp;callback=initMap' type="text/javascript"></script>


@endsection
