<?php

namespace App\Http\Controllers;

use App\Appointments;
use App\CarMake;
use App\CarModel;
use App\DrivingLicence;
use App\YearModel;
use App\EmailSettings;
use App\InstructerVehicle;
use App\InstructorDocs;
use App\InstructorLicence;
use App\Notification;
use App\Settings;
use App\TestLocations;
use App\Traits\AppTraits;
use App\UserMeta;
use App\UserRatings;
use App\UserTestLocations;
use App\WorkingTime;
use App\Region;
use App\ServiceRegions;
use App\TimeSlots;
use App\User;
use App\WwccLicence;
use Carbon\Carbon;
use DateTime;
use Image;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class InstructorController extends Controller
{
    function profile_vehicle(){
        $user = User::find(\auth()->user()->id);
        // echo "<pre>";print_r($user);die();
        $car_make = CarMake::where('status', 1)->get();
        
        $car_models_auto = "";
        $car_years_auto = "";

        $car_models_manual = "";
        $car_years_manual = "";

        if(isset($user->user_vehicle_auto->vehicle_make)){ $car_models_auto = CarModel::where('make_id', $user->user_vehicle_auto->vehicle_make)->get(); }

        if(isset($user->user_vehicle_auto->vehicle_model)){ $car_years_auto = YearModel::where('model_id', $user->user_vehicle_auto->vehicle_model)->orderBy('title', 'asc')->get(); }

        if(isset($user->user_vehicle_manual->vehicle_make)){ $car_models_manual = CarModel::where('make_id', $user->user_vehicle_manual->vehicle_make)->get(); }

        if(isset($user->user_vehicle_manual->vehicle_model)){ $car_years_manual = YearModel::where('model_id', $user->user_vehicle_manual->vehicle_model)->orderBy('title', 'asc')->get(); }

        $vehicle_notifications = Notification::where('user_id',$user->id)->where('notify_type','vehicle')->latest()->get();
        //if(isset($user->user_meta->vehicle_image)){ $car_image = YearModel::where('id', $user->user_meta->vehicle_image)->first(); }

        //return view('instructor.profile_vehicle', compact('user', 'car_make', 'car_models', 'car_years', 'car_image'));
        return view('instructor.profile_vehicle', compact('user', 'car_make', 'car_models_auto', 'car_years_auto','car_models_manual','car_years_manual','vehicle_notifications'));
    }

    function save_instructor_vehicle(Request $request){
        // echo "<pre>";print_r($request->all());die();
        // $validator = Validator::make($request->all(), ['vehicle_image' => 'mimes:jpeg,bmp,png,webp']);
        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'message' => $validator->errors()->all()]);
        // }

        $is_file = false;
        $obj = new User();
        $obj = $obj->findOrFail( auth()->user()->id );
        
        $user_meta = UserMeta::where('user_id', auth()->user()->id)->first();
        $user_info = User::where('id', $user_meta->user_id)->first();


        $instructer_vehicles = InstructerVehicle::where('user_id',$user_meta->user_id)->orderBy('id','desc')->first();

        if($instructer_vehicles){
            $notificationCheck = Notification::where('notify_request_id',$instructer_vehicles->id)->where('notify_status','Requested')->first();
            if(!$notificationCheck){
                $insert_vehicle = true;
            }else{
                $insert_vehicle = false;
            }
        }else{
            $insert_vehicle = true;
        }


        if($insert_vehicle == true){
            $user_name = $user_info->name;
            $user_lname = $user_info->lname;
            $meta_user_id = $user_meta->user_id;
            if($request->transmission_vehicle_auto == 'Auto'){
                
                if(optional($user_info->user_vehicle_auto)->vehicle_make!=$request->vehicle_make_vehicle_auto || optional($user_info->user_vehicle_auto)->vehicle_model!=$request->vehicle_model_vehicle_auto || optional($user_info->user_vehicle_auto)->vehicle_year!=$request->vehicle_year_vehicle_auto || optional($user_info->user_vehicle_auto)->dual_controls!=$request->dual_controls_vehicle_auto || optional($user_info->user_vehicle_auto)->registration_number!=$request->registration_number_vehicle_auto || optional($user_info->user_vehicle_auto)->ancap_rating!=$request->ancap_rating_vehicle_auto){
                    $vehicle_auto = [
                        'user_id' => $user_meta->user_id,
                        'vehicle_type' => $request->transmission_vehicle_auto,
                        'dual_controls' => $request->dual_controls_vehicle_auto,
                        'vehicle_year' => $request->vehicle_year_vehicle_auto,
                        'vehicle_model' => $request->vehicle_model_vehicle_auto,
                        'vehicle_make' => $request->vehicle_make_vehicle_auto,
                        'registration_number' => $request->registration_number_vehicle_auto,
                        'ancap_rating' => $request->ancap_rating_vehicle_auto
                    ];
                    $transmission_vehicle_auto = InstructerVehicle::create($vehicle_auto);
                    // notify
                    $notify_type = 'vehicle';
                    $this->admin_notify($transmission_vehicle_auto->id,$user_meta->user_id,$notify_type);
                    $this->adminMailSend($user_name,$user_lname,$meta_user_id);
    
                }
            }
    
            if($request->transmission_vehicle_manual == 'Manual'){
                if(optional($user_info->user_vehicle_manual)->vehicle_make!=$request->vehicle_make_vehicle_manual || optional($user_info->user_vehicle_manual)->vehicle_model!=$request->vehicle_model_vehicle_manual || optional($user_info->user_vehicle_manual)->vehicle_year!=$request->vehicle_year_vehicle_manual || optional($user_info->user_vehicle_manual)->dual_controls!=$request->dual_controls_vehicle_manual || optional($user_info->user_vehicle_manual)->registration_number!=$request->registration_number_vehicle_manual || optional($user_info->user_vehicle_manual)->ancap_rating!=$request->ancap_rating_vehicle_manual){
                    $vehicle_manual = [
                        'user_id' => $user_meta->user_id,
                        'vehicle_type' => $request->transmission_vehicle_manual,
                        'dual_controls' => $request->dual_controls_vehicle_manual,
                        'vehicle_year' => $request->vehicle_year_vehicle_manual,
                        'vehicle_model' => $request->vehicle_model_vehicle_manual,
                        'vehicle_make' => $request->vehicle_make_vehicle_manual,
                        'registration_number' => $request->registration_number_vehicle_manual,
                        'ancap_rating' => $request->ancap_rating_vehicle_manual
                    ];
                    $transmission_vehicle_manual = InstructerVehicle::create($vehicle_manual);
                    $notify_type = 'vehicle';
                    $this->admin_notify($transmission_vehicle_manual->id,$user_meta->user_id,$notify_type);
                    $this->adminMailSend($user_name,$user_lname,$meta_user_id);
                }
            }
        }
        
        // if($user_meta){
        //     $file_name = $user_meta->vehicle_image;
        // }

        /*vehicle image*/
        // if ($request->hasFile('vehicle_img')) {
        //     $is_file = true;

        //     $file = $request->file('vehicle_img');
        //     //$file = $file[0];
        //     $file_info 	= uniqid().'_'.time().'.'. $file->getClientOriginalExtension() ;
        //     $folderPath = base_path() . '/assets/images/vehicle_images/';
        //     Image::make( $file )->resize(null, 250, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })
        //         ->save($folderPath . $file_info )
        //         ->destroy();
        //    $file_name = $file_info;
        // }

        // if($request->vehicle_img && $request->vehicle_img!=""){
        // $file_name = $request->vehicle_img; }

        //$request->request->add(['vehicle_image' => $file_name]); //add request

        // if($user_meta->vehicle_make!=$request->vehicle_make || $user_meta->vehicle_model!=$request->vehicle_model || $user_meta->vehicle_year!=$request->vehicle_year)
        // {
        //     UserMeta::whereUser_id($user_meta->user_id)->update(['vehicle_status' => '0']);

            
        // }


        $ex = [
            'transmission_type',
            'bio',
            'years_for_instructing',
            'keys2drive',
            'language',
            'association_member',
            'services_accreditation',
            'association_name',
        ];

        if($user_meta){
            $user_meta->update($request->only($ex));
        }else{
            $user_meta = new UserMeta();
            $user_meta->fill($request->only($ex));
            $user_meta->language=json_encode($request->language);
            $user_meta->services_accreditation=json_encode($request->services_accreditation);
            
            //$user_meta->vehicle_image = $file_name;
            $user_meta->user_id = auth()->user()->id;
            $user_meta->save();
        }

        $obj->fill($request->only([ 'bio']));

        if($obj->save()){
            
            /*
            if ($is_file) {
                if (file_exists(base_path('assets/images/vehicle_images/' . $old_file)) && $old_file != null) {
                    unlink(base_path('assets/images/vehicle_images/' . $old_file));
                }
            } */

            return response()->json(['success' => true, 'message' => 'Waiting for approval for changing instructor car.']);
        }else{
            return response()->json(['success' => false, 'message' => 'something went wrong.']);
        }
    }

    private function adminMailSend($user_name,$user_lname,$meta_user_id){
        //===== send notification to admin
        $settings = Settings::find(1);
        $admin = User::where('type', 'admin')->first();
        $admin_email = $admin->email;
        //$admin_email = 'prasun@scwebtech.com';
        $subject = 'Vehicle information changed';
        
        $email_body = '
        <div style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;background-color:#edf2f7;margin:0;padding:0;width:100%">
                <tbody>
                    <tr>
                        <td align="center" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol">
                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;margin:0;padding:0;width:100%">
                                <tbody>
                                    <tr>
                                        <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;padding:25px 0;text-align:center">
                                            <a href="https://scwebtech4u.com/Projects/firstpass/" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;color:#3d4852;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://scwebtech4u.com/Projects/firstpass/&amp;source=gmail&amp;ust=1646476443884000&amp;usg=AOvVaw09SV8mY0vS8uI9l1TeTdqT">FirstPass</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;background-color:#edf2f7;border-bottom:1px solid #edf2f7;border-top:1px solid #edf2f7;margin:0;padding:0;width:100%">
                                            <table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
                                                <tbody>
                                                    <tr>
                                                        <td  style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                                            <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Hello Admin!</h1>
                                                            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">'.$user_name.' '.$user_lname.' has been changed his/her vehicle information. Please check and take necessary action.</p>
                                                            <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left"><a href="'.url("/instructor-details/{$meta_user_id}").'">Click here to go</a></p>
                                                            <table  align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                            <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol">
                                            <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;margin:0 auto;padding:0;text-align:center;width:570px">
                                                <tbody>
                                                    <tr>
                                                        <td align="center" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;max-width:100vw;padding:32px">
                                                                <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center">© '.date("Y").' FirstPass. All rights reserved.</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        ';
        if ($settings->email_type == 'api') {
            if ($settings->email_api == 'send_grid') {
                // sending email to super admin
                AppTraits::SendgridEmail($email_body, $admin_email, $subject, 'FirstPass', $user_name, $settings->sg_email, $settings->sg_apikey);
            }
        } else {
            AppTraits::SmtpEmail($email_body, $admin_email, $subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
        }
    }

    function get_vehicle_model(Request $request){
        if($request->make_id!=''){
            $make = CarModel::where('make_id', $request->make_id)->get();

            $options = '';
            //$image = '';
            //$image_id = '';
            $options_year = '';

            foreach ($make as $key => $mk){
                $options.="<option value='".$mk->id."'>".$mk->title."</option>";
                
                if($key=='0')
                {
                    $first_model = $mk->id;
                }
            }

            $year_first_model = YearModel::where('model_id', $first_model)->get();
            if(!empty($year_first_model))
            {
                foreach ($year_first_model as $key2 => $yr){
                    $options_year.="<option value='".$yr->title."'>".$yr->title."</option>";

                    // if($key2=='0')
                    // {
                    //     $image = $yr->image;
                    //     $image_id = $yr->id;
                    // }
                }
            }

            //return response()->json(['success' => true, 'options' => $options, 'image' => $image, 'image_id' => $image_id, 'options_year' => $options_year ]);
            return response()->json(['success' => true, 'options' => $options, 'options_year' => $options_year ]);
        }
    }

    private function admin_notify($request_id,$user_id,$notify_type){
        $current_date = date('Y-m-d H:i:s');
        $notification = [
            'user_id' => $user_id,
            'notify_type' => $notify_type,
            'notify_request_id' => $request_id,
            'notify_request_date' => $current_date,
            'notify_view' => 0,
            'notify_status' => 'Requested'
        ];
        $notificationCreate = Notification::create($notification);
        return $notificationCreate;
    }


    function get_vehicle_year(Request $request){
        if($request->model_id!=''){

            //$image = '';
            //$image_id = '';
            $options_year = '';

            $all_years = YearModel::where('model_id', $request->model_id)->orderBy('title', 'asc')->get();
            if(!empty($all_years))
            {
                foreach ($all_years as $key2 => $yr){
                    $options_year.="<option value='".$yr->title."'>".$yr->title."</option>";

                    // if($key2=='0')
                    // {
                    //     $image = $yr->image;
                    //     $image_id = $yr->id;
                    // }
                }
            }

            //return response()->json(['success' => true, 'image' => $image, 'image_id' => $image_id, 'options_year' => $options_year ]);
            return response()->json(['success' => true, 'options_year' => $options_year ]);
        }
    }


    // function get_vehicle_model_img(Request $request){
    //     if($request->model_id!='' && $request->year!=''){
    //         $yearRow = YearModel::where('model_id', $request->model_id)->where('title', $request->year)->get();
    //         $image = $yearRow[0]->image;
    //         $image_id = $yearRow[0]->id;
    //         return response()->json(['success' => true, 'image' => $image, 'image_id' => $image_id ]);
    //     }
    // }



    function services_availability(){
        $user     = auth()->user();
        $timeslot = TimeSlots::all();
        $regions  = Region::select('id', 'title', 'code')->get();
        $user_region_ids = ServiceRegions::where('user_id', $user->id)
            ->pluck('region_id')
            ->toArray();
        $user_location_ids = UserTestLocations::join('test_locations','test_locations.id', 'user_test_locations.location_id')
            ->where('user_test_locations.user_id', $user->id)
            ->get();

        $user_regions = ServiceRegions::where('user_id', $user->id)->get();

        $working_time = WorkingTime::where('user_id', $user->id)
            ->get();

        return view('instructor.services_and_availability', compact('user_location_ids','timeslot', 'regions', 'user_regions', 'user_region_ids', 'working_time'));
    }

    function instructor_map_suburb(Request $request){
        $region = Region::whereId($request->id)->select('data')->first();
        if($region){
            return response()->json( $region );
        }
    }

    function save_service_regions(Request $request)
    {
        try {
            $user = \auth()->user();
            /*remove region logic*/
            $removed_regions = [];
            if($request->removed_options!='') {
                $removed_regions = explode(',', $request->removed_options);
            }
            /*remove region logic*/
            $removed_locations = [];
            if($request->removed_locations!='') {
                $removed_locations = explode(',', $request->removed_locations);
            }

            if( count($removed_regions)>0 ) {
                $to_remove = $request->user_regions;
                $remove_this_region = array_diff($removed_regions, $to_remove);
                ServiceRegions::whereIn('id', $remove_this_region)->where('user_id', $user->id)->delete();
            }

            if( count($removed_locations)>0 ) {
                $to_remove = $request->test_location_ids;
                $remove_this_loca = array_diff($removed_locations, $to_remove);
                UserTestLocations::whereIn('id', $remove_this_loca)->where('user_id', $user->id)->delete();
            }

            if ($request->user_regions) {
                foreach ($request->user_regions as $i => $id) {

                    ServiceRegions::updateOrCreate([
                        'user_id' => $user->id,
                        'region_id' => $id
                    ], [
                        'region_id' => $id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            if ($request->test_location_ids) {
                foreach ($request->test_location_ids as $i => $id) {

                    UserTestLocations::updateOrCreate([
                        'user_id' => $user->id,
                        'location_id' => $id
                    ], [
                        'location_id' => $id,
                        'user_id' => $user->id,
                    ]);
                }
            }

            //echo '<hr>';
            $is_enabled = $request->is_enabled;
            $start_interval = $request->start_interval;
            $end_interval = $request->end_interval;

            $start_minutes = $request->start_minutes;
            $end_minutes = $request->end_minutes;

            foreach ($start_interval as $day => $v) {

                $data=[];
                foreach ($start_interval[$day] as $i => $time) {

                    $start_hour = $start_interval[$day][$i];
                    $start_min = $start_minutes[$day][$i];

                    $end_hour = $end_interval[$day][$i];
                    $end_min = $end_minutes[$day][$i];

                    $data[] = [
                        'start_hour' => $start_hour,
                        'start_min' => $start_min,
                        'end_hour' => $end_hour,
                        'end_min' => $end_min,
                    ];
                }

                if($is_enabled[$day] == 'yes') {
                    $errors = false;
                    for ($i = 0; $i < count($data); $i++) {
                        for ($j = $i + 1; $j < count($data); $j++) {

                            $start_time_j = $data[$j]['start_hour'] . ':' . $data[$j]['start_min'];
                            $start_time_i = $data[$i]['start_hour'] . ':' . $data[$i]['start_min'];

                            $end_time_j = $data[$j]['end_hour'] . ':' . $data[$j]['end_min'];
                            $end_time_i = $data[$i]['end_hour'] . ':' . $data[$i]['end_min'];

                            if (($start_time_j >= $start_time_i && ($start_time_j <= $end_time_i) ||
                                ($end_time_j >= $start_time_i && ($end_time_j <= $end_time_i)))) {
                                $errors .= "<li> timeslot ".($i+1)." and ".($j+1)." overlap.</li>";
                            }
                        }
                    }

                    if ($errors) {
                        return response()->json(['success' => false, 'day' => $day, 'errors' => $errors]);

                    }
                }

                $avil = WorkingTime::where( 'day', $day)
                    ->where('user_id', $user->id)
                    ->first();

                if($avil){
                    $avil->update(
                        [
                            "user_id" => $user->id,
                            // "start_time" => $start_interval[$day][0].":".$start_minutes[$day][0],
                            // "end_time" => $end_interval[$day][0].":".$end_minutes[$day][0],
                            "day" => $day,
                            "is_enabled" => $is_enabled[$day],
                            "data" => json_encode($data),
                        ]
                    );
                }else{

                    WorkingTime::create(
                        [
                            "user_id" => $user->id,
                            // "start_time" => $start_interval[$day][0].":".$start_minutes[$day][0],
                            // "end_time" => $end_interval[$day][0].":".$end_minutes[$day][0],
                            "day" => $day,
                            "is_enabled" => $is_enabled[$day],
                            "data" => json_encode($data),
                        ]
                    );
                }
            }

            User::find($user->id)->update(
                [
                    'calendar_default_view' => $request->calendar_default_view,
                    'lesson_travel_time' => $request->lesson_travel_time
                ]);

            return response()->json(['success' => true, 'message' => 'Services updated successfully']);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'errors' => false, 'message' => 'Something went wrong ' . $e->getMessage() . $e->getLine()]);
        }
    }

    function my_documents(Request $request){
        $user_id = auth()->user()->id;
        // $docs = InstructorDocs::where('user_id', $user->id)->first();
        $docs = UserMeta::with('driving_licence','instructor_licence','wwcc_licence')->where('user_id',$user_id)->select('driving_licence_id','instructor_licence_id','wwcc_licence_id')->first();
        $driving_licences = DrivingLicence::where('user_id',$user_id)->latest()->take(5)->get();

        $instructor_licences = InstructorLicence::where('user_id',$user_id)->latest()->take(5)->get();
        $wwcc_licences = WwccLicence::where('user_id',$user_id)->latest()->take(5)->get();

        return view('instructor.my_documents', compact('docs','driving_licences','instructor_licences','wwcc_licences') );
    }

    function save_my_documents(Request $request){
        $user = auth()->user();
        $user_id = auth()->user()->id;

        $maxFileSize = 1000000;
        $file_type=['jpeg','png','jpg','svg'];

        // $obj = InstructorDocs::where('user_id', $user_id)->first();

        if($request->type == 'driving_licence'){
            if($request->has('driving_licence_front')){
                // image front
                if ($request->hasFile('driving_licence_front')) {
                    $extension = $request->driving_licence_front->getClientOriginalExtension();

                    if( !in_array($extension, $file_type) ){
                        return response()->json(['success' => false, 'message' => 'The licence front image must be a file of type: jpeg, png, jpg, svg']);
                    }
                    $fileSize = $request->file('driving_licence_front')->getSize();

                    if ($fileSize >= $maxFileSize) {
                        return response()->json(['success' => false, 'message' => 'The licence front size must be less than 1MB']);
                    }

                    $driving_licence_front = time() .uniqid() . '.' . $extension;
                    $request->driving_licence_front->move(base_path() . '/assets/images/documents/', $driving_licence_front);
                }

                if ($request->hasFile('driving_licence_back')) {
                    $extension = $request->driving_licence_back->getClientOriginalExtension();

                    if( !in_array($extension, $file_type) ){
                        return response()->json(['success' => false, 'message' => 'The licence back image must be a file of type: jpeg, png, jpg, svg']);
                    }
                    $fileSize = $request->file('driving_licence_back')->getSize();

                    if ($fileSize >= $maxFileSize) {
                        return response()->json(['success' => false, 'message' => 'The licence back image size must be less than 1MB']);
                    }

                    $driving_licence_back = uniqid(). time() . '.' . $extension;
                    $request->driving_licence_back->move(base_path() . '/assets/images/documents/', $driving_licence_back);
                }

                $data = [
                    'user_id' => $user_id,
                    'driving_licence_front' => $driving_licence_front,
                    'driving_licence_back'  => $driving_licence_back,
                    'expiration_date'    => $request->expiration_date,
                    'driving_licence_status'  => 'Requested'
                ];

                $driving_licence = DrivingLicence::create($data);
                $notify_type = 'driving_licence';
                $this->admin_notify($driving_licence->id,$user_id,$notify_type);

            }
        }elseif($request->type == 'driving_instructor'){

            if($request->has('instructor_licence_image')){
                // image front
                if ($request->hasFile('instructor_licence_image')) {
                    $extension = $request->instructor_licence_image->getClientOriginalExtension();

                    if( !in_array($extension, $file_type) ){
                        return response()->json(['success' => false, 'message' => 'The licence front image must be a file of type: jpeg, png, jpg, svg']);
                    }
                    $fileSize = $request->file('instructor_licence_image')->getSize();

                    if ($fileSize >= $maxFileSize) {
                        return response()->json(['success' => false, 'message' => 'The licence front size must be less than 1MB']);
                    }

                    $instructor_licence_image = uniqid().time() . '.' . $extension;
                    $request->instructor_licence_image->move(base_path() . '/assets/images/documents/', $instructor_licence_image);
                }

                $data = [
                    'instructor_licence_image'  => $instructor_licence_image,
                    'expiration_date'    => $request->expiration_date,
                    'user_id'  => $user_id,
                    'instructor_licence_status'   => 'Requested',
                ];
                $instructor_licence = InstructorLicence::create($data);
                $notify_type = 'instructor_licence';
                $this->admin_notify($instructor_licence->id,$user_id,$notify_type);

            }
        }elseif($request->type == 'wwcc'){

            $data = [
                'user_id'    => $user_id,
                'name'    => $request->name,
                'wwcc_number'  => $request->wwcc_number,
                'dob'    => $request->dob,
                'expiration_date'  => $request->expiration_date,
                'wwcc_licence_status'  => 'Requested'
            ];
            $wwcc_licence = WwccLicence::create($data);
            $notify_type = 'wwcc_licence';
            $this->admin_notify($wwcc_licence->id,$user_id,$notify_type);
        }

        $settings = Settings::find(1);
        //if($settings) {
            $admin = User::where('type', 'admin')->first();
            /*email to admin about document*/
            $admin_email = $admin->email;
            //$admin_email = 'prasun@scwebtech.com';
            $subject = 'Document submitted';
            
            $email_body = '
            <div style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;background-color:#edf2f7;margin:0;padding:0;width:100%">
                    <tbody>
                        <tr>
                            <td align="center" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol">
                                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;margin:0;padding:0;width:100%">
                                    <tbody>
                                        <tr>
                                            <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;padding:25px 0;text-align:center">
                                                <a href="https://scwebtech4u.com/Projects/firstpass/" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;color:#3d4852;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://scwebtech4u.com/Projects/firstpass/&amp;source=gmail&amp;ust=1646476443884000&amp;usg=AOvVaw09SV8mY0vS8uI9l1TeTdqT">FirstPass</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" cellpadding="0" cellspacing="0" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;background-color:#edf2f7;border-bottom:1px solid #edf2f7;border-top:1px solid #edf2f7;margin:0;padding:0;width:100%">
                                                <table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
                                                    <tbody>
                                                        <tr>
                                                            <td  style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                                                <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Hello!</h1>
                                                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">New Document submitted by '.ucfirst($user->name).', please check.</p>
                                                                <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">Instructor email is '.$user->email.'</p>
                                                                <table  align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                                <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol">
                                                <table align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;margin:0 auto;padding:0;text-align:center;width:570px">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;max-width:100vw;padding:32px">
                                                                    <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center">© '.date("Y").' FirstPass. All rights reserved.</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            ';


            if ($settings->email_type == 'api') {
                if ($settings->email_api == 'send_grid') {
                    // sending email to super admin
                    AppTraits::SendgridEmail($email_body, $admin_email, $subject, 'FirstPass', $user->name, $settings->sg_email, $settings->sg_apikey);
                }
            } else {
                AppTraits::SmtpEmail($email_body, $admin_email, $subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
            }
        //}


        return response()->json(['success' => true, 'message' => 'Documents saved successfully and send for approval']);
    }

    function get_instructor_calendar(Request $request){
        $user_working_time = WorkingTime::select('is_enabled', 'day')->where('user_id', $request->id)->get();
        return response()->json( [ 'working_time' => $user_working_time  ] );
    }

    function get_review(Request $request){

        $review = UserRatings::where('by_user', auth()->user()->id)
            ->where('user_id', $request->id)
            ->select('score', 'review', 'id')
            ->first();

        if($review){
            return response()->json( [ 'success' => true, 'review' => $review ] );
        }else{
            return response()->json( [ 'success' => false] );
        }
    }

    function save_review(Request $request){

        $review = UserRatings::where('by_user', auth()->user()->id)->first();

        $obj = new UserRatings();
        if($review) {
            $obj = $obj->findOrFail($review->id);
        }

        $obj->fill($request->all());
        $obj->by_user = auth()->user()->id;

        if( $obj->save() ){
            return response()->json( [ 'success' => true, 'message' => "Your review saved successfully." ] );
        }else{
            return response()->json( [ 'success' => false, 'message' => "something went wrong!"] );
        }
    }

    function view_calendar(){
        //$web_events = "";
        $web_events = Appointments::where('instructor_id', Auth::id())
            ->where('time_slot', '!=', '')
            ->where('schedule_date', '!=', '')
            //->whereIN('status', ['confirmed', 'completed'])
            ->where('is_private', 0)
            ->where('instructor_id', Auth::id())
            ->get();

        $private_events = Appointments::where('instructor_id', Auth::id())
            ->where('is_private', 1)
            ->where('instructor_id', Auth::id())
            ->get();

            $avl = [];
            $get_timess = WorkingTime::where(['user_id' => Auth::id(), 'is_enabled' => 'yes'])->get();

            foreach($get_timess as $get_times)
            {
                if($get_times->day=='sunday'){ $num = 0; }
                elseif($get_times->day=='monday'){ $num = 1; }
                elseif($get_times->day=='tuesday'){ $num = 2; }
                elseif($get_times->day=='wednesday'){ $num = 3; }
                elseif($get_times->day=='thursday'){ $num = 4; }
                elseif($get_times->day=='friday'){ $num = 5; }
                elseif($get_times->day=='saturday'){ $num = 6; }

                $av_time = json_decode($get_times->data);
                foreach ($av_time as $v) {
                        $start_time = $v->start_hour . ':' . $v->start_min;
                        $end_time = $v->end_hour . ':' . $v->end_min;
                    }
                
                $avl[] = [
                            'dow' => [$num],
                            'start' => $start_time,
                            'end' => $end_time,
                        ];
            }

            // echo "<pre>";
            // print_r($avl); die;

        return view('instructor.calendar', compact('web_events', 'private_events','avl'));
    }

    function addEvent(Request $request){
        $start = date('d-m-Y H:i', strtotime($request->start." ". $request->start_time));
        $end = date('d-m-Y H:i', strtotime($request->end." ". $request->end_time));

        $schedule_date = date('Y-m-d', strtotime($request->start." ". $request->start_time));
        $schedule_start = date('h:i a', strtotime($request->start." ". $request->start_time));
        $schedule_end = date('h:i a', strtotime($request->start." ". $request->end_time));
        $slot = $schedule_start .'-'. $schedule_end;

        $obj = new Appointments();

        if ($request->id != "") {
            $obj = $obj->findOrFail($request->id);
        }

        $obj->fill($request->all());

        if (isset($request->start)) {
            $obj->start_date = $start;
        }
        if (isset($request->end)) {
            $obj->end_date = $end;
        }

        if (!isset($request->address)) {
            $obj->address = " ";
        }if (!isset($request->note)) {
            $obj->note = " ";
        }if (!isset($request->detail)) {
            $obj->detail = " ";
        }

        $obj->is_private = 1;
        $obj->schedule_date = $schedule_date;
        $obj->time_slot = $slot;
        $obj->user_id = Auth::id();
        $obj->type = "lesson";
        $obj->lesson_hour = 2;
        $obj->instructor_id = Auth::id();

        if ($obj->save()) {
            echo 1;
        } else {
            echo 2;
        }
    }

    function showEvent(Request $request)
    {
        if(is_numeric($request->id))
        {
            $data = Appointments::select('id', 'user_id', 'type', 'start_date', 'end_date', 'detail', 'address', 'note', 'is_private')->whereId($request->id)
                ->where('instructor_id', Auth::user()->id)
                ->first();

            $start_date = $data->start_date;
            $pickup = strtotime($start_date)-3600;
            $data['pickuptime'] = date('H:i', $pickup);

            $user = DB::table('users')
                ->where('id', '=', $data->user_id)
                ->first();

            $data['user'] = $user;

            if($data)
            {
                $return = $data;
            }else{
                $return = ['error'=> 1];
            }
            return response()->json($return);
        }
    }

    function deleteEvent(Request $request){
        $delete=false;
        if($request->id!='') {
           $delete = Appointments::where('instructor_id', Auth::id())
               ->where('id', $request->id)
               ->where('is_private', 1)
               ->delete();
        }

        if($delete){
            return response()->json( [ 'success' => true, 'message' => "Appointment deleted successfully." ] );
        }else{
            return response()->json( [ 'success' => false, 'message' => "Event not deleted." ] );
        }
    }

    public function notifications()
    {
        return view('instructor.notification.index');
    }

    public function getNotifications()
    {
        $notifications = Notification::where('user_id',Auth::id())->where('requested_user_view',0)->latest();

        return Datatables::of($notifications)

            ->addColumn('notify_type', function ($notifications) {
                $notify_type = Str::title($notifications->notify_type);

                return $notify_type;
            })
            ->addColumn('action', function ($notifications) {
                $b = '<button class="btn btn-xs m-b-5 btn-primary notify_view_status" data-id="'.$notifications->id.'" data-user_id="'.$notifications->user_id.'"><i class="fa fa-eye"></i> View</button> ';

                return $b;
            })
            ->make(true);
    }

    public function viewNotification($notificationId)
    {
        $notification = Notification::where('id',$notificationId)->where('requested_user_view',0)->first();

        if($notification){
            $notification->requested_user_view = 1;
            $notification->save();
            $notify_type = $notification->notify_type;
            return response()->json(['success' => true, 'message' => 'Notification view successfully','notify_type'=>$notify_type]);
        }else{
            return response()->json(['success' => false, 'message' => 'Notification already view.']);
        }
        
    }

}
