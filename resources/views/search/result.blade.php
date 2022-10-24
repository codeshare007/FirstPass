@extends('layouts.app_guest')
@section('content')

    <link href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/js/calendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/list/main.css') }}" rel='stylesheet' />
    <style>
        .page_slider{position: relative}
        #search_modal .btn{
            font-size: 15px;
            padding: 10px;
            margin-right: 5px;
        }
        #search_modal .close{ top: 0px; right: 15px }
        #learner-price-table {
            -webkit-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            border-radius: 10px;
            border: 2px solid #212A37;
            background: white;
            margin: 20px 0;
            padding: 0 3px;
        }
        .ins .rounded-img{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            border-radius: 50%;
            overflow: hidden;
        }
        .ins .title{
            color: orange !important;
            font-weight: bold;
        }
        .row.ins {
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding: 15px 0px;
        }
        .row.ins:last-child {
            border: none !important;
        }

        .row.ins .pointer:hover{
            color: black !important;
            text-decoration: underline;
        }
        .fc-bbg{
            display: inline-block;
            border: 1px solid #8a8a8a;
            height: 20px;
            width: 20px;
            border-radius: 50%;
        }
        .fc-bbg.red{
            background: #8a8a8a;
        }
        .calendar-extra{
            text-align: center;
        }
        .calendar-extra ul{
            display: flex;
            justify-content: space-evenly;
            margin-top: 10px;
        }
        .calendar-extra .btn{
            display: inline-block;
            max-width: 300px;
            margin-top: 15px;
        }
    </style>
    <style>
        .ins .rounded-img{
            background: white;
            border: 3px solid white;
            -webkit-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -moz-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            -ms-box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            border-radius: 50%;
            overflow: hidden;
        }
        .ins .title{
            color: orange !important;
        }
        .row.ins {
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding: 15px 0px;
        }
        .row.ins:last-child {
            border: none !important;
        }
    
        .row.ins .pointer:hover{
            color: black !important;
            text-decoration: underline;
        }


        ul.list-inline, ol.list-inline {
            list-style: none;
            margin: 0;
        }
        ul.list-inline li, ol.list-inline li {
            float: none;
            display: inline-block;
            vertical-align: middle;
            margin-left: 0.9375rem;
        }
        body.public_instructors-index #date-range-filter-field .button.tiny, body.learner_view_instructor-index #date-range-filter-field .button.tiny {
            padding: 10px 15px;
            margin-bottom: 0 !important;
        }

        .button.secondary {
            background-color: #efefef;
            border-color: #efefef;
        }
        .button.tiny {
            padding: 0.4375rem 0.625rem;
            min-width: 0 !important;
            white-space: pre;
        }
        .text-oil {
            color: #212A37 !important;
        }
        .button.yellow, header#header div:not(.fixed) nav.top-bar section.top-bar-section ul.nav.right a.button.yellow {
            background-color: #ffc20e;
            border-color: #ffc20e;
        }
    </style>

 

    <div class="row">
        <div class="col-md-12">
            <div style="height: 300px;background: #f7f7f7;z-index: 99;padding: 15px 25px;">
                <form action="" id="searchForm">
                    <input type="hidden" name="search_type" value="1">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6 class="mb-2"><span class="color-main">Find</span> a driving instructor</h6>
                            <p class="text-dark">Including availability, pricing & bookings</p>
                            <div class="divider-sm-0 divider-md-30"></div>
                            <div class="driving_instructor_btn_wrap form-group type">
                                <button onclick="$(this).find('input').prop('checked', true); $('i.ato').removeClass('hidden'); $('i.mnl').addClass('hidden');" type="button" id="contact_form_submit active" class="btn btn-outline-darkgrey">
                                    <input type="radio" name="type" value="auto"  checked class="hidden">
                                    <i class="fa fa-check text-success ato"></i> AUTO
                                </button>

                                <button onclick="$(this).find('input').prop('checked', true); $('i.mnl').removeClass('hidden'); $('i.ato').addClass('hidden');" type="button" id="contact_form_submit" class="btn btn-outline-darkgrey">
                                    <input type="radio" name="type" value="manual" class="hidden" >
                                    <i class="fa fa-check text-success hidden mnl"></i>
                                    MANUAL
                                </button>
                            </div>
                            <div class="form-group">
                                <select name="region" id="" required class="select2">
                                    @if($search_id)
                                        <option value="{{$region->id}}">{{$region->title}}</option>
                                    @else
                                        <option value=""></option>
                                    @endif
                                </select>
                            </div>

                            <div class="search_wrap form-group mt-3">
                                <button class="btn btn-block btn-success">Search <i class="fa fa-spinner fa-spin hidden"></i></button>
                            </div>
                            @if(Session::has('success'))
                                <p class="text-center mt-2 text-success">{{ Session::get('success') }}</p>
                            @endif
                            @if(Session::has('error'))
                                <p class="text-center mt-2 text-danger">{{ Session::get('error') }}</p>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div style="background: #ffc457; padding: 18px">
        <div class="col-md-12">
            <h5 class="font-condensed small-margin-top-20 small-margin-bottom-10">
                Choose your instructor
            </h5>
            <p>We have <strong> <span class="total_inst">{{ $total }}</span> {{ $t_type }} instructors</strong> available in <strong class="area"></strong></p>
        </div>
        <div id="myBtnContainer">
            {{-- <label for="">Gender : </label>
            <button class="btn active" onclick="filterSelection('male')"> Male</button>
            <button class="btn" onclick="filterSelection('female')"> Female</button> --}}
            <ul class="list-inline small-margin-top-10" id="date-filter-field">
                <li id="gender-filter">
                    <strong class="text-oil medium-margin-right-5">Gender : </strong>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary gender" id="male" data-field="gender" data-val="male">Male</a>
                    </span>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary gender" id="female" data-field="gender" data-val="female">Female</a>
                    </span>
                </li>
                <li id="availability-filter">
                    <strong class="text-oil medium-margin-right-5">Availability : </strong>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary availability" id="weekdays" data-field="availability" data-val="weekdays">Weekdays</a>
                    </span>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary availability" id="weekend" data-field="availability" data-val="weekend">Weekend</a>
                    </span>
                </li>
                
                <li id="time-filter">
                    <strong class="text-oil medium-margin-right-5"></strong>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary time" id="am" data-field="time" data-val="am">AM</a>
                    </span>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary time" id="pm" data-field="time" data-val="pm">PM</a>
                    </span>
                    <span>
                        <a class="button filter-field tiny medium-fontsize-12 secondary time" id="any" data-field="time" data-val="any">Any Time</a>
                    </span>
                </li>
                
                {{-- 
                <li id="date-range-picker">
                    
                    <select name="test_location_date" id="test_location_date-search">
                                        <option value="" disabled selected>Select a day</option>
                                        <?php 
                                        $currentDate = date('Y-m-d');
                                        for ($i=1; $i <=75 ; $i++) 
                                        { 
                                            $onlyDay = date('l', strtotime($currentDate. ' + '.$i.' days'));
                                            $toCheck = strtolower(trim($onlyDay));
                                            $toShow = date('D, d M Y', strtotime($currentDate. ' + '.$i.' days'));
	                                        $toUse = date('Y-m-d', strtotime($currentDate. ' + '.$i.' days'));

                                            echo "<option value='".$toUse."'>".$toShow."</option>";
                                        } ?>
                                    </select>
                    
                </li>

                <li id="date-range-picker">
                    <strong class="text-oil medium-margin-right-5">Day</strong>
                    <span>
                        <a class="button tiny medium-fontsize-12 secondary" id="duration-level-1">TODAY -  Thu</a>
                    </span>
                    <span>
                        <a class="button secondary tiny medium-fontsize-12" id="duration-level-2">Fri - Mon</a>
                    </span>
                    <span>
                        <a class="button tiny medium-fontsize-12 yellow" id="duration-others">12 Jul - 22 Jul</a>
                    </span>
                </li> --}}
                <li id="clear-field">
                    <span>
                        <a class="btn oil hollow tiny medium-fontsize-12" id="clear-filter" onclick="clearFilterSelection()">Clear Filter</a>
                    </span>
                </li>
            </ul>
        </div>
        <hr>
        
            <!--<div class="row ins d-none" id="ajax_results">-->
            <!--</div>-->

        <div id="load_results">
        <?php
            $chunk = 0;
        ?>
        @foreach ($users as $user)
            <?php
                $language = json_decode($user->language);

                if($language!=''){
                    $language = implode(', ', $language);
                }

                if($user->preferred_name!=""){ $name = $user->preferred_name; }
                else { $name = $user->name; }

                $chunk++;
                if($chunk == 1){ ?>
                    <div class="row ins">
                <?php } ?>

                    <div class="col-md-6 user_{{ $user->id }}">

                        <div class="user_wrap">

                            <div class="row">
                                <div class="col-md-6 profile_wrap">
                                    @if( $user->avatar == '')
                                        <img src="{{ url('assets/images/users/default.png') }}" alt="user" >
                                    @else
                                        <img src="{{ url('assets/images/users/'.$user->avatar) }}" alt="user" >
                                    @endif
                                    <div class="profile_btn">
                                        <a href="{{ url('/search/'.$search_id.'/instructors/profile/'.$user->id) }}" class="btn btn-info btn-outline-info btn-sm ">View Profile</a>
                                        <a href="#" class="btn btn-info btn-outline-info btn-sm av-btn" data-id="{{$user->id}}" onclick="return openCal('{{$user->id}}', '{{ $name }}', '{{ $search_id }}');">Available Times</a>
                                    </div>
                                </div>

                                <div class="col-md-6 profile_cont_wrap">
                                    <a href="" class=""> {{ $name }} </a>
                                    <div class="row">
                                        <div class="col-md-12 mt-2 book_now_btn">
                                            <a href="{{ url('book-online/'.$search_id.'/instructor/'.$user->id) }}" class="btn btn-success btn-outline-success btn-sm">Book Now</a>
                                        </div>

                                        <div class="col-md-12 mt-1 profile_cont">
                                            <p> <span class="">{{ ucfirst($name) }}</span> speaks {{ $language }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                <?php
                if($chunk == 2){
                    $chunk = 0;
                    echo '</div>';
                }
            ?>
        @endforeach
        </div>
    </div>

    <div class="modal fade" id="availability_modal" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-100" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100"> Check Instructor Availability <div class="pull-right"> <div class="fc-bbg red"></div> <small>Booked out</small> <div class="fc-bbg"></div> <small>Available</small> </div>  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="small-padding-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                            <div class="row calendar-extra">
                                <div class="col-md-12">
                                    <ul class="list-inline text-center small-margin-bottom-20 small-fontsize-12">
                                        <li>• Driving lesson duration = 1 hour or 2 hours</li>
                                        <li>• Driving test package duration = 2.5 hours</li>
                                        <li>• Booking start times are in 15 minute increments</li>
                                    </ul>
                                    <a id="book_btn" href="" class="btn btn-block btn-warning text-uppercase"><span id="show_name"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/timegrid/main.js')}}"></script>

    <script>
        function openCal(inst_id, inst_name, search_id){
            $('#calendar').html('');

            //let inst_id = $(this).attr('data-id');
            $('#availability_modal').modal('show');
            $('#show_name').html('Book With '+inst_name);
            $('#book_btn').attr("href", base_url+"book-online/"+search_id+"/instructor/"+inst_id);

            jQuery.ajax({
                url: '{{ url('load_events') }}',
                type: 'POST',
                data: {
                    type: 'check_availability',
                    id: inst_id,
                },
                success: function(response) {
                    myCalendar(response.events, response.avl);
                }
            });

            return false;
        }

        $(document).on('click', '.openCal', function (e) {
            let inst_id = $(this).data('inst_id');
            let inst_name = $(this).data('inst_name');
            let search_id = $(this).data('search_id');
            $('#calendar').html('');

            //let inst_id = $(this).attr('data-id');
            $('#availability_modal').modal('show');
            $('#show_name').html('Book With '+inst_name);
            $('#book_btn').attr("href", "book-online/"+search_id+"/instructor/"+inst_id);

            jQuery.ajax({
                url: '{{ url('load_events') }}',
                type: 'POST',
                data: {
                    type: 'check_availability',
                    id: inst_id,
                },
                success: function(response) {
                    myCalendar(response.events, response.avl);
                }
            });

            return false;
        });

        function myCalendar(events_ar, avl_ar){

            let ev = events_ar;
            let avl = avl_ar;
            console.log(avl);
            //Object.assign({}, avl);
            //const myJSON = JSON.stringify(avl);

            var today = moment().format("YYYY-MM-DD");
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'timeGrid','momentPlugin' ],
                //height: 650,
                contentHeight:"auto",
                minTime: "05:00:00",
                maxTime: "22:00:00",
                columnHeader: true,
                columnHeaderText: function(date) {
                        return moment(date).format('ddd DD/M');
                    },
                //viewSkeletonRender: renderViewColumns,
                header: {
                    left: 'prev',
                    right: 'next',
                    center: 'title',
                },
                initialView: 'timeGridWeek',
                defaultDate: today,
                editable: false,
                navLinks: false, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                events:ev,
                views: {
                    month: {
                        columnFormat: 'ddd' // set format for month here
                    },
                    week: {
                        columnFormat: 'ddd D/M' // set format for week here
                    },
                    day: {
                        columnFormat: 'ddd' // set format for day here
                    }
                },
                businessHours: avl,
            });

            calendar.render();
        }
    </script>
    <script>    
        $('.select2').select2({
            placeholder: 'Enter your suburb',
            ajax: {
                url: '{{ url('autocomplete-regions') }}',
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

        
        $('#searchForm').submit(function (){

            $('.fa-spinner').removeClass('hidden');

            var data = new FormData(this);

            data.append("search_id", 1);

            $.ajax({
                url: "{{Route('search')}}",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {

                    if(res.success == true){

                        // $('.total_inst').html(res.total);
                        // $('.final_type').html(res.t_type);

                        // $('.area').text(res.title);

                        // $('#load_instructors').html(res.view);
                        // $('#search_modal').modal('show');

                    // window.history.replaceState("", "", "{{url('/')}}/"+res.search_id);
                    var search_url = "{{url('/instructors/search_id')}}/"+res.search_id;
                    window.location = search_url;

                    }else if(res.success == false){
                        swal('oops!', res.message, 'warning');

                    }
                    $('.fa-spinner').addClass('hidden');
                },
                error: function () {
                    $('.fa-spinner').addClass('hidden');
                }
            });

            return false;
            });
    </script>
    <script>
    // yellow
        // const filter_data = [];
        var search_id = "{{ $search_id }}";
        $(document).ready(function(){
            $("#date-filter-field a.filter-field").click(function(){
                // alert($(this).data('field'));
                doFilter($(this));
            });
            
            $("#test_location_date-search").change(function(){
                doFilter($(this));
            });
            
            
            
            
        });
        
        function doFilter(field){
                if(field){
                    $("#date-filter-field a."+field.data('field')).removeClass('yellow');
                    field.addClass('yellow');
                }
                
                
                var selectedGender = null;
                var selectedAvailability = null;
                var selectedTime = null;
                
                $("#gender-filter a.gender").each(function(){
                    if($(this).hasClass("yellow")){
                        selectedGender = $(this).data("val");
                    }    
                });
                
                $("#availability-filter a.availability").each(function(){
                    if($(this).hasClass("yellow")){
                        selectedAvailability = $(this).data("val");
                    }    
                });
                
                $("#time-filter a.time").each(function(){
                    if($(this).hasClass("yellow")){
                        selectedTime = $(this).data("val");
                        console.log(selectedTime);
                    }    
                });
                
                var selectedDate = $("#date-filter-field a.filter-field").val();
                
                $.ajax({
                    url: "{{url('search-filter')}}/"+search_id,
                    data: {gender:selectedGender, availability: selectedAvailability, time: selectedTime, date: selectedDate},
                    // contentType: false,
                    // processData: false,
                    type: 'post',
                    success: function (res) {
                        // $('#load_results').addClass('d-none')
                        $('#load_results').empty();
                        $('#load_results').removeClass('d-none');
                        console.log(res.message);
                        var html = '<div class="row ins">';
                        for (var a = 0; a < res.message.length; a++) {
                            if(res.message[a].avatar){
                                var user_img = res.message[a].avatar;
                            }else{
                                var user_img = 'default.png';
                            }
                            var user_id = res.message[a].id;
                            var user_name = res.message[a].name;
    
                            var language = jQuery.parseJSON(res.message[a].language);
    
                            if(language!=''){
                                language = language.join(', ');
                            }
                            if(a>0 && (a+1)%2!==0){
                                html+='</div><div class="row ins">';
                            }
                            
                            html+= '<div class="col-md-6 user_'+user_id+'"> <div class="user_wrap"> <div class="row"> <div class="col-md-6 profile_wrap"> <img src="{{ url("assets/images/users/") }}/'+user_img+'" alt="user" > <div class="profile_btn"> <a href="{{ url("/search/".$search_id."/instructors/profile/") }}/'+user_id+'" class="btn btn-info btn-outline-info btn-sm ">View Profile</a> <a href="#" class="btn btn-info btn-outline-info btn-sm av-btn openCal" data-inst_id="'+user_id+'" data-inst_name="'+user_name+'" data-search_id="'+search_id+'">Available Times</a> </div> </div> <div class="col-md-6 profile_cont_wrap"> <a href="" class=""> '+user_name+' </a> <div class="row"> <div class="col-md-12 mt-2 book_now_btn"> <a href="{{ url("book-online/".$search_id."/instructor/") }}/'+user_id+'" class="btn btn-success btn-outline-success btn-sm">Book Now</a> </div> <div class="col-md-12 mt-1 profile_cont"> <p> <span class="">'+user_name+'</span> speaks '+language+' </p> </div> </div> </div> </div> </div> </div>';
                            
                        }
                        html+='</div>';
                        // console.log(html);
                        $('#load_results').html(html);
                    }
                });
            }
        
        function filterSelection(field, data){
            console.log("test");
            // filter_data.push(data);
            //var search_id = "{{ $search_id }}";
            console.log(field);
            // $("#male").removeClass('yellow');
            
            $("#date-filter-field a."+field).removeClass('yellow');
            
            // $("#"+data).addClass('yellow');
           $(this).addClass('yellow');
            
            var selectedGender = null;
            var selectedAvailability = null;
            
            // $("#gender-filter a.gender").each(function(){
            //     if($(this).hasClass("yellow")){
            //         selectedGender = $(this).data("val");
            //     }    
            // });
            
            // $("#availability-filter a.availability").each(function(){
            //     if($(this).hasClass("yellow")){
            //         selectedAvailability = $(this).data("val");
            //     }    
            // });
            /*
            $.ajax({
                url: "{{url('search-filter')}}/"+search_id,
                data: {gender:selectedGender, availability: selectedAvailability},
                // contentType: false,
                // processData: false,
                type: 'post',
                success: function (res) {
                    $('#load_results').addClass('d-none')
                    $('#ajax_results').empty();
                    $('#ajax_results').removeClass('d-none');
                    console.log(res.message);
                    for (var a = 0; a < res.message.length; a++) {
                        if(res.message[a].avatar){
                            var user_img = res.message[a].avatar;
                        }else{
                            var user_img = 'default.png';
                        }
                        var user_id = res.message[a].id;
                        var user_name = res.message[a].name;

                        var language = jQuery.parseJSON(res.message[a].language);

                        if(language!=''){
                            language = language.join(', ');
                        }

                        var html = '<div class="col-md-6 user_'+user_id+'"> <div class="user_wrap"> <div class="row"> <div class="col-md-6 profile_wrap"> <img src="{{ url("assets/images/users/") }}/'+user_img+'" alt="user" > <div class="profile_btn"> <a href="{{ url("/search/".$search_id."/instructors/profile/") }}/'+user_id+'" class="btn btn-info btn-outline-info btn-sm ">View Profile</a> <a href="#" class="btn btn-info btn-outline-info btn-sm av-btn openCal" data-inst_id="'+user_id+'" data-inst_name="'+user_name+'" data-search_id="'+search_id+'">Available Times</a> </div> </div> <div class="col-md-6 profile_cont_wrap"> <a href="" class=""> '+user_name+' </a> <div class="row"> <div class="col-md-12 mt-2 book_now_btn"> <a href="{{ url("book-online/".$search_id."/instructor/") }}/'+user_id+'" class="btn btn-success btn-outline-success btn-sm">Book Now</a> </div> <div class="col-md-12 mt-1 profile_cont"> <p> <span class="">'+user_name+'</span> speaks '+language+' </p> </div> </div> </div> </div> </div> </div>';
                        $('#ajax_results').append(html);
                    }
                }
            });
            */
        }
        
        

        function clearFilterSelection(){
            $("#male").removeClass('yellow');
            $("#female").removeClass('yellow');
            $("#weekdays").removeClass('yellow');
            $("#weekend").removeClass('yellow');
            $("#time-filter a").removeClass('yellow');
            //$('#load_results').removeClass('d-none');
            // $('#ajax_results').addClass('d-none');   ''
            
            doFilter();
        }

        // var unique = filter_data.filter((v, i, a) => a.indexOf(v) === i);
        
    </script>
@endsection
