<?php
namespace App\Http\Controllers;
use App\Appointments;
use App\CarMake;
use App\CarModel;
use App\YearModel;
use App\ContactForm;
use App\EmailSettings;
use App\PaymentResponse;
use App\PostalCode;
use App\Region;
use App\RegionBK;
use App\Search;
use App\ServiceRegions;
use App\Settings;
use App\State;
use App\TestLocations;
use App\TestPackage;
use App\User;
use App\UserMeta;
use App\UserTestLocations;
use App\Wallet;
use App\WorkingTime;
use App\InstructorDocs;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\AppTraits;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use stdClass;

class GuestController extends Controller
{
    function get_model(Request $request){

        die();

        $reg_code = TestLocations::where('region', '!=', '')->groupBy('region')->pluck('region')->toArray();
        // Region::whereNotIn('id', $reg_code)->orderBy('id', 'desc')->random()->chunk(10, function ($region) {
        $region = Region::whereNotIn('id', $reg_code)->where('reg_id', '')->limit(30)->inRandomOrder()->get();
        foreach ($region as $item) {
            $id = str_replace( ' NSW', ',', $item->title );
            $id = urlencode($id);
            $url = "https://www.ezlicence.com.au/get_test_locations?region=$id&search_type=test_package&transmission=Auto";

            $res = Http::get($url);
            $res = $res->object();
            //echo '<pre>';
            if(isset($res->result)){
                //print_r($res->result);
                foreach ($res->result as $v){

                    TestLocations::updateOrCreate([
                        'region' => $item->id,
                        'title'  => $v[0],
                    ],[
                        'region' => $item->id,
                        'title'  => $v[0],
                        'code'  => $v[1]
                    ]);
                }
                $item->update([
                    'reg_id' => $id
                ]);
            }
        }
        //});
        exit;
        die();
        ini_set('max_execution_time', '0');
        Region::where('data', null)->orderBy('id', 'desc')->chunk(5, function ($region) {
            foreach ($region as $item) {
                $url = "https://www.ezlicence.com.au/map-suburb?polygon_id=$item->ez_id";
                $res = Http::get($url);
                $res = $res->body();
                Region::where('ez_id', $item->ez_id)->update(["data" => $res]);
            }
        });

        exit;
        ini_set('max_execution_time', '0');
        //get test locations
        $region = PostalCode::where('status', 0)->groupBy('postcode')->limit(10)->get();
            foreach ($region as $item) {
             echo   $url = "https://www.ezlicence.com.au/admin/suburb_mappings/get_suburb_polygon_options?search=$item->postcode&instructor_user_id=846";
                $res = Http::get($url);
                $res = $res->object();

                if(isset($res->result)){
                    foreach ($res->result as $v){

                        if(!Region::where('ez_id', $v->id)->exists()){
                            Region::create([
                                'title' => $v->text,
                                'ez_id' => $v->id,
                                'code' => $item->code
                            ]);
                        }
                    }
                }
                PostalCode::where('postcode', $item->postcode)->update(['status' => 1]);
            }
        exit;
        $reg_code = TestLocations::where('region', '!=', '')->groupBy('region')->pluck('region')->toArray();
       // Region::whereNotIn('id', $reg_code)->orderBy('id', 'desc')->random()->chunk(10, function ($region) {
        $region = Region::whereNotIn('id', $reg_code)->limit(100)->inRandomOrder()->get();
            foreach ($region as $item) {
                $id = urlencode($item->reg_id);
                $url = "https://www.ezlicence.com.au/get_test_locations?region=$id&search_type=test_package&transmission=Auto";
                $res = Http::get($url);
                $res = $res->object();
                //echo '<pre>';
                if(isset($res->result)){
                     //print_r($res->result);
                    foreach ($res->result as $v){

                        TestLocations::updateOrCreate([
                            'region' => $item->id,
                            'title'  => $v[0],
                        ],[
                            'region' => $item->id,
                            'title'  => $v[0],
                            'code'  => $v[1]
                        ]);
                    }
                }
            }
        //});
        exit;

        ini_set('max_execution_time', '0');
        echo '<pre>';

        $reg_code = Region::where('code', '!=', '')->groupBy('code')->pluck('code')->toArray();

        RegionBK::groupBy('code')->whereNotIn('code', $reg_code)->orderBy('id', 'desc')->chunk(10, function ($region) {
            foreach ($region as $item) {

                $url = "https://www.ezlicence.com.au/admin/suburb_mappings/get_suburb_polygon_options?search=$item->code&instructor_user_id=846";
                $res = Http::get($url);
                $res = $res->object();

                if(isset($res->result)){
                   // print_r($res->result);
                    foreach ($res->result as $v){
                        $regg = Region::where('ez_id', $v->id)->first();
                        if(!$regg){
                            Region::create([
                                'title' => $v->text,
                                'ez_id' => $v->id,
                                'code' => $item->code
                            ]);
                        }
                    }
                }
            }
        });

        exit;

        dd('functionality not defined');

        $context = stream_context_create(array(
            'http' => array('ignore_errors' => true),
        ));

        $region = Region::where('data', NULL)->get();

        foreach ($region as $item){

            $url = "https://www.ezlicence.com.au/map-suburb?polygon_id=$item->code";
            $data = file_get_contents($url, false, $context);
            Region::where('id', $item->id)->update(["data" => $data]);

        }

        exit;
        /*get region*/

        $datas = [ "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

         rsort($datas);

        foreach ($datas as $data){
            $query = "https://www.ezlicence.com.au/get_available_suburbs?search=$data";
            $res = file_get_contents($query);
            $res = json_decode($res);

            foreach ($res->result as $r){
                $id = explode(',', $r->id);

                if(isset($id[0]) && isset($id[1])){

                    if( !Region::where('code', $id[1])->exists() ){
                        Region::create(["title" => $r->text, "code" => $id[1]]);
                    }
                }
            }
        }




        exit;
        $makes = [
            "Abarth", "AC", "Alfa Romeo", "Allard", "Alpina", "Alpine", "Alpine-Renault", "Alvis", "AM General", "Ariel", "Armstrong Siddeley", "Asia Motors", "Aston Martin", "Auburn", "Audi", "Austin", "Austin Healey", "Bedford", "Bentley", "Berkeley", "Bertone", "BMW", "Bolwell", "Bond", "Bristol", "Bufori", "Buick", "Bullet", "Cadillac", "Caterham", "Chery", "Chevrolet", "Chrysler", "Citroen", "Clenet", "Commer", "CSV", "Custom", "Daewoo", "Daihatsu", "Daimler", "Datsun", "DeLorean", "DeSoto", "De Tomaso", "DKW", "Dodge", "Durant", "Elfin", "Eunos", "Ferrari", "Fiat", "Ford", "Ford Performance Vehicles", "Foton", "FSM", "Fulda", "Fuso", "Galloway", "Geely", "Genesis", "GMC", "Goggomobil", "Goliath", "Graham", "Graham-Paige", "Great Wall", "Haval", "HDT", "Higer", "Hillman", "Hino", "Holden", "Holden Special Vehicles", "Honda", "Hudson", "Humber", "Hummer", "Hupmobile", "Hyundai", "Infiniti", "INFINITI", "International", "ISO", "Isuzu", "Iveco", "JAC", "Jaguar", "JBA", "Jeep", "Jensen", "JMC", "Kia", "Koenigsegg", "KTM", "Lada", "Lamborghini", "Lancia", "Land Rover", "LDV", "Lexus", "Leyland", "Lincoln", "London Taxi Company", "Lotus", "Mack", "Mahindra", "Marathon", "Marcos", "Maserati", "Matra", "Maybach", "Mazda", "McLaren", "Mercedes-Benz", "Mercury", "MG", "MINI", "Mitsubishi", "Morgan", "Morris", "Moskvich", "Napier", "Nash", "Nissan", "NSU", "Oldsmobile", "Opel", "Packard", "Panther", "Peugeot", "Plymouth", "Pontiac",
            "Porsche", "Prince", "Proton", "Purvis", "RAM", "Rambler", "Reliant", "Renault", "REO", "Riley", "Robnell", "Rolls-Royce", "Rover", "Saab", "Seat", "Singer", "SKODA", "smart", "SS", "SsangYong", "Standard", "Steyr-Puch", "Studebaker", "Stutz", "Subaru", "Sunbeam", "Suzuki", "Talbot", "Tata", "TD 2000", "Tesla", "Toyota",
            "TRD", "Triumph", "TVR", "U.D.", "Ultima", "Vanden Plas", "Vauxhall", "Volkswagen", "Volvo",     "Westfield", "Willys", "Wolseley", "Yutong", "ZX Auto"
        ];

        try {
            foreach ($makes as $make) {
                $data = file_get_contents('https://www.ezlicence.com.au/instructor/car_model_query?car_make=' . urlencode($make));
                $result = json_decode($data);
                if (is_object($result)) {
                    $mk = new CarMake();
                    echo $mk->title = $make;
                    if ($mk->save()) {
                        echo $make_id = $mk->id;
                        foreach ($result->result as $res) {
                            $car_model = new CarModel();
                            $car_model->make_id = $make_id;
                            $car_model->title = $res;
                            $car_model->save();
                        }
                    }
                }
            }
        }catch (\Exception $e){
            echo $e->getMessage(). $e->getLine();
        }
    }

    function index($search_id=false){
        //IN CASE OF SEARCH
        $search = $region= false;
        if($search_id!=false){
            $search = Search::whereId($search_id)->first();
            if(!$search){
                $search_id = false;
            }else{
                $region = Region::whereId($search->region_id)->first();
            }
        }
        return view('welcome', compact('region','search_id', 'search'));
    }
    function get_test_location(Request $request)
    {
        $region_id=$request->id;
        $location_datas=TestLocations::all();

        $any_location = '';
        $is_result = false;
        if( count($location_datas)>0 ){
            $any_location = '<option value="any">Any Test Location</option>';
            $is_result = true;
        }

        $html="<div class='form-group'><select class='select2' name='test_location' id='test_location' required>$any_location";
        foreach ($location_datas as $location_data) {
            $html.="<option value='$location_data->id'>$location_data->title</option>";
        }
        $html.="</select></div>";
        if($is_result) {
            echo $html;
        }else{
            echo '<p style="margin-top: 5px">No Result Found</p>';
        }
        return "";

    }
    function contact(Request $request){
        return view('contact');
    }
    function test_package(Request $request){
        $TestPackageDetail  =   TestPackage::first();
        return view('test_package', compact('TestPackageDetail'));
    }

    function save_contact_form(Request $request){
        $f_name            =   $request->f_name;
        $l_phone           =   $request->l_phone;
        $email             =   $request->email;
        $mobile_number     =   $request->mobile_number;
        $postcode          =   $request->postcode;
        $subject           =   $request->subject;
        $message           =   $request->message;
        $user_type         =   $request->user_type;

        $ContactForm                    =   new ContactForm();
        $ContactForm->f_name            =   $f_name;
        $ContactForm->l_phone           =   $l_phone;
        $ContactForm->email             =   $email;
        $ContactForm->mobile_number     =   $mobile_number;
        $ContactForm->postcode          =   $postcode;
        $ContactForm->subject           =   $subject;
        $ContactForm->message           =   $message;
        $ContactForm->user_type         =   $user_type;
        if($ContactForm->save()){
            $mail   =   mail($email, $subject, $message);
            if($mail){
                return response()->json(['success' => true, 'message' => 'Mail sent successfully. Our team will contact you quickly as possible.']);
            }else{
                return response()->json(['success' => false, 'message' => 'Form Data saved successfully but mail mail not sent successfully.']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Something Went Wrong !!']);
        }
    }

    function autocomplete_regions_ajax(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =Region::select("id","title")
                ->where('title','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }

    function autocomplete_test_locations_ajax(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =TestLocations::select("id","title")
                ->where('title','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }

    function search(Request $request){

        if($request->search_type == 1){
            $ip = $request->getClientIp();
            $t_type = $request->type;
            $region = Region::select('title', 'id')->whereId($request->region)->first();
            if($region) {
                if($request->has('test_location') && $request->test_type == 2){
                    if($request->test_location == 'any') {
                        $available_users_r = UserTestLocations::pluck('user_id');
                    }else{
                        $available_users_r = UserTestLocations::where('location_id', $request->test_location)->pluck('user_id');
                    }
                }else{
                    $available_users_r = ServiceRegions::where('region_id', $request->region)->pluck('user_id');
                }

                if(count($available_users_r)>0) {
                    // $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')
                    //     ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar')
                    //     ->whereIn('users.id', $available_users_r)
                    //     ->where(['users.type' => 'inst', 'users.status' => 1])
                    //     ->whereIn("user_meta.transmission_type",['both', $t_type]);


                    $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')
                        ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar', 'users.preferred_name', 'users.phone', 'users.gender')
                        ->whereIn('users.id', $available_users_r)
                        ->whereIn("user_meta.transmission_type",['both',$t_type])
                        ->where(['users.type' => 'inst', 'users.status' => 1]);
                    //   echo "<pre>";print_r($users->get());die();

                    if($request->has('test_type')){
                        $users = $users->where('user_meta.services_accreditation', 'like', '%"'.$request->test_type.'"%');
                    }

                    $users = $users->get();
                    $total = $users->count();
                    /*save search*/
                    $search =  Search::create(
                        ['ip' => $ip, 't_type' => $t_type, 'region_id' => $request->region]
                    );
                    $search_id = $search->id;
                    $view = view('search.search', compact('users', 'search_id'))->render();
                    return response()->json(['success' => true, 'view' => $view, 'total' => $total, 'title' => $region->title, 'search_id' => $search_id, 't_type' => $t_type]);
                }else{
                    return response()->json(['success' => false, 'message' => 'Result not found!']);
                }
            }else{
                return response()->json(['success' => false, 'message' => 'Result not found!']);
            }
        }elseif ($request->search_type == 2){
            /*course selection*/
            /*save search*/
            $search_data = json_encode($request->lesson);
            $search =  Search::where('id', $request->search_id)->update(
                ['step_2' => $search_data, 'instructor_id' => $request->instructor_id]
            );
            if($search){
                return response()->json(['success' => true]);
            }
        }elseif ($request->search_type == 3){
            /*course selection*/
            /*save search*/
            $search_data =
                [
                    "total" => $request->total,
                    'discount' => $request->dis,
                    'hour' => $request->hr,
                    'hourly_rate' => $request->hourly_rate,
                    'test_price'  => $request->test_price
                ];

            $step2_data=[];
            if( $request->has('is_test') && $request->is_test =="yes" ){
                array_push($step2_data, "test");
            }
            if( $request->has('is_lesson') && $request->is_lesson =="yes" ){
                array_push($step2_data, "lesson");
            }
            $search =  Search::where('id', $request->search_id)->update(
                ['step_3' => $search_data, 'step_2' => $step2_data]
            );

            if($search){
                return response()->json(['success' => true]);
            }
        }elseif ($request->search_type == 4){
            /*save search*/
            $data = [
                'lesson_hour' => $request->final_hour,
                'lesson_schedule_date' => $request->final_date,
                'lesson_time_slot' => $request->final_time,
                'test_schedule_date' => $request->final_date_test,
                'test_time_slot' => $request->final_time_test,
                'test_location' => $request->test_location_id
            ];
            $search =  Search::where('id', $request->search_id)->update(
                ['step_4' => $data]
            );
            if($search){
                return response()->json(['success' => true]);
            }
        }
    }

    function instructor_profile($search_id, $instructor_id){

        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();
        if(!$instructor){
            return back()->with('error', 'Please make a new search');
        }
        $search = Search::find($search_id);
        if(!$search){
            return back()->with('error', 'Please make a new search');
        }
        if($this->check_search_status($search_id)){
            return redirect('/')->with('error', 'Please make a new search');
        }

        /*instructors*/
        $t_type = $search->t_type;
        $users=[];
        $available_users_r = ServiceRegions::where('region_id', $search->region_id)->pluck('user_id');
        if(count($available_users_r)>0) {
            $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')
                ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar')
                ->whereIn('users.id', $available_users_r)
                ->whereRaw(" users.status=1 and ( user_meta.transmission_type = 'both' OR user_meta.transmission_type = '$t_type' )")
                ->get();
        }

        $user_regions = ServiceRegions::where('user_id', $instructor_id)->get();

        //if(isset($instructor->user_meta->vehicle_image)){ $car_image = YearModel::where('id', $instructor->user_meta->vehicle_image)->first(); }

        // $instructor_detail = InstructorDocs::where('user_id', $instructor_id)->first();

        //return view('search.profile', compact( 'user_regions','instructor', 'search', 'users', 'search_id','t_type', 'car_image'));
        return view('search.profile', compact( 'user_regions','instructor', 'search', 'users', 'search_id','t_type'));
    }

    function book_online($search_id, $instructor_id){
        $user_id = auth()->user();

        // echo $user_id;die();
        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();
        if(!$instructor){
            return back()->with('error', 'Please make a new search');
        }
        $search = Search::find($search_id);
        if(!$search){
            return back()->with('error', 'Please make a new search');
        }
        if($this->check_search_status($search_id)){
            return redirect('/')->with('error', 'Please make a new search');
        }

        if(!empty($user_id))
        {
            $user_id = auth()->user()->id;
            $get_appointment_count=DB::table('appointments')->where('user_id','=',$user_id)->where('instructor_id','=',$instructor_id)->count();

            return view('search.book_online', compact('instructor', 'search', 'search_id','user_id','get_appointment_count'));
        }
        else
        {
            $get_appointment_count=0;
            return view('search.book_online', compact('instructor', 'search', 'search_id','user_id','get_appointment_count'));
        }

    }


    function book_online_cart($search_id, $instructor_id){
        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();
        if(!$instructor){
            return back()->with('error', 'Please make a new search');
        }
        $search = Search::find($search_id);
        if(!$search){
            return back()->with('error', 'Please make a new search');
        }
        if($this->check_search_status($search_id)){
            return redirect('/')->with('error', 'Please make a new search');
        }
        $test_package = TestPackage::where('status', 1)->first();
        $region = Region::find($search->region_id);
        return view('search.cart', compact('instructor', 'search', 'search_id', 'region', 'test_package'));
    }

    function book_online_book($search_id, $instructor_id){

        $user_id = "";
        $user = auth()->user();
        if($user){ $user_id = $user->id; }


        $instructor = User::whereId($instructor_id)->where('type', 'inst')->first();
        if(!$instructor){
            return back()->with('error', 'Please make a new search');
        }
        $search = Search::find($search_id);
        if(!$search){
            return back()->with('error', 'Please make a new search');
        }
        if($this->check_search_status($search_id)){
            return redirect('/')->with('error', 'Please make a new search');
        }
        $test_package = TestPackage::where('status', 1)->first();
        $region = Region::find($search->region_id);
        $user_working_time = WorkingTime::where('user_id', $instructor_id)->get();
        $test_locations = UserTestLocations::join('test_locations', 'test_locations.id', 'user_test_locations.location_id')
            ->select('test_locations.title', 'test_locations.id')
            ->where('user_test_locations.user_id', $instructor_id)
            ->get();
            // echo "<pre>";print_r($test_locations);die();
        return view('search.book', compact('test_locations','user_working_time','instructor', 'search', 'search_id', 'region', 'test_package', 'user_id'));
    }

    private function createTimeSlot($lesson_travel_time, $start_time, $end_time, $lesson_time, $boobkly_appts, $start_date)
    {
        // $period = new CarbonPeriod($start_time, $interval.' minutes', $end_time); // for create use 24 hours format later change format
        // $slots = [];
        // foreach($period as $item){

        //     $slots[]=[
        //         'start' => $item->format("h:i a"),
        //         'end' => $item->addMinutes($interval)->format('h:i a'),
        //         ];
        // }
        $slots = [];
        $slot_start_time = $start_time;
        do {
            $slot_end_time = strtotime('+' . $lesson_time . ' minutes', $slot_start_time);
            $occupied = 0;
            foreach($boobkly_appts as $appt)
            {
                $appts_array = explode('-', $appt->time_slot);
                $appt_start_time = $appts_array[0];
                $appt_end_time = $appts_array[1];

                $appt_start = strtotime($start_date.' '.$appt_start_time);
                $appt_end = strtotime($start_date.' '.$appt_end_time);
                // if($appts->type=="test")
                //     { $start = $start-3600; }

                if( ($slot_start_time >= $appt_start && $slot_start_time < $appt_end) || ($slot_end_time > $appt_start && $slot_end_time <= $appt_end) || ($slot_start_time < $appt_start && $slot_end_time > $appt_end) ) {
                    $occupied = $appt_end;
                }
            }
            if ($occupied) {
                $slot_start_time = strtotime('+' . $lesson_travel_time . ' minutes', $occupied);
                $slots[] = [
                    'start' => date('h:i a', strtotime('-' . $lesson_time . ' minutes', $occupied)),
                    'end' => date('h:i a', $occupied),
                    'occupied' => 1
                ];
            } else {
                $slots[] = [
                    'start' => date('h:i a', $slot_start_time),
                    'end' => date('h:i a', $slot_end_time),
                    'occupied' => 0
                ];
                $slot_start_time = strtotime('+' . $lesson_travel_time . ' minutes', $slot_start_time);
            }
        } while(strtotime('+' . $lesson_travel_time . ' minutes', $slot_start_time) < $end_time);

        return $slots;
    }

    function get_slots(Request $request){

        $instructor = User::where('id', $request->instructor_id)->first();
        if($instructor) {
            $start_date = $request->start_date;
            $day = Carbon::parse($start_date)->format('l');
            $get_times = WorkingTime::where(['user_id' => $request->instructor_id, 'is_enabled' => 'yes', 'day' => $day])->first();
            if ($get_times) {

                /*appointment settings*/
                $lesson_travel_time = $instructor->lesson_travel_time;
                $av_time = json_decode($get_times->data);

                /*get appointments of selected date*/
                $boobkly_appts = Appointments::where('instructor_id', $request->instructor_id)
                    ->where('status', '!=', 'cancelled')
                    ->whereDate('schedule_date', $start_date)
                    //->where('is_private', 0)
                    //->pluck('time_slot')
                    //->toArray();
                    ->get();

                $lesson_time = 60;
                if ($request->hour == 2) {
                    $lesson_time = 120;
                }

                if (is_array($av_time)) {
                    $html = "<label class='lesson_time_lbl'>Available times</label><select name='time_slot' onchange='check_availiblity(this)'><option value=''>Select lesson time</option>";
                    foreach ($av_time as $v) {
                        $start_time = strtotime($start_date . ' ' . $v->start_hour . ':' . $v->start_min);
                        $end_time = strtotime($start_date . ' ' . $v->end_hour . ':' . $v->end_min);
                        $slots = $this->createTimeSlot($lesson_travel_time, $start_time, $end_time, $lesson_time, $boobkly_appts, $start_date);

                        foreach ($slots as $i => $slot) {
                            $endtimestring = $slot['end'];
                            if ($slot['occupied']) {
                                $html .= '<option disabled value="' . $slot['start'].'-'.$endtimestring. '">' . $slot['start'].'-'.$endtimestring. '</option>';
                            } else {
                                $html .= '<option data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.strtotime($start_date.' '.$slot['end']).'" value="' . $slot['start'].'-'.$endtimestring. '" >' . $slot['start'].'-'.$endtimestring. '</option>';
                            }
                        }
                    }
                }
                return response()->json(['html' => $html, 'date'=>date( 'l, F d, ', strtotime($request->start_date)), 'boobkly_appts' => $boobkly_appts, 'av_time' => $av_time]);
            }
        }else{
            return response()->json(['html' => 'invalid request']);
        }
    }

    function get_slots1(Request $request){


        $instructor = User::where('id', $request->instructor_id)->first();
        if($instructor)
        {
            $start_date = $request->start_date;

            $test_appts_today = Appointments::where('user_id',$request->userid)
                    ->where('status', '!=', 'cancelled' )
                    ->where('type', '=', 'test' )
                    ->whereDate('schedule_date', $start_date)
                    ->first();

            if( ($test_appts_today) && $request->userid!="")
            {
                return response()->json(['html' => 'already_booked']);
            }
            else
            {
                $day = Carbon::parse($start_date)->format('l');
                $get_times = WorkingTime::where(['user_id' => $request->instructor_id, 'is_enabled' => 'yes', 'day' => $day])->first();
                if($get_times)
                {
                    /*appointment settings*/
                    $time_interval = $instructor->lesson_travel_time;

                    $av_time = json_decode($get_times->data);
                    /*get appointments of selected date*/
                    $boobkly_appts = Appointments::where('instructor_id',$request->instructor_id)
                        ->where('status', '!=', 'cancelled' )
                        ->whereDate('schedule_date', $start_date)
                        //->where('is_private', 0)
                        //->pluck('time_slot')
                        //->toArray();
                        ->get();

                    if (is_array($av_time)) {
                        $html = "<label class='time_slot_test_time_lbl'>Available times</label><select name='time_slot_test_time' onchange='check_availiblity1(this)'><option value=''>Select test start time</option>";
                        foreach ($av_time as $v) {
                            $start_time = $v->start_hour . ':' . $v->start_min;
                            $end_time = $v->end_hour . ':' . $v->end_min;
                            // $start_carb = Carbon::parse($start_time)->addMinutes($instructor->lesson_travel_time)->format('H:i');
                            // $end_carb = Carbon::parse($end_time)->addMinutes($instructor->lesson_travel_time)->format('H:i');
                            // $slots = $this->createTimeSlot($time_interval, $start_carb, $end_carb);
                            $slots = $this->createTimeSlot($time_interval, $start_time, $end_time);
                            foreach ($slots as $i => $slot) {
                                $add_time = 60 - $time_interval;
                                $endtime = strtotime('+'.$add_time.' minutes',strtotime($start_date.' '.$slot['end']));
                                $endtimestring = date('h:i a', $endtime);

                                if(empty($boobkly_appts)) {
                                    $html .= '<option data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.$endtime.'" value="' . $slot['start'].'-'.$endtimestring . '" >' . $slot['start'] . '</option>';
                                }
                                else {
                                    $start_time = (strtotime($start_date.' '.$slot['start']))-(3600+($instructor->lesson_travel_time*60));

                                    $is_blocked = 0;
                                    foreach($boobkly_appts as $appts) {
                                        $appts_array = explode('-', $appts->time_slot);
                                        $start_1 = $appts_array[0];
                                        $end_1 = $appts_array[1];

                                        $start = strtotime($start_date.' '.$start_1);
                                        //echo $start = $start-3600; die;
                                        $end = strtotime($start_date.' '.$end_1);

                                        if( ($start_time >= $start && $start_time < $end) || ($endtime > $start && $endtime <= $end) || ($start_time < $start && $endtime > $start) ) {
                                            $html .= '<option disabled value="' . $slot['start'].'-'.$endtimestring . '">' . $slot['start'] . '</option>';
                                            $is_blocked = 1;
                                        }
                                    }

                                    if($is_blocked == 0) {
                                        $html .= '<option data-start="'.strtotime($start_date.' '.$slot['start']).'" data-end="'.$endtime.'" value="' . $slot['start'].'-'.$endtimestring . '" >' . $slot['start'] . '</option>';
                                    }
                                }
                            }
                        }
                    }

                    return response()->json( [ 'html' => $html, 'date'=>date( 'l, F d, ', strtotime($request->start_date) ) ] );
                }
            }
        }
        else
        {
            return response()->json(['html' => 'invalid request']);
        }
    }
    function learner_register($search_id){
        $search = Search::find($search_id);
        if(!$search){
            return back()->with('error', 'Please make a new search');
        }
        $instructor = User::whereId($search->instructor_id)->where('type', 'inst')->first();
        $test_package = TestPackage::where('status', 1)->first();
        $regions = Region::where('status', 1)->get();
        $user = false;
        if( Auth::check() ){
            $user = User::find(auth()->user()->id);
        }
        return view('learner.register', compact('regions','user','instructor', 'search', 'search_id', 'test_package'));
    }

    function register_learner(Request $request){
        try {
            if( Auth::guest() ){
                $rules = [
                    'name'              => ['required', 'string', 'max:255'],
                    'last_name'         => ['required', 'string', 'max:255'],
                    'phone'             => ['required', 'string', 'max:14', 'min:10'],
                    'address'           => ['required'],
                    'year'              => ['required'],
                    'day'               => ['required'],
                    'month'             => ['required'],
                    'g-recaptcha-response' => 'required|captcha',
                ];
            }else{
                $rules = [
                    'address'           => ['required'],
                    'g-recaptcha-response' => 'required|captcha',
                ];
            }

            if( auth()->guest() ){
                $user_id = false;
                unset($rules['email']);
                $rules= array_merge($rules, [
                    'email'             => 'required|email|unique:users,email,'.$user_id,
                    'phone'             => ['required', 'string', 'max:12', 'min:10'],
                    'password'          => ['required', 'min:6', 'required_with:confirm_password', 'same:confirm_password'],
                    'confirm_password'  => ['required', 'min:6'],
                ]);
            }else{
                if(auth()->user()->type !='learner'){
                    return response()->json(['success' => false, 'message' => "You haven't permission to proceed!" ]);
                }
                unset($rules['email']);
                $user_id = auth()->user()->id;
            }
            $validator = Validator::make($request->all(), $rules,
            [
                'year.required' => 'please select year of birthday.',
                'day.required' => 'please select day of birthday.',
                'month.required' => 'please select month of birthday.',
                'g-recaptcha-response.required' => 'Captcha is required.',
            ]
            );
            if ($validator->fails()) {
                $err = $validator->errors();
                return response()->json(['error' => true, 'message' => $err]);
            }else {
                $user = new User();
                if ($request->user_id != '') {
                    $user = $user->findOrFail($request->user_id);
                }
                $user->fill($request->except(['password']));
                if(auth()->guest()){
                    $user->password = Hash::make($request->password);
                }
                $user->dob = $request->year . '-' . $request->month . '-' . $request->day;
                $user->lname = $request->last_name;
                $user->type = "learner";

                if ($user->save()) {
                    if(auth()->guest()) {
                        //$request->user()->sendEmailVerificationNotification();
                        Auth::loginUsingId($user->id);
                    }
                    $user_date = [
                        'learner_id' => $user->id,
                        'address' => $request->address,
                        'address_detail' => $request->address_detail,
                    ];
                    /*save search*/
                    Search::where('id', $request->search_id)->update(
                        ['step_5' => $user_date, 'learner_id' => $user->id,]
                    );
                    return response()->json(['success' => true]);
                }
            }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => 'something went wrong! '. $e->getMessage().$e->getLine()]);
        }
    }

    function learner_payment($search_id){

        if(auth()->guest()) {
            return back()->with('error', 'Please make a new search')->with('error', 'invalid request');
        }
        $search = Search::where('id',$search_id)->where('learner_id', auth()->user()->id)->first();
        if(!$search){
            return back()->with('error', 'Please make a new search');
        }
        $instructor = User::whereId($search->instructor_id)->where('type', 'inst')->first();
        $test_package = TestPackage::where('status', 1)->first();
        $regions = Region::where('status', 1)->get();
        $user = false;
        if( Auth::check() ){
            $user = User::find(auth()->user()->id);
        }
        return view('learner.payment', compact('test_package', 'regions','user','instructor', 'search', 'search_id'));
    }

    public function process_appointment(Request $request)
    {
      //  try{
            $learner = auth()->user();
            $user_id = $learner->id;
            $status = false;
            if(isset($request->stripeToken)) {
                $stripeToken = $request->stripeToken;
            } else {
                die("Request Failed!");
            }
            /*update address*/
            $user_date = [
                'learner_id' => $user_id,
                'address' => $request->address,
                'address_detail' => $request->address_detail,
            ];
            /*save search*/
            Search::where('id', $request->search_id)->update(
                ['step_5' => $user_date]
            );

            $search = Search::whereId($request->search_id)->first();
            if($search) {
                // check payment if already done

                if(PaymentResponse::where(['search_id'=> $search->id, 'user_id' => $user_id, 'status' =>'succeeded'])->exists() ){
                    return response()->json(['success' => false, 'message' => 'Appointment already registered with this search. please make new search OR contact with support in case of any problem.']);
                }

                $step_3 = $search->step_3;
                $step_3 = json_decode($step_3);
                $amount = @$step_3->total;
                $step_5 = $search->step_5;
                $step_5 = json_decode($step_5);
                $step_2 = $search->step_2;
                $step_2 = json_decode($step_2);

                $sch = $search->step_4;
                $sch = json_decode($sch);

                //print_r($sch); die;
                // if(isset($step_3->hour) && isset($step_3->hourly_rate) && isset($step_3->total) && isset($step_5->address) && is_array($step_2) && count($step_2)>0 && $sch->lesson_hour){
                if(isset($step_3->hour) && isset($step_3->hourly_rate) && isset($step_3->total) && isset($step_5->address) && is_array($step_2) && count($step_2)>0){
                    //
                }else{
                    return response()->json(['success' => false, 'message' => 'Invalid search data. please try again']);
                }



                $app_ids=[];

                $stripe_key = env('STRIPE_SECRET_KEY');

                if($stripe_key!=''){

                    $hourly_rate = Region::whereId($search->region_id)->value('price');

                    $schedule_date = $time_slot='';
                    $lesson_hour = 1;

                    if (isset($sch->lesson_hour)) {
                        $lesson_hour = $sch->lesson_hour;
                        $lesson_hour = explode(',', $lesson_hour);
                        //print_r($lesson_hour); die;
                    }
                    if (isset($sch->lesson_schedule_date))
                    {
                        $schedule_date = $sch->lesson_schedule_date;
                        $schedule_date = explode(',', $schedule_date);
                    }
                    if (isset($sch->lesson_time_slot))
                    {
                        $time_slot = $sch->lesson_time_slot;
                        $time_slot = explode(',', $time_slot);
                    }



                    $test_schedule_date = $test_time_slot = $test_location="";

                    if(isset($sch->test_schedule_date))
                    {
                        $test_schedule_date = $sch->test_schedule_date;
                    }
                    if(isset($sch->test_time_slot))
                    {
                        $test_time_slot = $sch->test_time_slot;
                    }
                    if(isset($sch->test_location))
                    {
                        $test_location = $sch->test_location;
                    }


                    if (is_numeric($amount)) {

                        foreach ($step_2 as $package) {

                            if ($package == 'test')
                            {
                                //===== to ready start & end date
                                $sdArray = explode('-', $test_schedule_date);
                                $newSD = $sdArray[2].'-'.$sdArray[1].'-'.$sdArray[0];
                                $timeslotArray = explode('-', $test_time_slot);

                                $timeStart = $timeslotArray[0];
                                $timeStartArray = explode(' ', $timeStart);
                                $timeStartRight = $timeStartArray[1];
                                if($timeStartRight=='am')
                                    { $finalStart = $timeStartArray[0]; }
                                else
                                    {
                                        $timeStartLeftArray = explode(':', $timeStartArray[0]);
                                        if(intval($timeStartLeftArray[0])==12)
                                        {
                                            $finalStart = $timeStartArray[0];
                                        }
                                        else
                                        {
                                            $lft = intval($timeStartLeftArray[0])+12;
                                            $finalStart = $lft.':'.$timeStartLeftArray[1];
                                        }
                                    }

                                $timeEnd = $timeslotArray[1];
                                $timeEndArray = explode(' ', $timeEnd);
                                $timeEndRight = $timeEndArray[1];
                                if($timeEndRight=='am')
                                    { $finalEnd = $timeEndArray[0]; }
                                else
                                    {
                                        $timeEndLeftArray = explode(':', $timeEndArray[0]);
                                        if(intval($timeEndLeftArray[0])==12)
                                        {
                                            $finalEnd = $timeEndArray[0];
                                        }
                                        else
                                        {
                                            $lft = intval($timeEndLeftArray[0])+12;
                                            $finalEnd = $lft.':'.$timeEndLeftArray[1];
                                        }
                                    }

                                $final_start_date = $newSD . " " . $finalStart;
                                $final_end_date = $newSD . " " . $finalEnd;
                                //=========================================================

                                $appointmetObj = new Appointments();
                                $appointmetObj->user_id = $user_id;
                                $appointmetObj->schedule_date = $test_schedule_date;
                                $appointmetObj->time_slot = $test_time_slot;
                                $appointmetObj->status = "confirmed";
                                $appointmetObj->instructor_id = $search->instructor_id;
                                $appointmetObj->payment_status = 0;
                                $appointmetObj->search_id = $search->id;
                                $appointmetObj->type = 'test';
                                $appointmetObj->start_date = $final_start_date;
                                $appointmetObj->end_date = $final_end_date;
                                $appointmetObj->is_private = 0;
                                $appointmetObj->amount = $step_3->test_price;
                                // if(isset($sch->test_location) && $sch->test_location!='' && is_numeric($sch->test_location) ){
                                //     $appointmetObj->test_location = $sch->test_location;
                                // }
                                $appointmetObj->test_location = $test_location;
                                $appointmetObj->address = json_encode($step_5);

                                /*print_r($appointmetObj);
                                exit;*/
                                if ($appointmetObj->save()) {
                                    $app_ids[] = $appointmetObj->id;
                                }

                            }
                            elseif ($package == 'lesson')
                            {
                                $hour = $step_3->hour; // total booking hours
                                if (isset($step_3->hourly_rate)) {
                                    $hourly_rate = @$step_3->hourly_rate;
                                }

                                $total_les_hr = 0;
                                if(is_array($lesson_hour))
                                {
                                    foreach ($lesson_hour as $lsn_hr)
                                    {
                                        $total_les_hr = $total_les_hr + $lsn_hr;
                                    }
                                }

                                $rest_hr = $hour - $total_les_hr;

                                if($rest_hr > 0)
                                {
                                    $price = $hourly_rate * $rest_hr;

                                    $appointmetObj = new Appointments();
                                    $appointmetObj->user_id = $user_id;
                                    $appointmetObj->status = "confirmed";
                                    $appointmetObj->instructor_id = $search->instructor_id;
                                    $appointmetObj->payment_status = 0;
                                    $appointmetObj->is_private = 0;
                                    $appointmetObj->search_id = $search->id;
                                    $appointmetObj->type = 'lesson';
                                    $appointmetObj->hourly_rate = $hourly_rate;
                                    $appointmetObj->lesson_hour = $rest_hr;
                                    $appointmetObj->address = json_encode($step_5);
                                    $appointmetObj->amount = $price;
                                    if ($appointmetObj->save()) {
                                        $app_ids[] = $appointmetObj->id;
                                    }
                                }

                                //print_r($schedule_date);

                                if(!empty($schedule_date))
                                {
                                    foreach ($schedule_date as $key => $sd)
                                    {

                                        //===== to ready start & end date
                                        $sdArray = explode('-', $sd);
                                        $newSD = $sdArray[2].'-'.$sdArray[1].'-'.$sdArray[0];
                                        $timeslotArray = explode('-', $time_slot[$key]);

                                        $timeStart = $timeslotArray[0];
                                        $timeStartArray = explode(' ', $timeStart);
                                        $timeStartRight = $timeStartArray[1];
                                        if($timeStartRight=='am')
                                            { $finalStart = $timeStartArray[0]; }
                                        else
                                            {
                                                $timeStartLeftArray = explode(':', $timeStartArray[0]);
                                                if(intval($timeStartLeftArray[0])==12)
                                                {
                                                    $finalStart = $timeStartArray[0];
                                                }
                                                else
                                                {
                                                    $lft = intval($timeStartLeftArray[0])+12;
                                                    $finalStart = $lft.':'.$timeStartLeftArray[1];
                                                }
                                            }

                                        $timeEnd = $timeslotArray[1];
                                        $timeEndArray = explode(' ', $timeEnd);
                                        $timeEndRight = $timeEndArray[1];
                                        if($timeEndRight=='am')
                                            { $finalEnd = $timeEndArray[0]; }
                                        else
                                            {
                                                $timeEndLeftArray = explode(':', $timeEndArray[0]);
                                                if(intval($timeEndLeftArray[0])==12)
                                                {
                                                    $finalEnd = $timeEndArray[0];
                                                }
                                                else
                                                {
                                                    $lft = intval($timeEndLeftArray[0])+12;
                                                    $finalEnd = $lft.':'.$timeEndLeftArray[1];
                                                }
                                            }

                                        $final_start_date = $newSD . " " . $finalStart;
                                        $final_end_date = $newSD . " " . $finalEnd;
                                        //=========================================================

                                        $price = $hourly_rate * $lesson_hour[$key];

                                        $appointmetObj = new Appointments();
                                        $appointmetObj->user_id = $user_id;
                                        $appointmetObj->schedule_date = $sd;
                                        $appointmetObj->time_slot = $time_slot[$key];
                                        $appointmetObj->status = "confirmed";
                                        $appointmetObj->instructor_id = $search->instructor_id;
                                        $appointmetObj->payment_status = 0;
                                        $appointmetObj->is_private = 0;
                                        $appointmetObj->search_id = $search->id;
                                        $appointmetObj->type = 'lesson';
                                        $appointmetObj->hourly_rate = $hourly_rate;
                                        $appointmetObj->lesson_hour = $lesson_hour[$key];
                                        $appointmetObj->start_date = $final_start_date;
                                        $appointmetObj->end_date = $final_end_date;
                                        $appointmetObj->address = json_encode($step_5);
                                        $appointmetObj->amount = $price;
                                        if ($appointmetObj->save()) {
                                            $app_ids[] = $appointmetObj->id;
                                        }
                                    }
                                }

                                /*  old==============
                                    $div_hr= $hour / $lesson_hour;
                                    if($hour >= $lesson_hour) {
                                        $hrs = ceil($div_hr);
                                    }
                                    $one_hour_lesson= false;
                                    if($lesson_hour==2 && is_float($div_hr)){
                                        $one_hour_lesson= true;
                                    }

                                    $price = $hourly_rate * $lesson_hour;

                                    for ($i = 1; $i <= $hrs; $i++) {
                                        $appointmetObj = new Appointments();
                                        $appointmetObj->user_id = $user_id;
                                        if($i==1){
                                            $appointmetObj->schedule_date = $schedule_date;
                                            $appointmetObj->time_slot = $time_slot;
                                        }

                                        $appointmetObj->status = "unconfirmed";
                                        $appointmetObj->instructor_id = $search->instructor_id;
                                        $appointmetObj->payment_status = 0;
                                        $appointmetObj->is_private = 0;
                                        $appointmetObj->search_id = $search->id;
                                        $appointmetObj->type = 'lesson';
                                        $appointmetObj->hourly_rate = $hourly_rate;
                                        if($hrs == $i && $one_hour_lesson == true){
                                            $appointmetObj->lesson_hour = 1;
                                        }else{
                                            $appointmetObj->lesson_hour = $lesson_hour;
                                        }
                                        $appointmetObj->address = json_encode($step_5);
                                        $appointmetObj->amount = $price;
                                        if ($appointmetObj->save()) {
                                            $app_ids[$i] = $appointmetObj->id;
                                        }
                                    }
                                */
                            }
                        }

                        $appIds = implode(',', $app_ids);
                            /* calculate first appointment */

                            \Stripe\Stripe::setApiKey($stripe_key); // this is Secret key
                            $total_amount = $amount * 100;
                            $charge = \Stripe\Charge::create([
                                'amount' => $total_amount,
                                'currency' => 'usd',
                                'source' => $stripeToken,
                                'description' => 'appointment for instructor =' . $search->instructor_id . ' from user =' . $user_id . ' appointment id =' . $appointmetObj->id,
                            ]);
                            if ($charge['paid'] == 1) {
                                $status = true;
                                Appointments::whereIn('id', $app_ids)->update(['payment_status' => 1]);
                                $converted = $charge['amount'] / 100;
                                $payment_response = new PaymentResponse();
                                $payment_response->charge_id = $charge['id'];
                                $payment_response->balance_transaction_id = $charge['balance_transaction'];
                                $payment_response->amount = $charge['amount'];
                                $payment_response->converted_amount = $converted;
                                $payment_response->currency = $charge['currency'];
                                $payment_response->created = $charge['created'];
                                $payment_response->status = $charge['status'];
                                $payment_response->method = "Stripe";
                                $payment_response->appointment_id = $appIds;
                                $payment_response->response = json_encode($charge);
                                $payment_response->user_id = \auth()->user()->id;
                                $payment_response->search_id = $search->id;
                                if ($payment_response->save()) {
                                    /*send email to instructor*/
                                    $instructor = User::where('id', $search->instructor_id)->first();
                                    if ($instructor) {
                                        /* Wallet For Admin and Instructor User */
                                        $GetAdminRecord = User::where('type', 'admin')->first();
                                        $AdminCommission = 5;
                                        $calculated = ($amount * $AdminCommission) / 100;
                                        $ToInstructor = $amount - $calculated;
                                        $ToAdmin = $calculated;
                                        /* Admin Wallet */
                                        $GetAdminBalance = Wallet::where('user_id', $GetAdminRecord->id)->first();
                                        if ($GetAdminBalance) {
                                            $UpdateBalance = $GetAdminBalance->withdrawable + $ToAdmin;
                                            Wallet::updateOrCreate(
                                                ['user_id' => $GetAdminRecord->id],
                                                [
                                                    'user_id' => $GetAdminRecord->id,
                                                    'withdrawable' => $UpdateBalance,
                                                ]);
                                        } else {
                                            Wallet::updateOrCreate(
                                                ['user_id' => $GetAdminRecord->id],
                                                [
                                                    'user_id' => $GetAdminRecord->id,
                                                    'withdrawable' => $ToAdmin,
                                                ]);
                                        }
                                        /* Instructor Wallet */
                                        $GetInstructorBalance = Wallet::where('user_id', $search->instructor_id)->first();
                                        if ($GetInstructorBalance) {
                                            $UpdateBalance = $GetInstructorBalance->withdrawable + $ToInstructor;
                                            Wallet::updateOrCreate(
                                                ['user_id' => $search->instructor_id],
                                                [
                                                    'user_id' => $search->instructor_id,
                                                    'withdrawable' => $UpdateBalance,
                                                ]);
                                        } else {
                                            Wallet::updateOrCreate(
                                                ['user_id' => $search->instructor_id],
                                                [
                                                    'user_id' => $search->instructor_id,
                                                    'withdrawable' => $ToInstructor,
                                                ]);
                                        }

                                        /* send confirmation SMS */

                                        if($time_slot!=''){
                                            $schedule_date = $schedule_date[0].' '. $time_slot[0];
                                        }

                                        $twilio = new TwilioController();
                                        /* message to constructor */
                                        if($instructor->phone!=''){
                                            $inst_message = 'Hi '. ucfirst($instructor->name);
                                            $inst_message .= ' We received new appointment request from' . ucfirst($learner->name). " \n ";
                                            $inst_message .= 'Appointment date is '.$schedule_date. " \n";
                                            $inst_message .= 'Please visit '.url('/login').' to confirm';
                                            //$twilio->sendMessage($inst_message, $instructor->phone);
                                        }
                                        if($learner->phone!=''){
                                            $inst_message = 'This is Payment confirmation message from FirstPass' ."\n";
                                            $inst_message .= 'appointment confirmation message will be sent to you.  '. "\n";
                                            $inst_message .= 'Please visit '.url('/login').' to check status';
                                           // $twilio->sendMessage($inst_message, $learner->phone);
                                        }

                                        $email_settings = EmailSettings::find(1);
                                        $settings = Settings::find(1);
                                        /*email to instructor about appointment*/
                                        $s = array('%FIRST_NAME%', '%LAST_NAME%', '%EMAIL%', '%PHONE%', '%ADDRESS%', '%BOOK_DATE%');
                                        $r = array($instructor->name, $instructor->lname, $instructor->email, $instructor->phone, $step_5->address, $schedule_date);
                                        $email_body = str_replace($s, $r, $email_settings->appt_body);
                                        if ($settings->email_type == 'api') {
                                            if ($settings->email_api == 'send_grid') {
                                                // sending email to super admin
                                                AppTraits::SendgridEmail($email_body, $instructor->email, $email_settings->appt_subject, 'FirstPass', $instructor->name, $settings->sg_email, $settings->sg_apikey);
                                            }
                                        } else {
                                            AppTraits::SmtpEmail($email_body, $instructor->email, $email_settings->appt_subject, $settings->smtp_from_name, "Super Admin", $settings->smtp_username, $settings->smtp_password, $settings->smtp_host, $settings->smtp_post, $settings->smtp_femail, $settings->use_ssl, null);
                                        }
                                    }
                                }
                            }
                    }
                }
            }

            if($status == true){
                return response()->json(['success' => true, 'message' => 'Saved successfully.'], 200);
            }else{
                return response()->json(['success' => false, 'message' => 'Something Went Wrong with payment process. please refresh page and try again!!']);
            }
        /*}catch (\Exception $e) {
            $message = $e->getMessage().$e->getLine();
            return response()->json(['success' => false, 'message' => $message]);
        }*/
    }

    function check_search_status($search_id){
        if( Appointments::where('search_id', $search_id)->exists() ){
            return true;
        }
        return false;
    }

    function load_events(Request $request){

        if($request->type == 'check_availability'){
            $appointments = Appointments::where('instructor_id', $request->id)
                ->select('id', 'schedule_date', 'time_slot', 'type')
                ->where('status', '!=', 'cancelled')
                ->where('time_slot', '!=', '')
                //->where('is_private', 0)
                ->whereDate('schedule_date','>=', Carbon::now()->format('Y-m-d'))
                ->get();
            $events=[];
            foreach ($appointments as $appointment)
            {
                $lesson_hr = $appointment->lesson_hour;

                $timeSlot_start = explode('-', $appointment->time_slot);

                if($appointment->type=="test")
                { $date_start = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_start[0])->subHour(); }
                else{ $date_start = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_start[0]); }

                $start = $date_start->format('Y-m-d H:i');


                $timeSlot_end = explode('-', $appointment->time_slot);
                $date_end = Carbon::parse($appointment->schedule_date . ' ' . $timeSlot_end[1]);
                $end = $date_end->format('Y-m-d H:i');

                //$end = $date->addHours($lesson_hr)->format('Y-m-d H:i');

                $events[] = [
                    "groupId" => "testGroupId",
                    "start" => $start,
                    "end" => $end,
                    "rendering" => "background",
                    "color" => "#000000",
                ];
            }

            $avl = [];
            $get_timess = WorkingTime::where(['user_id' => $request->id, 'is_enabled' => 'yes'])->get();

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
                            'daysOfWeek' => [$num],
                            'startTime' => $start_time,
                            'endTime' => $end_time,
                        ];
            }


            //echo "<pre>";
            //print_r($get_times); die;

            return response()->json(['events' => $events, 'avl' => $avl]);
        }
    }

    public function view_instructors(Request $request, $id=false){
        $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')
            ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.preferred_name', 'users.phone', 'users.gender', 'users.avatar')
            ->where(['users.type' => 'inst', 'users.status' => 1]);
        if($id){
            $users = $users->where('users.id',$id);
        }
        $users= $users->get();
        $total = $users->count();
        /*save search*/
        $ip = $request->getClientIp();
        $prev = url()->previous();

        $search_check = Search::join('appointments', 'appointments.search_id', 'search.id')
            ->where(['search.learner_id' => Auth::id()])
            ->where('search.region_id', '!=', '')
            ->orderBy('appointments.id', 'desc')
            ->first();
        if( $search_check){
            $search =  Search::create(
                ['ip' => $ip, 't_type' => 'both', 'region_id' => $search_check->region_id, 'learner_id' => Auth::id()]
            );
            $search_id = $search->id;
            $region = Region::find($search_check->region_id);
            return $view = view('search.book_more', compact('region','search_id', 'search','users', 'total'));
        }else{
            abort('404');
        }
    }

    public function create_search_from_learner(Request $request)
    {
        $ip = $request->getClientIp();
        $learner = $request->learner_id;
        $search_check = Search::join('appointments', 'appointments.search_id', 'search.id')
            ->where(['search.learner_id' => $learner])
            ->where('search.region_id', '!=', '')
            ->orderBy('appointments.id', 'desc')
            ->first();
        $search =  Search::create(
                ['ip' => $ip, 't_type' => 'both', 'region_id' => $search_check->region_id, 'learner_id' => $learner]
            );
        $search_id = $search->id;
        return response()->json(['search_id' => $search_id]);
    }


    public function register_inst(Request $request)
    {
        $email_settings = DB::table('email_settings')->where("id",1)->first();
        $settings = Settings::where('id',1)->first();
        $admin = DB::table('users')->where("type",'admin')->first();


        $body = '
        <p class="p1"><span class="s1">Hi '.$request->name.',</span></p>
        <p class="p1"><span class="s1"><br />Welcome to FirstPass!</span></p>
        <p class="p1"><span class="s1">Your credentials has been sent to admin for review. You will get notification as soon as possible.</span></p>
        <p class="p1"><span class="s1">&nbsp;</span></p>
        <p class="p1"><span class="s1">Thanks,</span></p>
        <p>&nbsp;</p>
        <p class="p1"><span class="s1">Need support help? Email us: '.$admin->email.'</span></p>
        ';

        $body1 = '
        <p class="p1"><span class="s1">Hi admin,</span></p>
        <p class="p1"><span class="s1"><br />A new user has been registered as Instructor.</span></p>
        <p class="p1"><span class="s1">See the details in below.</span></p>
        <p class="p1"><span class="s1">&nbsp;</span></p>
        <p class="p1"><span class="s1">First Name: '.$request->name.'</span></p>
        <p class="p1"><span class="s1">Last Name: '.$request->lname.'</span></p>
        <p class="p1"><span class="s1">Email: '.$request->email.'</span></p>
        <p class="p1"><span class="s1">Phone: '.$request->phone.'</span></p>
        <p class="p1"><span class="s1">Post Code: '.$request->postcode.'</span></p>
        <p class="p1"><span class="s1">Vehicle transmission/s: '.$request->vehicle_transmissions.'</span></p>
        <p class="p1"><span class="s1">Message: '.$request->message.'</span></p>
        <p class="p1"><span class="s1">&nbsp;</span></p>
        <p class="p1"><span class="s1">Thanks,</span></p>
        <p>&nbsp;</p>
        <p class="p1"><span class="s1">Need support help? Email us: '.$admin->email.'</span></p>
        ';

        if($settings->email_type=='api')
        {
            if($settings->email_api=='send_grid'){
                //$body,$to,$subject,$from_name,$to_name,$from_email,$apikey // sending email to user
                AppTraits::SendgridEmail($body,
                   $request->email,
                    $email_settings->confirm_subject,'FirstPass',
                    $request->name.' '. $request->lname, $settings->sg_email,$settings->sg_apikey);

                /* to super admin */
                AppTraits::SendgridEmail($body1,
                    $admin->email,
                    $email_settings->newuser_subject,'FirstPass',
                    $request->name.' '. $request->lname, $settings->sg_email,$settings->sg_apikey);

            }
        }
        else
        {
            // sending email to user
            AppTraits::SmtpEmail(
                $body,
                $request->email,
                $email_settings->confirm_subject,
                $settings->smtp_from_name,
                $request->name.' '. $request->lname,
                $settings->smtp_username,
                $settings->smtp_password,
                $settings->smtp_host,
                $settings->smtp_port,
                $settings->smtp_femail,
                $settings->use_ssl

            ); /// sending email to user

            // sending email to super admin
           AppTraits::SmtpEmail(
                $body1,
                "theitobjects@gmail.com",
                $email_settings->confirm_subject,
                $settings->smtp_from_name,
                "super admin",
                $settings->smtp_username,
                $settings->smtp_password,
                $settings->smtp_host,
                $settings->smtp_port,
                $settings->smtp_femail,
                $settings->use_ssl
            );  // sending email to super admin
        }

        return response()->json(['success' => true, 'message' => 'Successfully sent your data to review.']);
    }

    public function searchInstructors($search_id)
    {
        $search_data = Search::findOrFail($search_id);
        $region = Region::select('title', 'id')->whereId($search_data->region_id)->first();
        if($region) {
            $available_users_r = ServiceRegions::where('region_id', $search_data->region_id)->pluck('user_id');

            if(count($available_users_r)>0) {
                $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')
                    ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar', 'users.preferred_name', 'users.phone', 'users.gender')
                    ->whereIn('users.id', $available_users_r)
                    ->whereIn("user_meta.transmission_type",['both',$search_data->t_type])
                    ->where(['users.type' => 'inst', 'users.status' => 1]);
                //   echo "<pre>";print_r($users->get());die();

                $users = $users->get();
                $total = $users->count();
                $title = $region->title;
                $t_type = $search_data->t_type;
                return view('search.result', compact('users','region','search_id','total','title','t_type'));
            }else{
                return response()->json(['success' => false, 'message' => 'Result not found!']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Result not found!']);
        }
    }

    public function searchFilter($search_id, Request $request){
        // return response()->json(['success' => $request->all]);
        $search_data = Search::findOrFail($search_id);
        $region = Region::select('title', 'id')->whereId($search_data->region_id)->first();
        if($region) {
            $available_users_r = ServiceRegions::where('region_id', $search_data->region_id)->pluck('user_id');

            if(count($available_users_r)>0) {
                $users = User::join('user_meta', 'user_meta.user_id', '=', 'users.id')
                    ->select('users.id', 'user_meta.language', 'users.name', 'users.lname', 'users.avatar', 'users.preferred_name', 'users.phone', 'users.gender')
                    ->whereIn('users.id', $available_users_r)
                    ->whereIn("user_meta.transmission_type",['both',$search_data->t_type])
                    ->where(['users.type' => 'inst', 'users.status' => 1]);

                if($request->gender){
                    $users = $users->where('users.gender', $request->gender);
                }

                if($request->availability!="" || $request->time != ""){
                    $users = $users->rightJoin('working_time', 'working_time.user_id', '=', 'users.id');
                }

                if($request->availability){
                    $availableDays = [];
                    if($request->availability == "weekdays"){
                        $availableDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
                    }
                    else{
                        $availableDays = ['sunday', 'saturday'];
                    }

                    $users = $users->where(function($qry) use ($request, $availableDays){
                        $qry->whereIn('working_time.day', $availableDays);
                        $qry->where('working_time.is_enabled', 'yes');
                    });

                }

                if($request->time != "" && $request->time != "any"){
                    if($request->time == "am"){
                        // $users = $users->where(DB::raw("JSON_EXTRACT(data '$.start_hour')", '<', 12);
                       $users = $users->whereRaw("CAST(TRIM(BOTH '\"' FROM left(right(JSON_EXTRACT(`working_time`.`data`, '$[*].start_hour'),5),4)) AS UNSIGNED)<12");
                    }
                    else{
                        // $users = $users->where(DB::raw("JSON_EXTRACT(data '$.start_hour')", '<', 12);
                       $users = $users->whereRaw("CAST(TRIM(BOTH '\"' FROM left(right(JSON_EXTRACT(`working_time`.`data`, '$[*].end_hour'),5),4)) AS UNSIGNED)>=12");
                    }
                     //whereJsonContains('to', [['emailAddress' => ['address' => 'test@example.com']]]);
                }

                if($request->date != ""){

                }

                //   echo "<pre>";print_r($users->get());die();
                $users->groupBy('users.id');
                //echo $users->toSql();
                $users = $users->get();
                // $users->unique('users.id');

                return response()->json(['success' => true, 'message' => $users]);
            }else{
                return response()->json(['success' => false, 'message' => 'Result not found!']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'Result not found!']);
        }
    }

}
