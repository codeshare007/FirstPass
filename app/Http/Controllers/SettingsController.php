<?php

namespace App\Http\Controllers;

use App\ConnectedAccounts;
use App\StripeSetting;
use App\TwilioSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Activitylog\Models\Activity;
use Stripe\Stripe;
use Twilio\Rest\Client;

class SettingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function twiliosetting()
    {
        $user_id = auth()->user()->id;
        $stripe_settings = StripeSetting::where('user_id', $user_id)->first();
        $twilio_settings = TwilioSetting::find(1);
        $phone_numbers = array();
        if($twilio_settings){
            $twilio = new Client($twilio_settings->twilio_sid, $twilio_settings->twilio_token);
            $incoming_phone_number = $twilio->incomingPhoneNumbers->read(array(), 20);

            foreach ($incoming_phone_number as $record) {
                $incoming_phone = $twilio->incomingPhoneNumbers($record->sid)
                    ->fetch();
                $phone_numbers[] = $incoming_phone->phoneNumber;
            }
        }

        return view('settings.twilio-settings', compact('stripe_settings', 'twilio_settings', 'phone_numbers'));
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $stripe_settings = StripeSetting::where('user_id', $user_id)->first();
        $twilio_settings = TwilioSetting::find(1);
        $phone_numbers = array();
        if($twilio_settings){
            $twilio = new Client($twilio_settings->twilio_sid, $twilio_settings->twilio_token);
            $incoming_phone_number = $twilio->incomingPhoneNumbers->read(array(), 20);

            foreach ($incoming_phone_number as $record) {
                $incoming_phone = $twilio->incomingPhoneNumbers($record->sid)
                    ->fetch();
                $phone_numbers[] = $incoming_phone->phoneNumber;
            }
        }

        return view('settings.index', compact('stripe_settings', 'twilio_settings', 'phone_numbers'));
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
        $user_id = auth()->user()->id;
        if($request->type == 'stripe'){

            $stripe = new StripeSetting();
            if($request->stripe_id!='') {
                $stripe = $stripe->findOrFail($request->stripe_id);
            }

            $stripe->fill($request->only('public_key', 'secret_key', 'client_id'));
            $stripe->user_id = $user_id;

            if($stripe->save()){
                activity()->causedBy(Auth::user())
                    ->performedOn($stripe)
                    ->log('edited');
                return response()->json(['success' => true, 'message' => 'Saved Successfully!', 'id' => $stripe->id], 200);
            }
        }elseif ($request->type== 'get_number'){
            $html='';
            $twilio = new Client($request->sid, $request->token);
            $incoming_phone_number = $twilio->incomingPhoneNumbers->read(array(), 20);

            foreach ($incoming_phone_number as $record) {
                $incoming_phone = $twilio->incomingPhoneNumbers($record->sid)
                    ->fetch();
                $html.= "<option value='$incoming_phone->phoneNumber'>$incoming_phone->phoneNumber</option>";
            }

            return response()->json(['success' => true, 'html' => $html ], 200);

        }elseif($request->type == 'twilio'){

        $twilio = new TwilioSetting();
        if($request->id!='') {
            $twilio = $twilio->findOrFail($request->id);
        }

        $twilio->fill($request->only('twilio_sid', 'twilio_token', 'from_number'));
        $twilio->user_id = $user_id;

        if($twilio->save()){
            activity()->causedBy(Auth::user())
                ->performedOn($twilio)
                ->log('edited');
            return response()->json(['success' => true, 'message' => 'Saved Successfully!', 'id' => $twilio->id], 200);
        }
    }

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

    public function redirect_url(Request $request)
    {
        $checkStripeAccounts    =    StripeSetting::where('user_id', 1)->exists();
        $InstructorID  =   Auth::user()->id;
        if($checkStripeAccounts){
            $getStripeAccounts    =    StripeSetting::where('user_id', 1)->first();
            $webAdmin_secret_key = $getStripeAccounts->secret_key;
            $password = '';
            $url = env('STRIPE_CONNECT_URL');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_USERPWD, "$webAdmin_secret_key:$password");
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['client_secret' => $webAdmin_secret_key, 'code' => $request['code'], 'grant_type' => 'authorization_code']);
            $output = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            $response = json_decode($output);
            $response->access_token;
            $response->refresh_token;
            $response->stripe_publishable_key;
            $response->stripe_user_id;

            if ($response->stripe_user_id) {
                $connectedAccount   =    ConnectedAccounts::updateOrCreate([
                    'user_id'    =>  $InstructorID,
                    'access_token' => $response->access_token,
                    'refresh_token' => $response->refresh_token,
                    'stripe_publishable_key' => $response->stripe_publishable_key,
                    'stripe_user_id' => $response->stripe_user_id,
                    'response' => json_encode($response, true)

                ],['user_id' => $InstructorID]);
                if ($connectedAccount) {
                    return Redirect::to('settings')->with(['success' => true, 'message' => 'Your Account has been Integrated. Thank you']);
                }else{
                    return Redirect::to('settings')->with(['success' => false, 'message' => 'Something went wrong!']);
                }
            }else{
                return Redirect::to('settings')->with(['success' => false, 'message' => 'Sorry! Account not connected to admin.']);
            }
        }else{
            return Redirect::to('settings')->with(['success' => false, 'message' => 'Admin Account setting required']);
        }
    }
}
