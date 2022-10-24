@extends('layouts.app')
@section('content')
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ url('assets/js/calendar/packages/core/main.css') }}" rel='stylesheet' />
    <link href="{{ url('assets/js/calendar/packages/daygrid/main.css') }}" rel='stylesheet' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding-bottom: 5px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        .refresh-btn{
            position: absolute;
            top: 13px;
            right: 22px;
        }
        .buttons-csv.buttons-html5{margin-bottom: 10px}

        #show_slots .btn-switch{
            margin-right: 3px;
            width: 96px !important;
            float: left;
        }
        .btn-switch label
        {
            width: 100%;
            margin-bottom: 0px !important;
            margin-top: 6px !important;
            background: #ffcb00;
            border-color: #ffcb00;
        }
        .btn-switch
        {
            width: 100px;
            margin-right: 7px;
        }
        .btn-switch > input[type="radio"] + .btn {
            background-color: transparent !important;
            border-color: #4BB543;
            color: #4BB543 !important;
        }

        .btn-switch > input[type="radio"] + .btn > em {
            display: inline-block;
            border: 1px solid #4BB53F;
            border-radius: 50%;
            padding: 2px;
            margin: 0 4px 0 0;
            top: 1px;
            font-size: 10px;
            text-align: center;
        }
        .btn-switch input[type=radio]{display: none}
        .input[type="radio"] + label:before{
            content: none !important;
        }
        .btn-switch strong{ font-weight: normal !important; }
        table thead td{
            color: #2b2b2b;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding-bottom: 5px;
        }

        #calendar td, #calendar th, #calendar tr, #calendar table{
            border: 0 !important;
            margin: 0;
        }
        .fc-row.fc-week div > table{
            border-spacing: 1px!important;
            border-collapse: initial !important;
        }

        .fc-dayGrid-view .fc-body .fc-row{
            min-height:0!important;
        }

        .fc-row.fc-week div > table .fc-day{
            border-spacing: 15px;

        }
        .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number{
            float: none!important;
        }
        .fc .fc-row .fc-content-skeleton td{
            text-align: center;
        }
        .fc-nonbusiness{
            background: none;
        }
        .fc-dayGridMonth-view > table{
            border: none;
        }
        th.fc-day-header{
            border: 0;
            border-color: white!important;
        }
        .fc-bgevent-skeleton td{
            background: #ddd !important;
            border-radius: 10px !important;
            border-collapse: initial;
            cursor: pointer;
        }
        td{ cursor: pointer;}

        .fc-unthemed td.fc-today a{
            color: #ff761f !important;
        }
        .fc-slats table td, .fc-row.fc-widget-header th{
            border: 1px solid #dddddd !important;
        }
        .fc-row .fc-content-skeleton td{ padding-top: 18px }
        .fc-scroller{height: auto!important; overflow: unset!important;}
        .fc-row .fc-content-skeleton{padding-bottom: 0!important;}
        .fc-head{background: #ffcb00}
        h5.title .badge{ font-size: 50% }
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Lesson List</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Lesson List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h5 class="mb-0" style="color: #ffffff;">
            ALL Lessons
            <a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="float: right;">
                <i class="fas fa-plus"></i>
            </a>
        </h5>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button class="refresh-btn btn btn-xs m-b-5 btn-primary pull-right m-b-5" data-toggle="tooltip" data-title="Refresh data" onclick="$('#lessons_table').DataTable().ajax.reload();"><i class="fas fa-sync-alt"></i></button>
                        <br><br>
                        <div class="table-responsive">
                            <table  id="lessons_table" class="table table-striped table-bordered display">
                                <thead>
                                <tr>
                                    <th>Instructor</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Schedule Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="TimeSlotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id="book_time">
                    <input type="hidden" name="schedule_date">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Choose Time Slots</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" class="form-control" name="search_id" id="search_id">
                            <input type="hidden" class="form-control" name="id" id="appt_id">
                            <input type="hidden" class="form-control" name="instructor_id" id="instructor_id">
                            <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-7">
                                    <div id="calendar"></div>
                                </div>
                                <div class="col-md-5">
                                    <div id="show_slots"></div>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>
    <script src="{{ asset('assets/js/calendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/packages/timegrid/main.js')}}"></script>
    <!-- This Page JS -->
    <script>

        function myCalendar(data, instructor_id) {

            $('#calendar').html('');

            var mon='no',tue='no',wed='no',thu='no',fri='no',sat='no',sun='no';

            $.each(data.working_time, function(key,val){

                if(val.day == 'monday')
                     mon = val.is_enabled;

                else if(val.day == 'tuesday')
                     tue = val.is_enabled;

                else if(val.day == 'wednesday')
                     wed = val.is_enabled;

                else if(val.day == 'thursday')
                     thu = val.is_enabled;

                else if(val.day == 'friday')
                     fri = val.is_enabled;

                else if(val.day == 'saturday')
                     sat = val.is_enabled;

                else if(val.day == 'sunday')
                     sun = val.is_enabled;
            });

                var calendarEl = document.getElementById('calendar');
                var today = moment().format("YYYY-MM-DD");

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['interaction', 'dayGrid', 'timeGrid'],

                    header: {
                        left: 'prev',
                        center: 'title',
                        right: 'dayGridMonth, next'
                    },

                    unselectAuto: false,
                    dragScroll: false,
                    defaultDate: today,
                    //eventLimit: true,
                    navLinks: true, // can click day/week names to navigate views
                    businessHours: true, // display business hours
                    editable: true,
                    selectable: true,
                    selectMirror: true,
                    selectLongPressDelay: false,
                    eventLongPressDelay: false,
                    LongPressDelay: false,
                    backgroundColor: 'red',
                    /*hiddenDays: hidden_days,*/
                    select: (start, end, allDay) => {
                        //console.log(start);
                        const date = moment(start.startStr);
                        const weak_day = date.day();
                        //console.log(weak_day);
                        var start_date = start.startStr;

                        if (start_date < today) {
                            swal('Warning', 'You cannot select a date prior to the current date', 'warning');
                            return false;
                        } else {

                            if (weak_day == 0 && sun == 'no') {
                                swal('Warning', 'Sunday is closed', 'warning');
                                return false;
                            } else if (weak_day == 1 && mon == 'no') {
                                swal('Warning', 'Monday is closed', 'warning');
                                return false;
                            } else if (weak_day == 2 && tue == 'no') {
                                swal('Warning', 'Tuesday is closed', 'warning');
                                return false;
                            } else if (weak_day == 3 && wed == 'no') {
                                swal('Warning', 'Wednesday is closed', 'warning');
                                return false;
                            } else if (weak_day == 4 && thu == 'no') {
                                swal('Warning', 'Thursday is closed', 'warning');
                                return false;
                            } else if (weak_day == 5 && fri == 'no') {
                                swal('Warning', 'Friday is closed', 'warning');
                                return false;
                            } else if (weak_day == 6 && sat == 'no') {
                                swal('Warning', 'Saturday is closed', 'warning');
                                return false;
                            }
                        }
                        /*time slots request*/
                        $("#show_slots").html('<center><i class="fa fa-spin fa-spinner"></i></center>');

                        $.post('{{url('get-slots')}}',
                            {
                                start_date: start_date,
                                instructor_id: instructor_id,
                                '_token': '{{ @csrf_token() }}'
                            },
                            function (data) {
                                $("#show_slots").html('');
                                $("#loading").hide();
                                $("#show_slots").append(data.html);
                                $("#date").text(start_date);
                                $("input[name='schedule_date']").val(start_date);
                            })

                    },
                });

                calendar.render();

                $(document).ready(function () {
                    window.setInterval(function () {
                        //console.log('clicked')
                        $('.fc-day-number').removeAttr('data-goto');
                    }, 1000);
                });

                $(document).on('click', '.fc-day-top', function () {

                    setTimeout(function () {
                        $('.fc-dayGridDay-view .fc-day-grid-container').prepend('<div class="alert-box success">' +
                            '<div class="alert alert-success">' +
                            ' <small>Click anywhere on the box below to show the available timeslots. Click the month button above to return to full calendar view.</small>' +
                            '</div>' +
                            '</div>');
                    }, 1);
                })

        }

        $(document).ready(function() {

            var table =  $('#lessons_table').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
                "ajax": "{{ route('get-lessons') }}",
                "columns":[
                    { "data": "avatar", name:'avatar' },
                    { "data": "email", name:'email' },
                    { "data": "phone", name:'phone' },
                    { "data": "address", name:'address' },
                    { "data": "schedule_date", name:'schedule_date' },
                    { "data": "time_slot", name:'time_slot' },
                    { "data": "status", name:'status' },
                    { "data": "type", name:'type' },
                    { "data": "action", name:'Actions', searchable: false, orderable: false },
                ]
            });
        });

        function ShowTimeSlots(e){
            var instructor_id = $(e).attr('data-instructor-id');
            var start_date = $(e).attr('data-start-date');
            var search_id = $(e).attr('data-search-id');
            var id = $(e).attr('data-id');

            //$('#calendar').html('');

            $('#availability_modal').modal('show');

            jQuery.ajax({
                url: '{{ url('get_instructor_calendar') }}',
                type: 'POST',
                data: {
                    id: instructor_id,
                },

                success: function(response) {

                    $('#instructor_id').val(instructor_id);
                    $('#appt_id').val(id);
                    // $('#date_picker').val(start_date);
                    $('#search_id').val(search_id);
                    $('#TimeSlotModal').modal('show');

                    myCalendar(response, instructor_id);
                }
            });
        }

        $('#date_picker').change(function() {
            $("#loading").show();
            var start_date = $(this).val();
            var instructor_id = $('#instructor_id').val();
            $.post('{{url('get-slots')}}',
                { start_date:start_date, instructor_id: instructor_id, '_token': '{{ @csrf_token() }}' },
                function (data) {
                    if(data.html){
                        $("#show_slots").html('');
                        $("#loading").hide();
                        $("#show_slots").append(data.html);
                    }else{
                        $("#show_slots").html('');
                        $("#loading").hide();
                        $("#show_slots").html('<center><h4 class="text-danger"><strong>oops!</strong> Time Slot not Available</h4></center>');
                    }
                })
        });

        $('#book_time').submit(function (){

            var data = new FormData(this);

            $.ajax({
                url: "{{Route('Update-book-time')}}",
                data: data,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (res) {

                    if(res.success == true){

                        swal('Congrats!', res.message, 'success')
                        .then(function() {
                            $('#TimeSlotModal').modal('hide');
                            $('#lessons_table').DataTable().ajax.reload();
                        });

                    }else if(res.success == false){
                        swal('oops!', res.message, 'warning');

                    }
                    // $('.fa-spinner').addClass('hidden');
                },
                error: function () {
                    // $('.fa-spinner').addClass('hidden');
                    swal('oops!', 'something went wrong', 'warning');
                }
            });

            return false;
        });

        function AppointmentComplete(e){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, complete it!'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        $("#loading").show();
                        var InstructorID = $(e).attr('data-instructor-id');
                        var AppointmentID = $(e).attr('data-appointment-id');
                        $.post('{{ route("Change-appointment-status")}}',{AppointmentID:AppointmentID, InstructorID:InstructorID},function(res){
                            $("#loading").hide();

                            if(res.success==true){

                                swal("Congrats!",res.message, "success");
                                $('#lessons_table').DataTable().ajax.reload();

                            }else if(res.success==false){
                                swal("Error!",data.message, "error");
                            }

                        });

                        return false;
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
        }
    </script>
@endsection
