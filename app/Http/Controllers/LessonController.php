<?php

namespace App\Http\Controllers;

use App\AppointmentCompleted;
use App\Appointments;
use App\PaymentResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('learner.lesson');
    }
    
    public function purchases(){
        return view('learner.purchases');
    }

    public function faq()
    {
        return view('learner.faqs');
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
        //
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

    public function get_lessons()
    {
        $lessons = DB::table('appointments')
            ->join('users', 'users.id', '=', 'appointments.instructor_id')
            ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar')
            ->where(['appointments.user_id' => Auth::id()])
            ->get();

        return Datatables::of($lessons)
            ->addColumn('avatar', function ($lessons) {
                $FullName = ' '.$lessons->name.' '.$lessons->lname;
                if( $lessons->avatar == ''){
                    $Avatar = '<img src="' . url('assets/images/users/default.png') . '" class="rounded-circle" width="31" /> <strong> '.$FullName.' </strong>';
                }else{
                    $Avatar = '<img src="' . url('assets/images/users/'.$lessons->avatar) . '" class="rounded-circle" width="31" /> <strong> '.$FullName.' </strong>';
                }
                return $Avatar;
            })
            ->editColumn('address', function ($lessons) {
                $address = '';
                $ad = json_decode($lessons->address);

               if(is_object($ad)){
                   $address = $ad->address .', '. @$ad->address_detail->city. ', '. @$ad->address_detail->country;
               }
                return $address;
            })
            ->editColumn('status', function ($lessons) {
                $CurrentData = date('Y-m-d h:i a');
                
                $timeSlot = $lessons->time_slot;
                $timeSlotArr = explode('-', $timeSlot);
                $time_slot_start = $timeSlotArr[0];

                $CheckDateTime = $lessons->schedule_date. ' ' .$time_slot_start;
                if($lessons->status != 'completed'){
                    if(!empty($lessons->time_slot)){
                        if(strtotime($CurrentData) > strtotime($CheckDateTime)){
                            $AppointmentStatus = 'Expired';
                        }else{
                            $AppointmentStatus = $lessons->status;
                        }
                    }else{
                        $AppointmentStatus = 'Time Not Defined';
                    }
                }else{
                    $AppointmentStatus = $lessons->status;
                }
                return $AppointmentStatus;
            })
            ->addColumn('action', function ($lessons) {
                $b = '';
                if(empty($lessons->time_slot) || empty($lessons->schedule_date)){
                    $b = '<a data-toggle="tooltip" data-title="Missing lesson time please add" href="javascript:;" onclick="ShowTimeSlots(this)" data-id="'.$lessons->id.'" data-search-id="'.$lessons->search_id.'" data-instructor-id="'.$lessons->instructor_id.'" data-start-date="'.$lessons->schedule_date.'" class="btn btn-xs m-b-5 btn-warning"><i class="fa fa-calendar"></i></a> ';
                }else {
                    if($lessons->status == 'confirmed'){
                        $b .= '<a data-toggle="tooltip" data-title="Mark lesson Completed" href="javascript:;" onclick="AppointmentComplete(this)" data-appointment-id="'.$lessons->id.'" data-instructor-id="'.$lessons->instructor_id.'" class="btn btn-xs m-b-5 btn-info"><i class="fa fa-check"></i> </a> ';
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

    public function update_book_time(Request $request){
        $UpdateBookTime = Appointments::where(['user_id' => \auth()->user()->id, 'id' => $request->id])
            ->update([
                'schedule_date' =>  $request->schedule_date,
                'time_slot' =>  $request->time_slot
            ]);
        if($UpdateBookTime){
            return response()->json(['success' => true, 'message' => 'Booking Time Update Successfully!']);
        }else{
            return response()->json(['success' => false, 'message' => 'Booking Time Not Update!']);
        }
    }

    public function change_appointment_status(Request $request){
        $InstructorID = $request->InstructorID;
        $AppointmentID = $request->AppointmentID;
        Appointments::where('id', $AppointmentID)->update(['status' =>  'completed']);
        $GetAppointmentAmount = PaymentResponse::where('appointment_id', $AppointmentID)->value('converted_amount');
        $AppointmentCompleted = AppointmentCompleted::create([
            'instructor_id' => $InstructorID,
            'appointment_id' => $AppointmentID,
            'amount' => $GetAppointmentAmount,
        ]);
        if($AppointmentCompleted){
            return response()->json(['success' => true, 'message' => 'Lesson Update Successfully!']);
        }else{
            return response()->json(['success' => false, 'message' => 'Record Not Found']);
        }
    }
}
