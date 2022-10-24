<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Settings;
use App\Traits\AppTraits;
use App\User;
use App\UserMeta;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INSTRUCTOR_UNDER_REVIEW;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:12', 'min:10'],
            'postcode' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'      => $data['name'],
            'lname'      => $data['lname'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'postcode'  => $data['postcode'],
            'type'      => 'inst',
            'status'    => 'review',
            'password'  => Hash::make($data['password']),
            'message'   => $data['message']
        ]);

        if($user){
            UserMeta::create([
                'transmission_type' => $data['vehicle_transmissions'],
                'user_id' => $user->id
            ]);
        }
        /* send email */
        $this->sendEmail($data);
        return $user;
    }

    function sendEmail($user){

        $s = array('%name%' , '%email%' , '%login_url%' , '%password%');
        $r = array( $user['name'].' '. $user['lname'], $user['email'], url('/login'), $user['password'] );

        $email_settings = DB::table('email_settings')->where("id",1)->first();
        $settings = Settings::where('id',1)->first();

        $body = str_replace($s, $r, $email_settings->confirm_body);
        $body1 = str_replace($s, $r, $email_settings->new_body);

        if($settings->email_type=='api')
        {
            if($settings->email_api=='send_grid'){
                //$body,$to,$subject,$from_name,$to_name,$from_email,$apikey // sending email to user
                AppTraits::SendgridEmail($body,
                   $user['email'],
                    $email_settings->confirm_subject,'FirstPass',
                    $user['name'].' '. $user['lname'], $settings->sg_email,$settings->sg_apikey);

                /* to super admin */
                AppTraits::SendgridEmail($body1,
                    "theitobjects@gmail.com",
                    $email_settings->newuser_subject,'FirstPass',
                    $user['name'].' '. $user['lname'], $settings->sg_email,$settings->sg_apikey);

            }
        }
        else
        {
            // sending email to user
            AppTraits::SmtpEmail(
                $body,
                $user['email'],
                $email_settings->confirm_subject,
                $settings->smtp_from_name,
                $user['name'].' '. $user['lname'],
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
    }
}
