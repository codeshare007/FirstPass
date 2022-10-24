<table class="table table-bordered table-striped" width="100%">
    <thead>
    <tr>
        <th class="border-top-0">Instructor</th>
        <th class="border-top-0">Booking Type</th>
        <th class="border-top-0">Schedule Date</th>
        <th class="border-top-0">Address</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($appointment_detail))
            <tr class="@if(@$appointment_detail->time_slot == '') bg-danger text-white @endif" @if(@$appointment_detail->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                            @if( $appointment_detail->avatar == '')
                                <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle rounded-circle" width="60">
                            @else
                                <img src="{{ url('assets/images/users/'.$appointment_detail->avatar) }}" alt="user" class="img-circle rounded-circle" width="60">
                            @endif
                        </div>
                        <div class="">
                            <h4 class="m-b-0 font-16">{{$appointment_detail->name}} {{$appointment_detail->lname}}</h4>
                            <?php /*<span>{{$appointment_detail->email}}</span>*/ ?>
                            <span><a href="tel:{{$appointment_detail->phone}}">{{$appointment_detail->phone}}</a></span>
                        </div>
                    </div>
                </td>
                <td>{{ $appointment_detail->apptype == "test" ? "Auto Driving Test" : "Auto Lesson - ".$appointment_detail->lesson_hour." hour" }}{{ $appointment_detail->lesson_hour > 1 ? "s" : "" }}</td>
                <td><?php echo date('D, d F, Y', strtotime($appointment_detail->schedule_date)); ?><br>
                    
                    <?php if($appointment_detail->apptype=="test")
                    { 
                        $start_date = $appointment_detail->start_date;
                        $pickup = strtotime($start_date)-3600;
                        $pickuptime = date('h:i a', $pickup);
                        $startT = date('h:i a', strtotime($appointment_detail->start_date));

                        echo "Pickup time: ".$pickuptime."<br>Start time: ".$startT;
                    }
                    else{
                        echo $appointment_detail->time_slot;
                    } ?>

                </td>
                <td>
                    <?php
                    $valid =['city', 'state', 'country', 'postal_code', 'suburb', 'query'];
                    $address = json_decode($appointment_detail->address);

                    $address_r='<table>';
                    foreach ($address->address_detail as $i => $v){
                        if(in_array($i, $valid)){
                            $address_r.= ' <tr><th>'.$i . ':</th> <td>'. $v.'</td></tr>';
                        }
                    }
                    echo $address_r.='</table>';
                    ?>
                </td>

            </tr>

    @else
        <tr>
            <td class="text-center" colspan="4">Record Not Found</td>
        </tr>
    @endif
    </tbody>
</table>
