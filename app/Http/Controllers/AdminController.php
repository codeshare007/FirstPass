<?php

namespace App\Http\Controllers;

use App\DrivingLicence;
use App\EmailSettings;
use App\InstructorDocs;
use App\InstructorLicence;
use App\Notification;
use App\Settings;
use App\UserMeta;
use App\WwccLicence;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Email;

class AdminController extends Controller
{
    public function email_settings(Request $request)
    {
        $setting =  EmailSettings::find(1);
        $data = Settings::where('userid', auth()->user()->id)->first();

        return view('admin.email_settings', compact('setting', 'data'));
    }

    public function save(Request $request)
    {

        try{
            $settings =  Emailsettings::find(1);
            if($settings)
            {
                $settings->fill($request->all());
            }else{
                $settings =  new Emailsettings;
                $settings->fill($request->all());
            }

            if($settings->save()){
                return response()->json(['success' => true, 'message' => 'Settings Successfully Saved']);
            }
            else{
                return response()->json(['success' => false, 'message' => 'An Error Occured, Settings Not Saved']);
            }


            return view('email_settings', ['settings'=>$settings]);

        }
        catch (\Exception $e ) {

            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
        }
    }

    function storeMailing(Request $request){

        $settings = new Settings();

        if($request->id!='') {
            $settings = $settings->findOrFail($request->id);
        }

        $settings->fill($request->all());

        $settings->userid = auth()->user()->id;

        if($request->has('use_ssl')){
            $settings->use_ssl = 'yes';
        }else{
            $settings->use_ssl = null;
        }

        if($settings->save()){
            return response()->json(['success' => true, 'message' => 'Settings Successfully Saved']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'An Error Occured, Settings Not Saved']);
        }
    }

    function mailSendTest(Request $request){



        $body = '
    <table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
<tbody>
<tr>
<td  style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
    <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Hello!</h1>
<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">It is '.ucfirst( $request->gate ).' test email please ignore.</p>
    <table  align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%"><tbody><tr>
<td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box"><tbody><tr>
<td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
    <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box"><tbody><tr>
    </tr>
    </tbody>
    </table>
</td>
    </tr></tbody></table>
</td>
    </tr></tbody></table>
</td>
    </tr>
<tr>
<td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
        <table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:0 auto;padding:0;text-align:center;width:570px">
        <tbody>
        <tr>
            <td  align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;line-height:1.5em;margin-top:0;color:#aeaeae;font-size:12px;text-align:center"> © '. date('Y') .' '.env('APP_NAME').'</p>
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
        <div class="yj6qo">
        </div>
        <div class="adL">
</div></div>';

        try {

            $subject = env('APP_NAME') . " " . str_replace('_', ' ', $request->type) . " mail test";

            if ($request->gate == "smtp" ) {
                $mail = new PHPMailer(true);
                //$mail->SMTPDebug = 2;
                $mail->isSMTP();                   // Set mailer to use SMTP
                $mail->Host = $request->smtp_host;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;              // Enable SMTP authentication
                $mail->Username = $request->smtp_username;  // SMTP username
                $mail->Password = $request->smtp_password;  // SMTP password
                $mail->SMTPSecure = $request->using_ssl;    // Enable TLS encryption, `ssl` also accepted
                $mail->Port = $request->smtp_port;          // TCP port to connect to
                $mail->SMTPOptions = array('ssl' => array('verify_host' => false, 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
                $mail->setFrom($request->smtp_femail, $request->smtp_fname);
                $mail->addAddress($request->test_email, auth()->user()->name);// Add a recipient
                //$mail->addCustomHeader( 'In-Reply-To', '<' . $request->smtp_femail . '>' );
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body = $body;

                if (!$mail->send()) {
                    return response()->json(['success' => false, 'message' => $mail->ErrorInfo]);
                } else {
                    $imap = true;
                    if (! function_exists('imap_open')) {
                        $imap = false;
                    } else {
                        if($request->using_ssl == 'ssl'){ $s = 'ssl'; }else{ $s = 'tls'; }
                        /* Connecting server with IMAP */
                        $r = "{".$request->imap_server.":".$request->imap_port."/imap/$s/novalidate-cert}INBOX";
                        $connection = imap_open($r, $request->smtp_username, $request->smtp_password, OP_DEBUG);
                        if(!$connection){
                            $imap = false;
                        }
                    }

                    if($imap){

                        return response()->json(['success' => true, 'message' => 'Email send successfully']);
                    }else{
                        return response()->json(['success' => false, 'message' => 'Email send successfully But '.imap_last_error()]);
                    }
                }
            } else
                if ($request->gate == "api") {

                        if ($request->type == "sendgrid") {     //## sendgrid

                            //echo $apikey;
                            $str = trim(preg_replace('/\s+/', " ", $body));
                            $b = preg_replace("/\"/", "\\\"", $str);
                            //$b.="<img src='route(open-tracking) ' style ='display:none; width:1px;' />";
                            $subject = preg_replace("/\"/", "\\\"", $subject);
                            $uri = 'https://api.sendgrid.com/v3/mail/send';
                            $json = '{
            "personalizations": [
                    {
                        "to": [{
                                "email": "' . $request->test_email . '",
                                "name":"' . auth()->user()->name . '"
                        }]
                    }
                ],
                "from": {
                    "email": "' . $request->from_email . '",
                    "name":"' . $request->from_name . '"
                },
                "subject": "' . $subject . '",
                "content": [
                    {
                    "type": "text/html",
                    "value": "' . $b . '"
                }
            ]
        }';

                            $ch = curl_init();

                            curl_setopt($ch, CURLOPT_URL, $uri);

                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $request->api_key"));

                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                            curl_setopt($ch, CURLOPT_POST, true);

                            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                            $result = curl_exec($ch);

                            //echo curl_errno($ch);
                            curl_close($ch);

                            if ($result != "") {

                                $res = json_decode($result, true);
                                if (isset($res['error']) || isset($res['errors'])) {
                                    if (isset($res['errors'][0]['message'])) {
                                        return response()->json(['success' => false, 'message' => $res['errors'][0]['message']]);
                                    }

                                }
                            } else {
                                return response()->json(['success' => true, 'message' => 'Email send successfully']);
                            }

                        }
                }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    function document_status(Request $request){
        // $notify_exist->requested_user_view = 0;
        $id = $request->id;
        $status = $request->status;
        $current_date = date('Y-m-d H:i:s');
        if($request->type == 'driving_licences'){
            if($status=='Approved'){
                $driving_licence = DrivingLicence::where('id',$id)->first();
                $driving_licence->driving_licence_status = 'Approved';
                $driving_licence->save();

                $notification = Notification::where('notify_request_id',$id)->update([ 'notify_status' => 'Approved', 'notify_view' =>1, 'requested_user_view' =>0,'notify_status_date' =>$current_date ]);

                $user_meta = UserMeta::where('user_id',$driving_licence->user_id)->update([ 'driving_licence_id' => $id ]);
                return response()->json([ 'success' => true, 'message' => 'Documents approved successfully!' ]);
            }else{
                $driving_licence = DrivingLicence::where('id',$id)->update([ 'driving_licence_status' => 'Rejected' ]);

                $notification = Notification::where('notify_request_id',$id)->update([ 'notify_status' => 'Rejected', 'notify_view' =>1, 'requested_user_view' =>0, 'notify_status_date' =>$current_date ]);
                return response()->json([ 'success' => false, 'message' => 'Documents rejected successfully!' ]);
            }

        }elseif($request->type == 'instructor_licences'){
            if($status=='Approved'){
                $instructor_licences = InstructorLicence::where('id',$id)->first();
                $instructor_licences->instructor_licence_status = 'Approved';
                $instructor_licences->save();

                $notification = Notification::where('notify_request_id',$id)->update([ 'notify_status' => 'Approved', 'notify_view' =>1, 'requested_user_view' =>0, 'notify_status_date' =>$current_date ]);

                $user_meta = UserMeta::where('user_id',$instructor_licences->user_id)->update([ 'instructor_licence_id' => $id ]);

                return response()->json([ 'success' => true, 'message' => 'Documents approved successfully!' ]);
            }else{
                $instructor_licences = InstructorLicence::where('id',$id)->update([ 'instructor_licence_status' => 'Rejected' ]);

                $notification = Notification::where('notify_request_id',$id)->update([ 'notify_status' => 'Rejected', 'notify_view' =>1, 'requested_user_view' =>0, 'notify_status_date' =>$current_date ]);
                return response()->json([ 'success' => false, 'message' => 'Documents rejected successfully!' ]);
            }
        }elseif($request->type == 'wwcc_licences'){
            if($status=='Approved'){
                $wwcc_licences = WwccLicence::where('id',$id)->first();
                $wwcc_licences->wwcc_licence_status = 'Approved';
                $wwcc_licences->verification_date = $current_date;
                $wwcc_licences->save();

                $notification = Notification::where('notify_request_id',$id)->update([ 'notify_status' => 'Approved', 'notify_view' =>1, 'requested_user_view' =>0, 'notify_status_date' =>$current_date ]);

                $user_meta = UserMeta::where('user_id',$wwcc_licences->user_id)->update([ 'wwcc_licence_id' => $id ]);
                return response()->json([ 'success' => true, 'message' => 'Documents approved successfully!' ]);
            }else{
                $wwcc_licences = WwccLicence::where('id',$id)->update([ 'wwcc_licence_status' => 'Rejected','verification_date'=>$current_date ]);

                $notification = Notification::where('notify_request_id',$id)->update([ 'notify_status' => 'Rejected', 'notify_view' =>1, 'requested_user_view' =>0, 'notify_status_date' =>$current_date ]);
                return response()->json([ 'success' => false, 'message' => 'Documents rejected successfully!' ]);
            }
        }else{
            return response()->json([ 'success' => false, 'message' => 'Something wrong!' ]);
        }



        // if($request->status == 'rej') {
        //     InstructorDocs::where('user_id', $request->user_id)->update([ $request->type => 2 ]);
        //     return response()->json([ 'success' => true, 'message' => 'Documents rejected successfully!', 'btn_text' => 'Rejected' ]);
        // }
        // if($request->status == 'app') {
        //     InstructorDocs::where('user_id', $request->user_id)->update([ $request->type => 1 ]);
        //     return response()->json([ 'success' => true, 'message' => 'Documents approved successfully!', 'btn_text' => 'Approved' ]);
        // }
    }

}
