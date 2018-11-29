<?php
session_start();
require_once('includes/config.php');
function checkUser($email)
{
	global $con;
	$query = mysqli_query($con, "SELECT id FROM users WHERE email = '$email'");
	if(mysqli_num_rows($query) > 0)

	{

		return 'true';

	}else

	{

		return 'false';

	}

}
function UserID($email)

{

	global $con;
	$query = mysqli_query($con, "SELECT id FROM users WHERE email = '$email'");
	$row = mysqli_fetch_array($query);
	return $row['id'];

}
function generateRandomString($length = 20) {

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $charactersLength = strlen($characters);

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];

    }

    return md5($randomString);

}


// function send_mail($to, $token)

// {
// $link = 'http://giftscome.com.cp-28.hostgatorwebservers.com/forget.php?email='.$to.'&token='.$token;
// $subject = 'Recover Your Password';
// $msg ='<b>Hello</b><br><br>You have requested for your password recovery. <a href='.$link.' target="_blank">Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>"'. $link.'"</i></p>';
// $user_obj->send_email($to,$subject,$msg);

// }

function send_mail($to, $token)

{

require_once('PHPMailer/class.phpmailer.php');

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'mail.giftscome.com.cp-28.hostgatorwebservers.com';
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = 'info@giftscome.com.cp-28.hostgatorwebservers.com';
$mail->Password = 'Codechefs@2018';
$mail->isHTML(true);

//$message    = "<b>Hello</b><br><br>You have requested for your password recovery. <a href='$link' target='_blank'>Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>". $link."</i>";
// Compose a simple HTML email message
$link = 'http://giftscome.com.cp-28.hostgatorwebservers.com/forget.php?email='.$to.'&token='.$token;

$mailContent = '<html><body>';

$mailContent .= '<b>Hello</b><br><br>You have requested for your password recovery. <a href='.$link.' target="_blank">Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>"'. $link.'"</i>';

$mailContent .= '</body></html>';


$mail->setFrom("info@giftscome.com.cp-28.hostgatorwebservers.com","Giftscome");
$mail->addAddress($to);
$mail->Subject = 'Recover Your Password';
$mail->msgHTML($mailContent);
$mail->Body = ($mailContent);
// Success or Failure



if(!$mail->send()){
	
	return 'fail';
	
	}else{
		
return 'success';
		
	}
}


function verifytoken($userID, $token)
{	
	global $con;
	$query = mysqli_query($con, "SELECT valid FROM recovery_keys WHERE userID = $userID AND token = '$token'");

	$row = mysqli_fetch_array($query);
	if(mysqli_num_rows($query) > 0)

	{

		if($row['valid'] == 1)

		{

			return 1;

		}else

		{

			return 0;

		}

	}else

	{

		return 0;

	}
}

?>