@extends('layouts.app')

@section('content')
    <style>
        .fa-star{color: #ece10d;}
        .fa-star-o{color: #cccccc;}
         
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
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

<?php $learner_id = auth()->user()->id; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card  bg-light no-card-border">
                    <div class="card-body">
                        @if($search_check!='')
                            <a href="{{ url('/search/instructors/all') }}" class="pull-right btn btn-success">Book another instructor</a>
                        @endif
                        
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                @if(auth()->user()->avatar !='')
                                    <img src="{{ url('assets/images/users/'.auth()->user()->avatar) }}" alt="user" width="60" class="rounded-circle" />
                                @else
                                    <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="rounded-circle" width="60">
                                @endif
                            </div>
                            <div class="pull-left">
                                <h3 class="m-b-0">Welcome back!</h3>
                                <span>{{ \Carbon\Carbon::now()->format('l jS \of F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Your Instructors</h4>
                        <div class="d-flex align-items-center flex-row m-t-30">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th data-toggle="tooltip" title="Total completed lessons">Completed</th>
                                        <th data-toggle="tooltip" title="Total purchased lessons">Booked</th>
                                        <th></th>
                                        <th>Review</th>
                                        <th>Rating</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($instructors as $inst)
                                        <?php
                                        $rating = \App\UserRatings::select('review', \Illuminate\Support\Facades\DB::raw('count(score) as total, AVG(score) as avg'))
                                            ->where('user_id', $inst->instructor_id)
                                            ->first();

                                        /*compled appointments*/
                                        $completed = \App\Appointments::where('instructor_id', $inst->instructor_id)
                                            ->where('user_id', auth()->user()->id)
                                            ->where('status', 'completed')
                                            ->count();

                                        $total = \App\Appointments::where('instructor_id', $inst->instructor_id)
                                            ->where('user_id', auth()->user()->id)
                                            ->count();

                                        
                                        $userMeta = \App\UserMeta::where('user_id', $inst->instructor_id)->select('vehicle_auto_id','vehicle_manual_id')->first();
                                        
                                        if($userMeta){
                                            $vehicle_auto_id = \App\InstructerVehicle::where('id',$userMeta->vehicle_auto_id)->first();
                                            if($vehicle_auto_id){
                                                $vehicle_id_image = $vehicle_auto_id->vehicle_image;
                                            }
                                            $vehicle_manual_id = \App\InstructerVehicle::where('id',$userMeta->vehicle_manual_id)->first();
                                            if($vehicle_manual_id){
                                                $vehicle_id_image = $vehicle_manual_id->vehicle_image;
                                            }
                                        }
                                        $vehicle_image = $vehicle_id_image ?? '';

                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10">
                                                        @if( $inst->avatar == '')
                                                            <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle rounded-circle" width="60">
                                                        @else
                                                            <img src="{{ url('assets/images/users/'.$inst->avatar) }}" alt="user" class="img-circle rounded-circle" width="60">
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16">{{$inst->name}} {{$inst->lname}}</h4>
                                                        <?php /*<span>{{$inst->email}}</span><br>*/ ?>
                                                        <span>{{$inst->phone}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $completed }}</td>
                                            <td>{{ $total }}</td>
                                            <td><a data-fancybox="gallery" href="{{ asset('assets/images/cars/'.$vehicle_image) }}"><img src="{{ asset('assets/images/cars/'.$vehicle_image) }}" alt="" height="60"></a></td>
                                            <td>{{ $rating->review }}</td>
                                            <td>
                                                <span style="font-size: 10px" id="rating" data-read="true" data-score="{{ floor($rating->avg) }}" class="click"></span>
                                                <dev class="btn btn-success" onclick="reviewPop('{{ $inst->instructor_id }}')" > Review </dev>
                                            </td>
                                            <td>
                                                <a data-instructor="{{ $inst->id }}" href="#" type="button" class="btn btn-warning book-inst"> BOOK NOW </a>
                                            </td>
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

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body p-b-0">
                        @if(isset($UpcomingAppointment->avatar))
                            <h4 class="card-title">YOUR NEXT LESSON IN {{\Carbon\Carbon::parse($UpcomingAppointment->schedule_date)->format('j F Y')}}</h4>
                            <hr>
                            <div class="row @if($UpcomingAppointment->time_slot == '') bg-danger text-white @endif" @if($UpcomingAppointment->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>
                                <div class="col-md-6">

                                    <div class="d-flex align-items-center">
                                        <div class="m-r-10">
                                            @if( $UpcomingAppointment->avatar == '')
                                                <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">
                                            @else
                                                <img src="{{ url('assets/images/users/'.$UpcomingAppointment->avatar) }}" alt="user" class="img-circle" width="60">
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="m-b-0">{{ ucwords($UpcomingAppointment->name .' '. $UpcomingAppointment->lname) }}</h3>
                                            <span> <i class="fa fa-phone"></i> <a href="tel:{{$UpcomingAppointment->phone}}">{{$UpcomingAppointment->phone}}</a> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <strong>
                                    <p>
                                    <strong>{{ $UpcomingAppointment->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$UpcomingAppointment->lesson_hour." hour" }}{{ $UpcomingAppointment->lesson_hour > 1 ? "s" : "" }}</strong> <br>

                                    <?php //echo $UpcomingAppointment->apptype; 
                                    if($UpcomingAppointment->apptype=="test")
                                    { 
                                        $start_date = $UpcomingAppointment->start_date;
                                        $pickup = strtotime($start_date)-3600;
                                        $pickuptime = date('h:i a', $pickup);
                                        $startT = date('h:i a', strtotime($UpcomingAppointment->start_date));
                                        echo date('D, d F, Y', strtotime($UpcomingAppointment->schedule_date))."<br/>";
                                        echo "Pickup time: ".$pickuptime."<br>Start time: ".$startT;
                                    }
                                    else{
                                        echo date('D, d F, Y', strtotime($UpcomingAppointment->schedule_date))." ".$UpcomingAppointment->time_slot;
                                    } ?>
                                    

                                    <br>

                                    </strong>
                                    
                                    <?php 
                                    $address = "";
                                    if(is_object($UpcomingAppointment)){
                                        // echo $UpcomingAppointment->address;
                                        $ad = @json_decode($UpcomingAppointment->address);
                                        if(json_last_error() == JSON_ERROR_NONE){
                                            $address = $ad->address .', '. @$ad->address_detail->city. ', '. @$ad->address_detail->country;   
                                        }
                                         
                                    }
                                    ?>
                                    
                                    @if(isset($address))
                                    <span>{{$address}}</span>
                                    @endif

                                </div>
                            </div>
                        @else
                            <h4 class="card-title">Upcoming lesson not found!</h4>
                            <hr>
                        @endif
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-b-0">
                        <h4 class="card-title">Upcoming Lesson</h4>

                        <div class="d-flex align-items-center flex-row m-t-30">
                            <div class="w-100" >
                                @if(isset($appointments) && count($appointments) > 0 )
                                    @foreach($appointments as $appointment)
                                    
                                    <hr>
                                    <div class="row @if($appointment->time_slot == '') bg-danger text-white @endif" @if($appointment->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>
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
                                                    <h3 class="m-b-0">{{ ucwords($appointment->name .' '. $appointment->lname) }}</h3>
                                                    <span> <i class="fa fa-phone"></i> <a href="tel:{{$appointment->phone}}">{{$appointment->phone}}</a> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>
                                            <p>
                                            <strong>{{ $appointment->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$appointment->lesson_hour." hour" }}{{ $appointment->lesson_hour > 1 ? "s" : "" }}</strong> <br>
        
                                            <?php //echo $appointment->apptype; 
                                            if($appointment->apptype=="test")
                                            { 
                                                $start_date = $appointment->start_date;
                                                $pickup = strtotime($start_date)-3600;
                                                $pickuptime = date('h:i a', $pickup);
                                                $startT = date('h:i a', strtotime($appointment->start_date));
                                                echo date('D, d F, Y', strtotime($appointment->schedule_date))."<br/>";
                                                echo "Pickup time: ".$pickuptime."<br>Start time: ".$startT;
                                            }
                                            else{
                                                echo date('D, d F, Y', strtotime($appointment->schedule_date))." ".$appointment->time_slot;
                                            } ?>
                                            
        
                                            <br>
        
                                            </strong>
                                            
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
                                            
                                            @if(isset($address))
                                            <span>{{$address}}</span>
                                            @endif
        
                                        </div>
                                    </div>
                                    
                                    
                                     @endforeach
                                @else
                                    <tr>
                                        <h4 class="card-title">Record Not Found<</h4>
                                    </tr>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            

            
        </div>
        
        <div class="row">
                <div class="col-md-12">
                    
                    
                    
                    <div class="card">
                        <div class="card-body p-b-0">
                            <h4 class="card-title">Booking History</h4>
    
                            <div class="d-flex align-items-center flex-row m-t-30">
                                <div class="w-100" >
                                    @if($BookingHistory->isNotEmpty())
                                        @foreach($BookingHistory as $appointment)
                                        
                                        <hr>
                                        <div class="row @if($appointment->time_slot == '') bg-danger text-white @endif" @if($appointment->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>
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
                                                        <h3 class="m-b-0">{{ ucwords($appointment->name .' '. $appointment->lname) }}</h3>
                                                        <span> <i class="fa fa-phone"></i> <a href="tel:{{$appointment->phone}}">{{$appointment->phone}}</a> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <strong>
                                                <p>
                                                <strong>{{ $appointment->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$appointment->lesson_hour." hour" }}{{ $appointment->lesson_hour > 1 ? "s" : "" }}</strong> <br>
            
                                                <?php //echo $appointment->apptype; 
                                                if($appointment->apptype=="test")
                                                { 
                                                    $start_date = $appointment->start_date;
                                                    $pickup = strtotime($start_date)-3600;
                                                    $pickuptime = date('h:i a', $pickup);
                                                    $startT = date('h:i a', strtotime($appointment->start_date));
                                                    echo date('D, d F, Y', strtotime($appointment->schedule_date))."<br/>";
                                                    echo "Pickup time: ".$pickuptime."<br>Start time: ".$startT;
                                                }
                                                else{
                                                    echo date('D, d F, Y', strtotime($appointment->schedule_date))." ".$appointment->time_slot;
                                                } ?>
                                                
            
                                                <br>
            
                                                </strong>
                                                
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
                                                
                                                @if(isset($address))
                                                <span>{{$address}}</span>
                                                @endif
            
                                            </div>
                                        </div>
                                        
                                        
                                         @endforeach
                                    @else
                                        <tr>
                                            <h4 class="card-title">Record Not Found<</h4>
                                        </tr>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                </div>
            </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AppointmentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width: 80%; max-width: none!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lesson Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <div id="appointments_detail">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review Instructor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" id="review_form">
                        <input type="hidden" name="score" id="user_score">
                        <input type="hidden" name="id" id="rate_id">
                        <input type="hidden" name="user_id" id="inst_id">
                        <div class="form-group">
                            <label for="">Review</label>
                            <textarea required class="form-control" name="review"  rows="4" placeholder="Say something about instructor services"></textarea>
                        </div>
                        <div class="form-group">
                            <div data-toggle="tooltip" id="readOnly" data-score="5" class="" ></div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="submit" form="review_form" class="btn btn-success">save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/dashboards/dashboard3.js')}}"></script>

    <script src="{{asset('assets/extra-libs/raty-fa/jquery.raty-fa.js')}}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script>

        
        $(document).on('click', '.book-inst',  function(e) {
            e.preventDefault();
            var inst = $(this).attr('data-instructor');
            var learnerID = "<?php echo $learner_id; ?>";

            $.post('{{url('create-search-from-learner')}}',
                { learner_id: learnerID, '_token': '{{ @csrf_token() }}' },
                function (data) {
                    window.location.href = "{{url('/')}}/book-online/"+data.search_id+"/instructor/"+inst;
                });
        });



        var hint = '{{@$rating->total}} votes, average {{ floor(@$rating->avg) }} out of 5';
        (function ($) {
            $(function () {

                $('.click').raty({
                    readOnly: function(){
                        return $(this).attr('data-read');
                    },
                    score: function () {
                        return $(this).attr('data-score');
                    },
                    half: true,
                    hints: [hint, hint, hint, hint, hint]
                });
            });
        })(jQuery);

        $(document).ready(function (){
            $('#review_form').submit(function (){

                if( $('#user_score').val() == '' ){
                    swal('Warning', 'Rating is required', 'warning');
                    return false;
                }

                let data = new FormData(this);

                $.ajax({
                    url: "{{ route('give_review') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if (res.success == true) {
                            swal('Success', res.message, 'success');
                        }else{
                            swal('Opps', res.message, 'error');
                        }
                    }
                });
                return false;
            });
        });


        var hint1 = 'give 1 star to instructor';
        var hint2 = 'give 2 star to instructor';
        var hint3 = 'give 3 star to instructor';
        var hint4 = 'give 4 star to instructor';
        var hint5 = 'give 5 star to instructor';

        function reviewPop(id){
            $('#inst_id').val(id);
            $.post('{{route('get_review')}}',
                {id: id},
                function (res) {
                    if(res.success == false){

                        $('#readOnly').raty({
                            readOnly: function(){
                                return $(this).attr('data-read');
                            },
                            score: function () {
                                return $(this).attr('data-score');
                            },
                            click: function (score, evt)
                            {
                                $('#user_score').val(score);
                            },
                            half: false,
                            hints: [hint1, hint2, hint3, hint4, hint5]
                        });

                    }else{

                        if(res.review.review!='' && res.review.review!=null ) {
                            $('textarea[name="review"]').val(res.review.review).prop('disabled', true);
                        }
                        $('#user_score').val(res.score);
                        $('#rate_id').val(res.id);


                        $('#readOnly').raty({
                            readOnly: true,
                            score: res.review.score,
                        });
                    }
                });

            $('#reviewModal').modal('show')
        }

        function AppointmentDetailModal(e){
            $("#loading").show();
            var AppointmentID = $(e).attr('data-appointment-id');
            var UserType = $(e).attr('data-user-type');
            $.post('{{route('get-appointment-detail')}}',
                {AppointmentID: AppointmentID, UserType: UserType},
                function (res) {
                    var PaymentStatus = '';
                    var LearnerAvatar = '';
                    if(res.success == true){
                        $('#appointments_detail').html(res.data);
                        $("#loading").hide();
                        $('#AppointmentDetailModal').modal('show');
                    }
                });
        }


    </script>
@endsection
