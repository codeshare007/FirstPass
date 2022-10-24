@extends('layouts.app')
@section('content')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/extra-libs/calendar/calendar.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Dashboard</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body b-l calender-sidebar">

                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-right">
                                <span style="position: relative; z-index: auto; left: 0px; top: 0px;"><i class="fa fa-circle text-info m-r-10"></i>your lessons</span>
                                <span style="position: relative; z-index: auto; left: 0px; top: 0px;"><i class="fa fa-circle text-danger m-r-10"></i>FirstPass lessons</span>
                            </div>
                        </div>

                        <div id="calendar" ></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- BEGIN MODAL -->
    <div class="modal none-border" id="my-event">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Add Lesson</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button id="create_btn" type="button" class="btn btn-success save-event waves-effect waves-light">Create Lesson</button>
                    <button id="delete_btn" type="button" class="btn btn-danger delete-event waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade none-border" id="show_event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p class="text-center"> Lesson's start date <span class="label label-floating label-success start"></span> , end date <span class="label label-info label-floating end"></span> </p>
                    <div class="clearfix"></div>
                    <hr>
                    <div id="detail"></div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-info btn-round" data-dismiss="modal">Sounds good!<div class="ripple-container"></div></button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        ! function($) {
            "use strict";

            var CalendarApp = function() {
                this.$body = $("body")
                this.$calendar = $('#calendar'),
                    this.$event = ('#calendar-events div.calendar-events'),
                    this.$categoryForm = $('#add-new-event form'),
                    this.$extEvents = $('#calendar-events'),
                    this.$modal = $('#my-event'),
                    this.$saveCategoryBtn = $('.save-category'),
                    this.$calendarObj = null
            };

                /* on click on event */
                CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                    var $this = this;
                    $this.$modal.modal({
                        backdrop: 'static'
                    });
                    let id = calEvent.id;
                    if(id!='') {
                        $('#loading').show();
                        $.post('{{ url('show-event') }}',
                            {id: id, _token: '{{ csrf_token() }}'},
                            function (data) {

                            let st_date = data.start_date.split(" ");

                            let end_date = data.end_date.split(" ");

                            var final_address = "";
                            if(data.address.length > 1) { 
                                var addressObj = jQuery.parseJSON( data.address );
                                final_address = addressObj.address;
                            }


                            console.log(data);
                            let username = data.user.name + " " + data.user.lname

                            if(data.type == "test"){
                                var booking_type = "Driving Test";
                            }
                            else{
                                var booking_type = "Driving Lesson";
                            }

                                var form = $("<form></form>");
                                form.append("<div class='row'></div>");
                                form.find(".row")
                                    .append("<input type='hidden' name='id' value='"+data.id+"'><div class='col-md-12'><div class='form-group'><label class='control-label'>Lesson Detail/Title</label><input required class='form-control' value='"+username+"' placeholder='Lesson Detail/Title' type='text' name='detail' /></div></div>")
                                    .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Address</label><input class='form-control' value='"+final_address+"' placeholder='Address' type='text' name='address'/></div></div>")
                                    .append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Booking Type</label><input class='form-control' value='"+booking_type+"' readonly></div></div>")
                                    .append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Start date</label><input id='from' class='form-control disable' value='"+st_date[0]+"' disabled name='start_date'></div></div>") ;

                                    if(data.type == "test"){
                                        form.find(".row").append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Pickup time</label><input class='form-control' value='"+data.pickuptime+"' readonly></div></div>");
                                    }

                                    form.find(".row").append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Start time</label><input type='time' class='form-control start_time' name='start_time' required value='"+st_date[1]+"' /></div></div>")

                                    .append('<div class="col-md-3"><div class="form-group"><label class="control-label">End date</label><input id="toDate" class="form-control" value="'+end_date[0]+'" name="end_date" required></div></div>' +
                                        '<div class="col-md-3">'+
                                        '<div class="form-group">'+
                                        '<label class="control-label">End time</label>'+
                                        '<input type="time" class="form-control end_time" name="end_time" value="'+end_date[1]+'" required/>'+
                                        '</div></div>')
                                    .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Note</label><textarea class='form-control' name='note'  rows='3'>"+data.note+"</textarea></div></div>")

                                    $this.$modal.find('.delete-event').attr('onclick', 'deleteEvent('+data.id+', '+data.is_private+')').show().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                                    form.submit();
                                });
                                
                                if(data.is_private){
                                    $('#create_btn').show();
                                    $('#delete_btn').show();
                                }else{
                                    $('#create_btn').hide();
                                    $('#delete_btn').hide();
                                }

                                $('#loading').hide();

                                $this.$modal.find('form').on('submit', function () {
                                    let d = new FormData(this);

                                    $.ajax({
                                        url: "{{url('add_event')}}",
                                        data: d,
                                        contentType: false,
                                        processData: false,
                                        type: 'POST',
                                        success: function (res) {
                                            $('#loading').hide();
                                            $this.$modal.modal('hide');
                                            swal('Success!', 'Lesson added successfully!', 'success');
                                            window.location.reload();
                                        },
                                        error: function () {
                                            $('.fa-spinner').addClass('hidden');
                                            swal('oops!', 'something went wrong', 'warning');
                                        }
                                    });

                                    $this.$modal.modal('hide');
                                    return false;
                                });

                            });
                    }
                },
                /* on select */
                    CalendarApp.prototype.onSelect = function (start, end, allDay) {
                        // on empty cell click
                        @if(Auth::user()->type == 'inst')
                        var $this = this;
                        $this.$modal.modal({
                            backdrop: 'static'
                        });

                        var form = $("<form></form>");
                        form.append("<div class='row'></div>");
                        form.find(".row")
                            .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Lesson Detail/Title</label><input class='form-control' required placeholder='Event title' type='text' name='detail' /></div></div>")
                            .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Address</label><input class='form-control' placeholder='Address' type='text' name='address'/></div></div>")
                            .append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Start date</label><input id='from' class='form-control disable' value='"+start.format('DD-MM-YYYY')+"' disabled name='start_date'></div> </div> " +
                                '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                '<label class="control-label">Start time</label>'+
                                '<input type="time" class="form-control start_time" name="start_time" required />'+
                                '</div></div>')
                            .append('<div class="col-md-3"><div class="form-group"><label class="control-label">End date</label><input id="toDate" class="form-control" name="end_date" required></div></div>' +
                                '<div class="col-md-3">'+
                                '<div class="form-group">'+
                                '<label class="control-label">End time</label>'+
                                '<input type="time" class="form-control end_time" name="end_time" required/>'+
                                '</div></div>')
                            .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Note</label><textarea class='form-control' name='note'  rows='3'></textarea></div></div>")

                        $this.$modal.find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function () {
                            form.submit();
                        });

                        $('.start_time').val(start.format("HH")+":00");
                        if(start.format("HH") == end.format("HH")){
                            $('.end_time').val(end.add(moment.duration("01:00:00")).format("HH")+":00");
                        }else {
                            $('.end_time').val(end.format("HH") + ":00");
                        }
                        $('#toDate').val(end.format('DD-MM-YYYY'));

                        $this.$modal.find('form').on('submit', function () {
                            var title = form.find("input[name='detail']").val();

                                $this.$calendarObj.fullCalendar('renderEvent', {
                                    title: title,
                                    start:start,
                                    end: end,
                                    allDay: false,
                                    className: 'bg-primary'
                                }, true);

                                $('#loading').show();

                                var startDate = start.format('DD-MM-YYYY');
                                var endDate = $("input[name='end_date']").val();
                                var detail = $("input[name='detail']").val();
                                var start_time = $("input[name='start_time']").val();
                                var end_time = $("input[name='end_time']").val();
                                var note = $("textarea[name='note']").val();
                                var address = $("input[name='address']").val();

                                $.post('{{ url('add_event') }}',
                                    {start_time:start_time, end_time:end_time, title:title, start:startDate, end:endDate, detail:detail, address:address, note:note, _token : '{{ csrf_token() }}'},
                                    function(data){
                                        $('#loading').hide();
                                     window.location.reload();
                                    });

                                //console.log( title+ ' ' +start + ' '+end +' '+ categoryClass );

                                $this.$modal.modal('hide');

                            return false;

                        });
                        $this.$calendarObj.fullCalendar('unselect');
                        @else
                        console.log('cell click');
                        @endif
                    },
                CalendarApp.prototype.enableDrag = function() {
                    //init events
                    $(this.$event).each(function() {
                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        };
                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject);
                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 999,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0 //  original position after the drag
                        });
                    });
                },
            /* Initializing */
            CalendarApp.prototype.init = function() {
                this.enableDrag();
                /*  Initialize the calendar  */
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var form = '';
                var today = new Date($.now());
                
                var defaultEvents = [
                        <?php foreach($web_events as $val){
                            $start_date="";$end_date="";
                        $add_hour = 3600;
                        if($val->lesson){
                            $add_hour = 7200;
                        }
                        if(isset($val->start_date) || $val->start_date!="")
                        {
                        //$start_date = date('Y-m-d H:i', strtotime($val->schedule_date." ".$val->time_slot));
                        //$end_date = date('Y-m-d H:i', strtotime($val->schedule_date." ".$val->time_slot)+$add_hour);
                        $start_date = date('Y-m-d H:i', strtotime($val->start_date));
                        $end_date = date('Y-m-d H:i', strtotime($val->end_date));

                        if($val->type=="test"){
                            $test1=(strtotime($val->start_date)-3600);
                           $start_date = date('Y-m-d H:i', $test1);
                            //$date = new DateTime($start_date);
                            //$date->sub(new DateInterval('PT1H'));
                           // $start_date=$date->format('Y-m-d H:i');
                        }
                        else
                        {
                             $start_date = date('Y-m-d H:i', strtotime($val->start_date));
                        }

                        ?>
                        {
                        "id": {{ $val->id }},
                        "title": "{{ $val->detail==""? 'private': $val->detail }}",
                        //"title": "{{ $val }}",
                        "start": "{{ $start_date }}",
                        "end": "{{ $end_date }}",
                        "className": "bg-danger"
                        },
                    <?php } }
                    foreach($private_events as $val){
                        $start_date = date('Y-m-d H:i', strtotime($val->start_date));
                        $end_date = date('Y-m-d H:i', strtotime($val->end_date)); ?>

                        {
                        "id": {{ $val->id }},
                        "title": "{{ $val->detail }}",
                        "start": "{{ $start_date }}",
                        "end": "{{ $end_date }}",
                        "className": "bg-info"
                        },
                    <?php } ?>
                ];
                

                console.log({!! json_encode($avl) !!});
                console.log(defaultEvents);
                

                var $this = this;
                $this.$calendarObj = $this.$calendar.fullCalendar({
                    defaultView: 'agendaWeek',
                    handleWindowResize: true,
                    minTime: "05:00:00",
                    maxTime: "22:00:00",
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
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: defaultEvents,
                    businessHours: {!! json_encode($avl) !!},
                    contentHeight:"auto",
                    editable: false,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectConstraint: "businessHours",
                    drop: function(date) { $this.onDrop($(this), date); },
                    select: function(start, end, allDay) { $this.onSelect(start, end, allDay); },
                    eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }

                });


            },
                //init CalendarApp
                $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

        }(window.jQuery),

