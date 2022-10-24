<?php

namespace App\Http\Controllers;

use App\AppointmentCompleted;
use App\Appointments;
use App\ConnectedAccounts;
use App\Wallet;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_type = auth()->user()->type;
        if($user_type == 'inst'){
            $column = 'instructor_id';
        }elseif ($user_type == 'learner'){
            $column = 'user_id';
        }
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'appointments.type as apptype')
        ->where('appointments.'.$column, auth()->user()->id)
        ->orderBy('id', 'desc')
        ->get();
        
        return view('instructor.appointment', ['appointments' => $appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_appointments()
    {
        $user_type = auth()->user()->type;
        if($user_type == 'inst'){
            $column = 'instructor_id';
        }elseif ($user_type == 'learner'){
            $column = 'user_id';
        }


        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'appointments.type as apptype')
        ->where('appointments.'.$column, auth()->user()->id)
        ->get();

        return Datatables::of($appointments)
            ->addColumn('avatar', function ($appointments) {
                if( $appointments->avatar == ''){
                    $Avatar = '<img src="' . url('assets/images/users/default.png') . '" height="60px" width="60px" />';
                }else{
                    $Avatar = '<img src="' . url('assets/images/users/'.$appointments->avatar) . '" height="60px" width="60px" />';
                }
                return $Avatar;
            })
            ->editColumn('name', function ($appointments) {
                $FullName = ' '.$appointments->name.' '.$appointments->lname;
                return $FullName;
            })
            ->editColumn('fees', function ($appointments) {
                $fees = $appointments->lesson_hour*$appointments->hourly_rate;
                return $fees;
            })
            ->editColumn('payment_status', function ($appointments) {
                $PaymentStatus = $appointments->payment_status;
                if($PaymentStatus == 1){
                    $Status = 'Paid';
                }else{
                    $Status = 'UnPaid';
                }
                return $Status;
            })
            ->editColumn('address', function ($lessons) {
                $address = '';
                $ad = json_decode($lessons->address);

               if(is_object($ad)){
                   $address = $ad->address .', '. @$ad->address_detail->city. ', '. @$ad->address_detail->country;
               }
                return $address;
            })
            ->editColumn('status', function ($appointments) {
                $CurrentData = date('Y-m-d h:i a');
                
                $timeSlot = $appointments->time_slot;
                $timeSlotArr = explode('-', $timeSlot);
                $time_slot_start = $timeSlotArr[0];

                $CheckDateTime = $appointments->schedule_date. ' ' .$time_slot_start;
                if($appointments->status != 'completed'){
                    if(!empty($appointments->time_slot)){
                        if(strtotime($CurrentData) > strtotime($CheckDateTime)){
                            $AppointmentStatus = 'Expired';
                        }else{
                            $AppointmentStatus = $appointments->status;
                        }
                    }else{
                        $AppointmentStatus = 'Time Not Defined';
                    }
                }else{
                    $AppointmentStatus = $appointments->status;
                }
                return $AppointmentStatus;
            })
            ->addColumn('action', function ($appointments) {
                $b = '';
                if(!empty($appointments->time_slot)){
                    $chk = ($appointments->status=='confirmed') ? "checked":"";
                    $CurrentData = date('Y-m-d h:i a');

                    $timeSlot = $appointments->time_slot;
                    $timeSlotArr = explode('-', $timeSlot);
                    $time_slot_start = $timeSlotArr[0];
                    
                    $CheckDateTime = $appointments->schedule_date. ' ' .$time_slot_start;
                    if(strtotime($CurrentData) > strtotime($CheckDateTime)){

                    }else{
                        if($appointments->status == 'completed'){
                            $b = '<a data-toggle="tooltip" data-title="Appointment Completed" href="javascript:;" class="btn btn-xs m-b-5 btn-info"><i class="fa fa-check"></i> </a> ';
                        }else{
                            $b = '<a><div class="btn custom-switch">
                              <input type="checkbox" class="custom-control-input myswitch" id="appointmentSwitches'.$appointments->id.'" '.$chk.' value="'.$appointments->id.'">
                                <label class="custom-control-label" for="appointmentSwitches'.$appointments->id.'"></label>
                                </div></a>';
                        }
                    }
                }
                //$b .= '<a onclick="AppointmentDetailModal(this)" data-appointment-id="'.$appointments->id.'" data-user-type="'.$appointments->type.'" data-toggle="tooltip" data-title="Appointment details" href="javascript:;" class="btn btn-xs m-b-5 btn-primary">Details</a>';

                return $b;
            })
            ->rawColumns([
                'avatar',
                'action',
            ])
            ->make(true);
    }

    public function update_appointment_status(Request $request){
        if($request->status == 1){
            $Status = 'confirmed';
        }else{
            $Status = 'unconfirmed';
        }
        $update = Appointments::whereId($request->id)->update(['status' => $Status]);

        if($update) {
            return response()->json(['success' => true, 'message' => 'Appointment Status Update Successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    public function get_appointment_details(Request $request){
        $AppointmentID = $request->AppointmentID;
        $UserType = $request->UserType;
        if($UserType == 'inst'){
            $appointment_detail = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
                ->where('appointments.id', '=', $AppointmentID)
                ->first();
        }else{
            $appointment_detail = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.instructor_id')
                ->select('appointments.*', 'appointments.type as apptype', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
                ->where('appointments.id', '=', $AppointmentID)
                ->first();
        }
        if($appointment_detail){
            $data= view('learner.appt_detail', compact('appointment_detail'))->render();
            return response()->json(['success' => true, 'data' => $data]);

        }else{
            return response()->json(['success' => false, 'message' => 'Record Not Found']);
        }
    }

    public function get_appointment_details_inst(Request $request){
        $AppointmentID = $request->AppointmentID;
        $UserType = $request->UserType;
        $appointment_detail = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
                ->where('appointments.id', '=', $AppointmentID)
                ->first();

        $appointment_detail->schedule_date = date('D, d F, Y', strtotime($appointment_detail->schedule_date));

        if($appointment_detail->type == "test")
        {
            $start_date = $appointment_detail->start_date;
            $pickup = strtotime($start_date)-3600;

            $appointment_detail->pickup = date('h:i a', $pickup);
            $appointment_detail->startT = date('h:i a', strtotime($appointment_detail->start_date));
        }
        
        if($appointment_detail){
            return response()->json(['success' => true, 'message' => $appointment_detail]);

        }else{
            return response()->json(['success' => false, 'message' => 'Record Not Found']);
        }
    }

    public function withdraw_amount(Request $request){
        $InstructorID = $request->instructor_id;
        $RequestAmount = $request->amount;
        $GetDrawableAmount = AppointmentCompleted::where('instructor_id', $InstructorID)->first();
        if($RequestAmount >= $GetDrawableAmount->amount)
        {
            return response()->json(['success' => false, 'message' => 'Sorry!! You have insuficient balance !!']);
        }
        try{
            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
            }

            $GetAccessToken = ConnectedAccounts::where(['user_id' => $InstructorID])->first();

            $stripe_key = env('STRIPE_SECRET_KEY');
            \Stripe\Stripe::setApiKey($stripe_key); // this is Secret key

            $retrive = \Stripe\Balance::retrieve();
            $get_balance = $retrive['available'];
            foreach($get_balance as $get_balances)
            {
                $current_balance = $get_balances['amount'];
            }
            $cent_value = (double)$current_balance / 100;
            if($cent_value > $RequestAmount)
            {
                $transfer = \Stripe\Transfer::create([
                    'amount' => $RequestAmount * 100,
                    'currency' => 'usd',
                    'destination' => $GetAccessToken->stripe_user_id,
                ]);

                $converted = $transfer['amount'] / 100;
                $save_tranfer = new Withdraw();
                $save_tranfer->instructor_id = $InstructorID;
                $save_tranfer->transaction_id = $transfer['id'];
                $save_tranfer->object = $transfer['object'];
                $save_tranfer->amount = $transfer['amount'];
                $save_tranfer->converted_amount = $converted;
                $save_tranfer->withdraw_amount = $RequestAmount;
                $save_tranfer->amount_reversed = $transfer['amount_reversed'];
                $save_tranfer->balance_transaction = $transfer['balance_transaction'];
                $save_tranfer->created = $transfer['created'];
                $save_tranfer->currency = $transfer['currency'];
                $save_tranfer->description = $transfer['description'];
                $save_tranfer->destination = $transfer['destination'];
                $save_tranfer->destination_payment = $transfer['destination_payment'];
                $save_tranfer->livemode = $transfer['livemode'];
                $save_tranfer->reversed = $transfer['reversed'];
                $save_tranfer->source_transaction = $transfer['source_transaction'];
                $save_tranfer->source_type = $transfer['source_type'];
                $save_tranfer->transfer_group = $transfer['transfer_group'];
                $save_tranfer->json = json_encode($transfer);
                $save_tranfer->save();

                // Update Instructor Wallet
                $GetInstructorBalance = Wallet::where('user_id', $InstructorID)->value('withdrawable');
                $UpdateInstructorBalance = $GetInstructorBalance - $RequestAmount;
                if($UpdateInstructorBalance)
                {
                    Wallet::updateOrCreate(
                        ['user_id' =>  $InstructorID],
                        [
                            'user_id' => $InstructorID,
                            'withdrawable' =>  $UpdateInstructorBalance,
                        ]);
                }
//                $total_withdrawn_amount = Withdraw::where(['user_id' => $request->user_id])->sum('withdraw_amount');
//                $total_remaining_amount = Wallet::where(['user_id' => $request->user_id])->first()->withdrawable;
                return response()->json(['success' => true, 'message' => 'Payment Transfer Successfully !!!'], 200);
            }
            else
            {
                return response()->json(['success' => false, 'message' => 'Sorry!! Admin have insufficient funds in account !!']);
            }
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
