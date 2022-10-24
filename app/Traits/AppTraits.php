<?php
namespace App\Traits;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

trait AppTraits
{

    static function SendgridEmail($body, $to, $subject, $from_name, $to_name, $from_email, $apikey)
    {
        $str = trim(preg_replace('/\s+/', " ", $body));
        $b = preg_replace("/\"/", "\\\"", $str);
        //$b.="<img src='route(open-tracking) ' style ='display:none; width:1px;' />";
        $subject = preg_replace("/\"/", "\\\"", $subject);
        $uri = 'https://api.sendgrid.com/v3/mail/send';
        $json = '{
            "personalizations": [
                    {
                        "to": [{
                                "email": "' . $to . '",
                                "name":"' . $to_name . '"
                        }]
                    }
                ],
                "from": {
                    "email": "' . $from_email . '",
                    "name":"' . $from_name . '"
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
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $apikey"));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        //echo curl_errno($ch);
        curl_close($ch);
        return $result;
    }

    static function SmtpEmail($body, $to, $subject, $from_name, $to_name, $username, $password, $server, $port, $from_email = null, $ssl = null, $account_id=null)
    {
        try {

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            //$mail->SMTPDebug = 2;
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;

            if ($ssl == 'yes') {
                $mail->SMTPSecure = 'ssl';    // Enable TLS encryption, `ssl` also accepted
            }

            $mail->Port = $port;     // TCP port to connect to
            $mail->SMTPOptions = array('ssl' => array('verify_host' => false, 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            if ($from_email != null) {
                $mail->setFrom($from_email, $from_name);
            } else {
                $mail->setFrom($username, $from_name);
            }

            $mail->addAddress($to, $to_name); // Add a recipient

            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            if (!$mail->send()) {
                return $mail->ErrorInfo;
            } else {
                return true;
            }
        } catch (Exception $e) {
            $res['errors'][0]['message'] = $e->getMessage();
            return json_encode($res);
        }
    }
}
