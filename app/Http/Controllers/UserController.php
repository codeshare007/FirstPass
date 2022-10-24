<?php

namespace App\Http\Controllers;

use App\CarMake;
use App\DrivingLicence;
use App\InstructerVehicle;
use App\YearModel;
use App\InstructorDocs;
use App\InstructorLicence;
use App\Notification;
use App\Region;
use Illuminate\Http\Request;
use App\User;
use App\UserMeta;
use App\WwccLicence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function view_users(Request $request)
    {
        return view('admin.view_users');
    }

    function profile(){
        $user = User::whereId(Auth::user()->id)->first();
        return view('users.users_profile', compact('user' ));
    }

    function saveProfile(Request $request){
        try {
            $obj = new User();

            if ($request->id != '') {
                $obj = $obj->findOrFail($request->id);
            }
            $obj->fill($request->all());

            // image
            /*
            if ($request->hasFile('profile')) {
                $file_name = time() . '.' . $request->profile->getClientOriginalExtension();
                $request->profile->move(base_path() . '/assets/images/users/', $file_name);
                $obj->avatar = $file_name;
            }
            */

            if ($request->is_password_reset == 1) {

                if ($request->old_password == '' || $request->new_password == '') {
                    return response()->json(['success' => false, 'message' => 'Password fields required']);
                }

                $is_uesr = User::where(['id' => $request->id])->first();

                if ($is_uesr && Hash::check($request->old_password, $is_uesr->password)) {
                    /*compare password*/
                    if ($request->new_password == $request->confirm_password) {
                        $obj->password = Hash::make($request->new_password);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Please confirm password']);
                    }

                } else {
                    return response()->json(['success' => false, 'message' => 'Invalid password']);
                }
            }

            if ($obj->save()) {
                return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
            }
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function get_users()
    {
        $users = User::where('type', '!=', 'admin');

        return Datatables::of($users)
            ->editColumn('created_at', function ($users) {
                $date = $users->created_at->format('Y-m-d h:i:s a');
                return $date;
            })
            ->editColumn('type', function ($users) {
                if($users->type == 'inst'){
                    return '<a href="'.url('instructor-details/'.$users->id).'" class="btn btn-link"> Instructor</a> ';
                }else{
                    return $users->type;
                }
            })
            ->addColumn('action', function ($users) {
                $chk = ($users->status=='1') ? "checked":"";
                $b = '<a onclick="get_user('.$users->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-primary"><i class="fa fa-edit"></i> Edit</a> ';
                if(auth()->user()->type == 'admin'){
                    $b.= '<a onclick="del_user('.$users->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-danger danger-alert"><i class="fa fa-trash"></i> Delete</a> ';
                }
                $b.= '<a onclick="login_client('.$users->id.')" href="javascript:;" class="btn btn-xs m-b-5 btn-info info-alert"><i class="ti-power-off"></i> Login</a> ';

                $b.= '<a><div class="btn custom-switch">
                  <input type="checkbox" class="custom-control-input myswitch" data-obj="users" id="customSwitches'.$users->id.'" '.$chk.' value="'.$users->id.'">
                    <label class="custom-control-label" for="customSwitches'.$users->id.'"></label>
                    </div></a>';

                return $b;
            })
            ->rawColumns(['action', 'type'])
            ->make(true);
    }

    public function edit($id)
    {
        $user =  User::find($id);
        return $user;
    }

    public function delete_user(Request $request)
    {
        try{
            $user =  User::find($request->id)->delete();
            if($user)
            {
                return response()->json(['success' => true, 'message' => 'User Deleted Successfully ']);
            }else{
                return response()->json(['success' => false, 'message' => 'An Error Occurred, User Not Deleted']);
            }
        }
        catch (\Exception $e ) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
        }
    }

    function userLogin(Request $request)
    {
        if(auth()->user()->type=='admin') {
            $request->session()->put('master_control', 'admin');
        }elseif (auth()->user()->type=='support'){
            $request->session()->put('master_control', 'support');
        }
        if(Auth::loginUsingId($request->id,true)){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    public function back_to_admin(Request $request){
        $session = $request->session()->get('master_control');
        if($session=="admin" || $session=="support"){
            $user = User::where('type', $session)->first();
            $request->session()->forget('master_control');
            Auth::login($user);
            return redirect('home');
        }else{
            return redirect(request()->headers->get('referer'));
        }
    }

    public function store(Request $request)
    {

        try{
            $user =  User::find($request->id);
            if($user)
            {
                /*validate duplicate user*/
                if(User::where('email', $request->email)->where('id', '!=', $user->id)->exists()){
                    return response()->json(['success' => false, 'message' => 'A user already registered with '. $request->email]);
                }

                //$user->fill($request->all());

                $user->name = $request->name;
                $user->lname = $request->lname;
                $user->email = $request->email;
                $user->type = $request->type;
                $user->gender = $request->gender;


                if($request->password!=""){ $user->password = $request->password; }

                // image
                if ($request->hasFile('profile')) {
                    $file_name = time() . '.' . $request->profile->getClientOriginalExtension();
                    $request->profile->move(base_path() . '/assets/images/users/', $file_name);
                    $user->avatar = $file_name;
                }

                if ($user->save()) {
                    return response()->json(['success' => true, 'message' => 'User Updated Successfully ']);
                } else {
                    return response()->json(['success' => false, 'message' => 'An Error Occured, User Not Saved']);
                }

            }
            else
            {
                $user = new User();
                if(User::where('email', $request->email)->exists()){
                    return response()->json(['success' => false, 'message' => 'A user already registered with '. $request->email]);
                }

                $user->fill($request->all());

                // image
                if ($request->hasFile('profile')) {
                    $file_name = time() . '.' . $request->profile->getClientOriginalExtension();
                    $request->profile->move(base_path() . '/assets/images/users/', $file_name);
                    $user->avatar = $file_name;
                }

                if ($user->save()) {
                    return response()->json(['success' => true, 'message' => 'User Updated Successfully ']);
                } else {
                    return response()->json(['success' => false, 'message' => 'An Error Occured, User Not Saved']);
                }
            }

            return view('admin.view_users', ['user'=>$user]);
        }
        catch (\Exception $e ) {
            return response()->json(['success' => false, 'message' => $e->getMessage() . '  ' . $e->getLine() ], 200);
        }
    }
    function update_status(Request $request){
        $update = false;
        if($request->obj == 'users'){
            $update = User::whereId($request->id)->update(['status' => $request->status]);
        }
        if($request->obj == 'regions'){
            $update = Region::whereId($request->id)->update(['status' => $request->status]);
        }
        if($request->obj == 'cars'){
            $update = CarMake::whereId($request->id)->update(['status' => $request->status]);
        }

        if($update) {
            return response()->json(['success' => true, 'message' => 'Settings Successfully Saved']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }


    function update_vehicle_status(Request $request){

        $notify_exist = Notification::where('notify_request_id',$request->notify_vehicle_id)->first();

        if($notify_exist){
            $current_date = date('Y-m-d H:i:s');
            $notify_exist->notify_view = 1;
            $notify_exist->requested_user_view = 0;
            $notify_exist->notify_status = $request->notify_status;
            $notify_exist->notify_status_date = $current_date;
            $notify_exist->save();

            if($request->notify_status == 'Approved'){
                $instructer_vehicles = InstructerVehicle::where('id', $request->notify_vehicle_id)->first();
                
                if($instructer_vehicles) {
                    $instructer_vehicles->vehicle_status = 1;
                    $instructer_vehicles->vehicle_approved = 1;
                    $instructer_vehicles->save();
                    $user_meta = UserMeta::where('user_id',$instructer_vehicles->user_id)->first();
                    // echo "<pre>";print_r($user_meta);die();
                    if( $instructer_vehicles->vehicle_type == 'Manual'){
                        $user_meta->vehicle_manual_id = $instructer_vehicles->id;
                    }else{
                        $user_meta->vehicle_auto_id = $instructer_vehicles->id;
                    }
                    $user_meta->save();
                }
            }
            return response()->json(['success' => true, 'message' => 'Successfully Updated']);

        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong']);
        }
    }

    function instructor_details($id, $notify_type = null){
        $user = User::find($id);
        // $docs = InstructorDocs::where('user_id', $id)->first();

        $docs = UserMeta::with('driving_licence','instructor_licence','wwcc_licence')->where('user_id',$id)->select('driving_licence_id','instructor_licence_id','wwcc_licence_id')->first();

        $driving_licences = DrivingLicence::where('user_id',$id)->latest()->take(5)->get();

        $instructor_licences = InstructorLicence::where('user_id',$id)->latest()->take(5)->get();
        $wwcc_licences = WwccLicence::where('user_id',$id)->latest()->take(5)->get();

        $car_make = CarMake::where('status', 1)->get();
        $vehicle_notifications = Notification::where('user_id',$user->id)->where('notify_type','vehicle')->latest()->take(5)->get();
        // echo "<pre>";print_r($docs);die();

        //if(isset($user->user_meta->vehicle_image)){ $car_image = YearModel::where('id', $user->user_meta->vehicle_image)->first(); }

        //return view('users.instructor_details', compact('user', 'docs', 'car_make','id', 'car_image'));
        return view('users.instructor_details', compact('user', 'docs', 'car_make','id','notify_type','vehicle_notifications','driving_licences','instructor_licences','wwcc_licences'));

    }
    function save_image(Request $request,$id)
    {   
        $user = User::find($id);
        $docs = InstructorDocs::where('user_id', $id)->first();
        $car_make = CarMake::where('status', 1)->get();

        if ($request->hasFile('wwc_image')) {
            $file_name = time() . '.' . $request->wwc_image->getClientOriginalExtension();
            $request->wwc_image->move(base_path() . '/assets/images/documents/', $file_name);
            // $obj->avatar = $file_name;
            $query = DB::table('instructor_docs')
              ->where('user_id', $id)
              ->update(['wwcc_image' => $file_name]);
        }
        
        $obj = InstructorDocs::where('user_id', $id)->first();


        $data = [
            'dob_day_expire'    => $request->dob_day_expire,
            'dob_month_expire'    => $request->dob_month_expire,
            'dob_year_expire'    => $request->dob_year_expire,

            'dob_day'    => $request->dob_day,
            'dob_month'  => $request->dob_month,
            'dob_year'   => $request->dob_year,
            'full_name'  => $request->name,
            'wwcc'  => $request->wwcc
        ];
        InstructorDocs::where('user_id', $id)
            ->update( ["wwcc" => json_encode($data), 'wwcc_status' => 'pending' ] );
            
        return view('users.instructor_details', compact('user', 'docs', 'car_make','id'));

    }


    function update_profile_img(Request $request)
    {   
        if ($request->hasFile('profile_img')) {
            $file_name = time() . '.' . $request->profile_img->getClientOriginalExtension();
            $request->profile_img->move(base_path() . '/assets/images/users/', $file_name);
            
            $query = DB::table('users')
              ->where('id', $request->user_id)
              ->update(['avatar' => $file_name]);

            return response()->json(['success' => true, 'message' => 'Profile image updated successfully.']);
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
        
    }


    function update_vehicle_img(Request $request)
    {   
        // echo "<pre>";print_r($request->all());die();

        if ($request->hasFile('vehicle_img')) {
            $file_name = time() . '.' . $request->vehicle_img->getClientOriginalExtension();
            $request->vehicle_img->move(base_path() . '/assets/images/cars/', $file_name);
            
            // $object = YearModel::updateOrCreate(
            //     ['model_id' => $request->vehicle_model, 'title' => $request->vehicle_year],
            //     ['image' => $file_name]
            // );
            
            // $id = $object->id;

            $query = DB::table('instructer_vehicles')
                    ->where('id', $request->instructer_vehicles_id)
                    ->update(['vehicle_image' => $file_name]);

            return response()->json(['success' => true, 'message' => 'Vehicle image updated successfully.']);
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
        

    }

    function update_wwcc_img(Request $request)
    {   
       
        if(isset($request->wwcc_licence_id))
        {

            if ($request->hasFile('wwc_image') ) {
                $file_name = time() . '.' . $request->wwc_image->getClientOriginalExtension();
                $request->wwc_image->move(base_path() . '/assets/images/documents/', $file_name);
                
                $query = DB::table('wwcc_licences')
                    ->where('id', $request->wwcc_licence_id)
                    ->update(['wwcc_image' => $file_name]);              
    
                return response()->json(['success' => true, 'message' => 'WWCC image updated successfully.']);
            }
            else
            {
                return response()->json(['success' => true, 'message' => 'Image not updated.']);
            }       
            
        }        
        else
        {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
        

    }

}
