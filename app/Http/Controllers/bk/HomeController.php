<?php

namespace App\Http\Controllers;

use App\AppointmentCompleted;
use App\Appointments;
use App\PaymentResponse;
use App\User;
use App\UserRatings;
use App\Wallet;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->type == 'admin'){
            $total_users = User::where('type', '!=', 'admin')->count('id');
            $total_inst = User::where('type', 'inst')->count('id');
            $total_learners = User::where('type', 'learner')->count('id');
            $total_appt = Appointments::count();
            $TotalEarning = PaymentResponse::sum('converted_amount') - Withdraw::sum('withdraw_amount');
            $InstructorWithDraw = Withdraw::sum('withdraw_amount');
            $InstructorGraph = $this->InstructorStats();
            $LearnerGraph = $this->LearnerStats();
            return view('admin.home', compact('total_appt','total_users', 'total_inst', 'total_learners', 'TotalEarning', 'InstructorWithDraw', 'InstructorGraph', 'LearnerGraph'));
        }elseif ($user->type == 'inst'){
            $appointments = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type')
                ->where([['appointments.schedule_date', '>=', Carbon::now()]])
                ->orderBy('appointments.id', 'desc')
                ->get();
            $UpcomingAppointment = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type')
                ->where([['appointments.status', '=', 'confirmed'], ['appointments.schedule_date', '>=', Carbon::now()]])
                ->orderBy('appointments.id', 'desc')
                ->first();
            $TotalAmount = Wallet::where('user_id', $user->id)->first()->withdrawable;
            $GetCompletedAmount = AppointmentCompleted::where('instructor_id', $user->id)->sum('amount');
            $GetWithDrawAmount = Withdraw::where('instructor_id', $user->id)->sum('withdraw_amount');
            $GetCompletedAppointmentsAmount = $GetCompletedAmount - $GetWithDrawAmount;
            return view('instructor.home', compact('appointments', 'UpcomingAppointment', 'TotalAmount', 'GetCompletedAppointmentsAmount'));
        }elseif ($user->type == 'learner'){

            $appointments = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.instructor_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type')
                ->where([['appointments.user_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])
                ->orderBy('appointments.id', 'desc')
                ->get();

            $UpcomingAppointment = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.instructor_id')
                ->select('appointments.*', 'users.name', 'users.lname', 'users.email', 'users.phone', 'users.avatar', 'users.type')
                ->where([['appointments.user_id', '=', $user->id],['appointments.schedule_date', '>=', Carbon::now()]])
                ->orderBy('appointments.id', 'desc')
                ->first();

            $instructors = DB::table('appointments')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->select('users.name', 'users.lname', 'users.id', 'appointments.instructor_id')
                ->where('users.id', Auth::user()->id)
                ->groupBy('users.id')
                ->get();

            return view('learner.home', compact('instructors','appointments', 'UpcomingAppointment'));
        }
    }

    public function instructorRequest()
    {
        return view('instructor.registered');
    }

    function InstructorStats()
    {
        $year = date('Y');
        // $data = 26;
        $data=array();
        for($i=1; $i<13; $i++){

            $stats = DB::table('users');
            $stats = $stats->select
            (DB::raw('count(id) as `total`'),
                DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
                DB::raw('YEAR(created_at) year, MONTH(created_at) month'));
            $stats = $stats->whereYear('created_at', $year);
            $stats = $stats->whereMonth('created_at', $i);
            $stats = $stats->where('type', 'inst');
            $stats = $stats->groupby('year', 'month');
            $stats = $stats->get();
            if(count($stats)>0){
                $data[] = (int)$stats[0]->total;
            }else{
                $data[] = 0;
            }
        }

        return $data;
    }

    function LearnerStats()
    {
        $year = date('Y');
        // $data = 26;
        $data=array();
        for($i=1; $i<13; $i++){

            $stats = DB::table('users');
            $stats = $stats->select
            (DB::raw('count(id) as `total`'),
                DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),
                DB::raw('YEAR(created_at) year, MONTH(created_at) month'));
            $stats = $stats->whereYear('created_at', $year);
            $stats = $stats->whereMonth('created_at', $i);
            $stats = $stats->where('type', 'learner');
            $stats = $stats->groupby('year', 'month');
            $stats = $stats->get();
            if(count($stats)>0){
                $data[] = (int)$stats[0]->total;
            }else{
                $data[] = 0;
            }
        }

        return $data;
    }

    function get_review_pages(Request $request){
        if($request->ajax())
        {
            $rating = UserRatings::join('users', 'users.id', 'user_rating.by_user')
                ->select('user_rating.score', 'user_rating.review', 'users.name', 'users.lname')
                ->where('user_rating.user_id', $request->intructor)
                ->paginate(2);
            return view('search.review_pagination', compact('rating'))->render();
        }else{

        }
    }

}