//initializing CalendarApp
            $(window).on('load', function() {
                $.CalendarApp.init();
            });

        $(document).on('click', '#toDate', function() {
            $(this).datepicker({
                autoclose: true,
                todayHighlight: true,
                dateFormat: 'dd-mm-yy'
            }).focus();
        });

        /* timepicker int */
        $(document).on('click', '.startTimepicker, .endTimepicker', function(){
            $(this).datetimepicker({
                //          format: 'H:mm',    // use this format if you want the 24hours timepicker
                format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            }).focus();
        });

        /*$(document).on('click', '.fc-content', function(){
            var id = $(this).find('span').attr('data-id');
            if(id!='') {
                $('#loading').show();
                $.post('{{ url('show-event') }}',
                    {id: id, _token: '{{ csrf_token() }}'},
                    function (data) {
                        var $moda = $('#show_event');

                        if(data.error != 1){
                            $moda.find('.modal-title').html(data.title);
                            $moda.find('.modal-body #detail').html(data.detail);
                            $moda.find('.modal-body .start').html(data.start_date);
                            $moda.find('.modal-body .end').html(data.end_date);
                            $moda.modal('show');
                        }
                        $('#loading').hide();
                    });
            }
        });*/
        function deleteEvent(x, is_private)
        {

            if(is_private == 0){
                swal("Oops!", "You can't delete FistPass events, only private events can be deleted.")
                return false;
            }

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
                    $("#loading").show();
                    $.post('{{ url("delete-event")}}',{id:x, _token:"{{csrf_token()}}"},function(res){
                        $("#loading").hide();

                        if(res.success==true){

                            swal("Deleted!",res.message, "success");
                            window.location.reload();

                        }else if(res.success==false){
                            swal("Error!",data.message, "error");
                        }

                    });

                } else {
                    //swal("Cancelled", "Your action has been cancelled!", "cancel");
                }
            });
        }
    </script>

@endsection
