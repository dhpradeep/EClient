<?php

include_once 'mailer/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer {

	public $developmentMode = true;
	public $phpMailer;

	function __construct()
	{
		$this->phpMailer = new PHPMailer($this->developmentMode);
		$this->phpMailer->SMTPDebug = 0;
		$this->phpMailer->isSMTP();
	
		if($this->developmentMode) {
			$this->phpMailer->SMTPOptions = [
				'ssl' => [
					'venrify_peer' => false,
					'venrify_peer_name' => false,
					'allow_self_signed' => true
				]
			];
		}
		$this->phpMailer->Host = 'smtp.gmail.com';
		$this->phpMailer->SMTPAuth = true;
		$this->phpMailer->Username = 'your-username';
		$this->phpMailer->Password = 'your-password';
		$this->phpMailer->SMTPSecure = 'tls';
		$this->phpMailer->Port = 587;
	}

	public function htmlFormatter($fName, $lName,$username,$password)
	{
		$registerConfirmLetter = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="x-apple-disable-message-reformatting"> <title>Registration Confirmation - Eclient</title> <style> html, body { margin: 0 auto !important; padding: 0 !important; height: 100% !important; width: 100% !important; } * { -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } div[style*="margin: 16px 0"] { margin: 0 !important; } table, td { mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; } table { border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important; } table table table { table-layout: auto; } img { -ms-interpolation-mode:bicubic; } a { text-decoration: none; } *[x-apple-data-detectors], /* iOS */ .unstyle-auto-detected-links *, .aBn { border-bottom: 0 !important; cursor: default !important; color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } .a6S { display: none !important; opacity: 0.01 !important; } img.g-img + div { display: none !important; } @media only screen and (min-device-width: 320px) and (max-device-width: 374px) { .email-container { min-width: 320px !important; } } @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { .email-container { min-width: 375px !important; } } @media only screen and (min-device-width: 414px) { .email-container { min-width: 414px !important; } } </style> <style> .button-td, .button-a { transition: all 100ms ease-in; } .button-td-primary:hover, .button-a-primary:hover { background: #555555 !important; border-color: #555555 !important; } @media screen and (max-width: 600px) { .email-container p { font-size: 17px !important; } } </style> </head> <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;"> <center style="width: 100%; background-color: #222222;"> <div style="max-width: 600px; margin: 0 auto;" class="email-container"> <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 auto;"> <tr> <td style="padding: 20px 0; text-align: center"> <p width="100" height="50" style="height: auto;font-family: sans-serif; font-size: 25px;line-height: 15px; color: white;">EClient</p> </td> </tr> <tr> <td style="background-color: #ffffff;"> <img src="https://i.imgur.com/hFb1lml.png" width="600" height="" alt="alt_text" border="0" style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto;" class="g-img"> </td> </tr> <tr> <td style="background-color: #ffffff;"> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"> <h1 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 28px; line-height: 30px; color: #333333; font-weight: normal;font">Registration Confirmation Letter</h1> <br> <p style="margin: 0;">Hello '.$fName.' '.$lName.', <br> Thank you for registering with Eclient. Your request have been approved. Please use following credentials for log in:<br> Username: '.$username.'<br> Password: '.$password.'<br><br> Click on the button below for Log In. </p> </td> </tr> <tr> <td style="padding: 0 20px;"> <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;"> <tr> <td class="button-td button-td-primary" style="border-radius: 4px; background: #222222;"> <a class="button-a button-a-primary" href="http://localhost/eclient/00.final%20site/login.php" style="background: darkblue; border: 1px solid #000000; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;">Log In</a> </td> </tr> </table> <br> </td> </tr> </table> </td> </tr> <tr> <td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;"> &nbsp; </td> </tr> <tr> <td style="background-color: #ffffff;"> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"> <p style="margin: 0;">This email is sent from eversoft.nepal@gmail.com because this email address was registered with eversoft Eclient.</p> </td> </tr> </table> </td> </tr> </table> </div> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #709f2b;"> <tr> <td valign="top"> <div style="max-width: 600px; margin: auto;" class="email-container"> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 18px; line-height: 20px; color: #ffffff;"> <p style="margin: 0;align-content: center;">EClient | Eversoft</p> <p style="margin: 0;align-content: center;">Pokhara, Nepal</p> <p style="margin: 0;align-content: center;">eversoft.nepal@gmail.com</p> <br> <div style="padding: 15px; font-family: sans-serif; font-size: 15px;"></div> <p>Connect with us:</p> <a href="http://eversoftgroup.com/" target="_blank"> <img src="https://i.imgur.com/2RgG57j.png"></a> <a href="https://www.facebook.com/groupofinnovative/" target="_blank"> <img src="https://i.imgur.com/lb8bfMv.png"></a> </div> </td> </tr> </table> </div> </td> </tr> </table> </center> </body></html>';
		return $registerConfirmLetter;
	}

	public function htmlFormatter1($username)
	{
		$letter= '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="x-apple-disable-message-reformatting"> <title>Registration Request Letter - EClient</title> <style> html, body { margin: 0 auto !important; padding: 0 !important; height: 100% !important; width: 100% !important; } * { -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } div[style*="margin: 16px 0"] { margin: 0 !important; } table, td { mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important; } table { border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important; } table table table { table-layout: auto; } img { -ms-interpolation-mode:bicubic; } a { text-decoration: none; } *[x-apple-data-detectors], /* iOS */ .unstyle-auto-detected-links *, .aBn { border-bottom: 0 !important; cursor: default !important; color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } .a6S { display: none !important; opacity: 0.01 !important; } img.g-img + div { display: none !important; } @media only screen and (min-device-width: 320px) and (max-device-width: 374px) { .email-container { min-width: 320px !important; } } @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { .email-container { min-width: 375px !important; } } @media only screen and (min-device-width: 414px) { .email-container { min-width: 414px !important; } } </style> <style> .button-td, .button-a { transition: all 100ms ease-in; } .button-td-primary:hover, .button-a-primary:hover { background: #555555 !important; border-color: #555555 !important; } @media screen and (max-width: 600px) { .email-container p { font-size: 17px !important; } } </style> </head> <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;"> <center style="width: 100%; background-color: #222222;"> <div style="max-width: 600px; margin: 0 auto;" class="email-container"> <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 auto;"> <tr> <td style="padding: 20px 0; text-align: center"> <p width="100" height="50" style="height: auto;font-family: sans-serif; font-size: 25px;line-height: 15px; color: white;">EClient</p> </td> </tr> <tr> <td style="background-color: #ffffff;"> <img src="https://i.imgur.com/zy0fC3P.png" width="600" height="" alt="alt_text" border="0" style="width: 100%; max-width: 600px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto;" class="g-img"> </td> </tr> <tr> <td style="background-color: #ffffff;"> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"> <h1 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 28px; line-height: 30px; color: #333333; font-weight: normal;font">Registration Request Letter</h1> <br> <p style="margin: 0;">Hello '.$username.', <br> Thank you for choosing Eclient. <br> You will shortly receive a confirmation email after our admin verify and approve your request. </p> </td> </tr> <tr> <td style="padding: 0 20px;"> </tr> </table> </td> </tr> <tr> <td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;"> &nbsp; </td> </tr> <tr> <td style="background-color: #ffffff;"> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"> <p style="margin: 0;">This email is sent from eversoft.nepal@gmail.com because this email address was registered with eversoft Eclient.</p> </td> </tr> </table> </td> </tr> </table> </div> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #709f2b;"> <tr> <td valign="top"> <div style="max-width: 600px; margin: auto;" class="email-container"> <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"> <tr> <td style="padding: 20px; text-align: left; font-family: sans-serif; font-size: 18px; line-height: 20px; color: #ffffff;"> <p style="margin: 0;align-content: center;">EClient | Eversoft</p> <p style="margin: 0;align-content: center;">Pokhara, Nepal</p> <p style="margin: 0;align-content: center;">eversoft.nepal@gmail.com</p> <br> <div style="padding: 15px; font-family: sans-serif; font-size: 15px;"></div> <p>Connect with us:</p> <a href="http://eversoftgroup.com/" target="_blank"> <img src="https://i.imgur.com/2RgG57j.png"></a> <a href="https://www.facebook.com/groupofinnovative/" target="_blank"> <img src="https://i.imgur.com/lb8bfMv.png"></a> </div> </td> </tr> </table> </div> </td> </tr> </table> </center> </body></html>';
		return $letter;
	}

	public function sendPendingEmail($fName,$lName,$cName,$cEmail,$username) {
		try{
			$this->phpMailer->setFrom('eversoft.nepal@gmail.com','Eversoft nepal | EClient');
			$this->phpMailer->addAddress($cEmail,$fName . " " . $lName);
			$this->phpMailer->isHTML(true);
			$this->phpMailer->Subject = "Company registration notice";
			$this->phpMailer->Body = $this->htmlFormatter1($username);
			$this->phpMailer->send();
			$this->phpMailer->ClearAllRecipients();
			return true;
			}catch(Exception $e){
				return false; 
			}
		}

	public function sendApprovedMail($fName,$lName,$cName,$cEmail,$username,$password) {
		try{
			$this->phpMailer->setFrom('eversoft.nepal@gmail.com','Eversoft nepal | EClient');
			$this->phpMailer->addAddress($cEmail,$fName . " " . $lName);
			$this->phpMailer->isHTML(true);
			$this->phpMailer->Subject = "Company approved notice";
			$this->phpMailer->Body = $this->htmlFormatter($fName,$lName,$username,$password);
			$this->phpMailer->send();
			$this->phpMailer->ClearAllRecipients();
				return true;
			}catch(Exception $e){
				return false;
			}
		}

	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function sendSMS($content)
	{
	   $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://sms.nepalsms.com/api/v3/sms?");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$content);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			curl_close ($ch);
			return $server_output;
	}

	public function sendPhoneSMS($fName,$lName,$company_full_name,$username,$password,$phone)
	{
		$token = 'your-token';
        $to = $phone;
        $sender    = 'EClient';
        $message = 'Hello '.$fName.' '.$lName.', Thanks for register your company '.$company_full_name.'. You can login by using following credentials. Username: '.$username.'  Password: '.$password.'.';
        // set post fields
        $content =[
        'token'=>rawurlencode($token),
        'to'=>rawurlencode($to),
        'sender'=>rawurlencode($sender),
        'message'=>$message,
		];
        $this->sendSMS($content);
	}

	public function company_approved($id)
	{
		$data = new Data();
		$query = "SELECT * FROM company_temp WHERE ID=?";
		$params = array($id);
		$data = $data->getmultipledata($query,$params);
		$data = $data->_results;
		foreach($data as $da)
		{
			$ID =  $da->ID;
			$fName =  $da->fName;
			$lName =  $da->lName;
			$company_full_name =  $da->company_full_name;
			$company_email_address =  $da->company_email_address;
			$username = $da->username;
			$phone = $da->phone;
			$password = $this->generateRandomString(8);
			$approvalResult = $this->sendApprovedMail($fName,$lName,$company_full_name,$company_email_address,$username,$password);
			if($approvalResult){
				
				//send phone message here...
				$sendSMSVerify = $this->sendPhoneSMS($fName,$lName,$company_full_name,$username,$password,$phone);

				//user registration here..
				$user = new User();
				try { 
					$user->create('users',array(
						'fName' => $fName, 
						'lName' => $lName,
						'username' => $username,
						'email' => $company_email_address,
						'password' => $password,
						'phone' => $phone,
						'role' => 'company',
						'related_company' => $ID,
					));
					return true;
				} catch(Exception $e) {
					return false;
				}
			}
		}
	}

	public function sendModuleMail($projectID,$module_title,$assign_to)
	{
		$data = new Data();
		$query = "SELECT project_name FROM project WHERE ID=?";
		$params = array($projectID);
		$data = $data->getmultipledata($query,$params);
		$data = $data->_results;
		foreach($data as $da)
		{
			$projectName = $da->project_name;
		}
		$data1 = new Data();
		$query = "SELECT fName,lName,email FROM users WHERE username=?";
		$params = array($assign_to);
		$data1 = $data1->getmultipledata($query,$params);
		$data1 = $data1->_results;
		foreach($data1 as $da)
		{
			$fName = $da->fName;
			$lName = $da->lName;
			$email = $da->email;
		}
		try{
			$this->phpMailer->setFrom('eversoft.nepal@gmail.com','Eversoft nepal | EClient');
			$this->phpMailer->addAddress($email,$fName . " " . $lName);
			$this->phpMailer->isHTML(true);
			$this->phpMailer->Subject = "New module assign for $projectName project.";
			$this->phpMailer->Body = "Hello $fName $lName. You've just assign new module called ' $module_title ' for the $projectName project.";
			$this->phpMailer->send();
			$this->phpMailer->ClearAllRecipients();
				return true;
			}catch(Exception $e){
				return false;
		}
	}
}

