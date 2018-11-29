<?php
session_start();
require_once('includes/config.php');

 $member_id = $_SESSION['id'];
   

if($_POST['is_submit'] == 'yes'){
if ($_POST['c1']) {
foreach ( $_POST['c1'] as $key=>$value ) {
$values = mysqli_real_escape_string($con,$value);
$query = mysqli_query($con,"INSERT INTO referral (sender,receiver_email) VALUES ('$member_id','$values')");
echo "<i><h2><strong>" . count($_POST['c1']) . "</strong> Refer Send To Friends</h2></i>";


$member_id;
echo "<br>";
$member_id_encode=base64_encode($member_id);
echo "<br>";
 $to = $values;
$subject = 'Refer code send';
$from = 'kangnarender@gmail.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<h1 style="color:#f40;">Hi Jane!</h1>';
$message .= '<p style="color:#080;font-size:18px;"><a href="/token=$member_id_encode">/token=$member_id_encode</a></p>';
$message .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}
}
}
}






