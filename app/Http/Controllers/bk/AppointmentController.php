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
        return view('instructor.appointment');
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
        $appointments = DB::table('appointments')
        ->join('users', 'users.id', '=', 'appointments.user_id')
        ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
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
            ->editColumn('payment_status', function ($appointments) {
                $PaymentStatus = $appointments->payment_status;
                if($PaymentStatus == 1){
                    $Status = 'Paid';
                }else{
                    $Status = 'UnPaid';
                }
                return $Status;
            })
            ->editColumn('status', function ($appointments) {
                $CurrentData = date('Y-m-d h:i a');
                $CheckDateTime = $appointments->schedule_date. ' ' .$appointments->time_slot;
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
                $chk = ($appointments->status=='confirmed') ? "checked":"";
                $CurrentData = date('Y-m-d h:i a');
                $CheckDateTime = $appointments->schedule_date. ' ' .$appointments->time_slot;
                if(strtotime($CurrentData) > strtotime($CheckDateTime)){
                    $b = '';
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
            $AppointmentDetail = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.instructor_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
                ->where('appointments.id', '=', $AppointmentID)
                ->first();
        }else{
            $AppointmentDetail = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
                ->where('appointments.id', '=', $AppointmentID)
                ->first();
        }
        if($AppointmentDetail){
            return response()->json(['success' => true, 'message' => $AppointmentDetail]);
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
