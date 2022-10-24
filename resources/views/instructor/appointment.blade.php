@extends('layouts.app')
@section('content')
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <style>
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
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Booking List</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">Booking List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h5 class="mb-0" style="color: #ffffff;">
            ALL Booking
            <a  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="float: right;">
                <i class="fas fa-plus"></i>
            </a>
        </h5>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button class="refresh-btn btn btn-xs m-b-5 btn-primary pull-right m-b-5" data-toggle="tooltip" data-title="Refresh data" onclick="$('#appointments_table').DataTable().ajax.reload();"><i class="fas fa-sync-alt"></i></button>
                        <br><br>


                        @if($appointments->isNotEmpty())
                            @foreach($appointments as $appointment)

                                <h4 class="card-title">YOUR LESSON IN {{\Carbon\Carbon::parse($appointment->schedule_date)->format('j F Y')}}</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="d-flex align-items-center">
                                            <div class="m-r-10">
                                                @if( $appointment->avatar == '')
                                                    <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">
                                                @else
                                                    <img src="{{ url('assets/images/users/'.$appointment->avatar) }}" alt="user" class="img-circle" width="60">
                                                @endif
                                            </div>
                                            <div>
                                                <h3 class="m-b-0">{{$appointment->name}} {{$appointment->lname}}</h3>
                                                <span> <i class="fa fa-phone"></i> <a href="tel:{{$appointment->phone}}">{{$appointment->phone}}</a> </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        // echo "<pre/>";
                                        // print_r($UpcomingAppointment->address);
                                        // exit;
                                        ?>

                                        <?php
                                        $address = "";
                                        if(is_object($appointment)){
                                            // echo $appointment->address;
                                            $ad = @json_decode($appointment->address);
                                            if(json_last_error() == JSON_ERROR_NONE){
                                                $address = $ad->address .', '. @$ad->address_detail->city. ', '. @$ad->address_detail->country;
                                            }

                                        }
                                        ?>
                                        <p>

                                            <span style="font-weight: 600; font-size: 18px;">{{ $appointment->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$appointment->lesson_hour." hour" }}{{ $appointment->lesson_hour > 1 ? "s" : "" }}</span><br>

                                            <?php if($appointment->apptype=="test")
                                            {
                                                $start_date = $appointment->start_date;
                                                $pickup = strtotime($start_date)-3600;
                                                $pickuptime = date('h:i a', $pickup);
                                                $startT = date('h:i a', strtotime($appointment->start_date));
                                                ?>
                                                <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?> <br>Pickup time: {{$pickuptime}}<br>Start time: {{$startT}}</span><br> <?php
                                            }
                                            else{ ?>
                                                <span style="font-weight: 600; line-height: 35px;"><?php echo date('D, d F, Y', strtotime($appointment->schedule_date)); ?>&emsp;{{$appointment->time_slot}}</span><br> <?php
                                            } ?>

                                            @if(isset($address))
                                            <span>{{$address}}</span>
                                            @endif
                                        </p>

                                    </div>
                                </div>




                            @endforeach
                        @endif




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>

    <!-- This Page JS -->
    <script>

        $(document).ready(function() {

            var table =  $('#appointments_table').DataTable({
                "processing": true,
                "serverSide": true,
                "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
                "order": [[ 3, "desc" ]],
                "drawCallback": function () {
                    $('.myswitch').change(function () {

                        var id = $(this).val();
                        var status = 0;
                        if(this.checked) {
                            status = 1;
                        }
                        $.post('{{ route('update-appointment-status') }}',
                            {id:id, status:status},
                            function (data) {
                                if(data.success == true){
                                    $('#appointments_table').DataTable().ajax.reload();
                                }else{
                                    swal('OOPs', data.message, 'error');
                                }
                            });
                    });
                },
                "ajax": "{{ route('get-appointments') }}",
                "columns":[
                    { "data": "avatar", name:'avatar' },
                    { "data": "name", name:'name' },
                    { "data": "email", name:'email' },
                    { "data": "phone", name:'phone' },
                    { "data": "address", name:'address' },
                    { "data": "schedule_date", name:'schedule_date' },
                    { "data": "time_slot", name:'time_slot' },
                    { "data": "lesson_hour", name:'lesson_hour' },
                    { "data": "fees", name:'fees' },
                    { "data": "created_at", name:'created_at' },
                    { "data": "status", name:'status' },
                    // { "data": "action", name:'Actions', searchable: false, orderable: false },
                ]
            });

            /*edit use*/

        });
    </script>
@endsection
