<?php
session_start();
require_once('includes/config.php');
 $member_email = $_SESSION['email'];   
if($_POST['is_submit'] == 'yes'){
if ($_POST['c1']) {
foreach ( $_POST['c1'] as $key=>$value ) {
$values = mysqli_real_escape_string($con,$value);
$query = mysqli_query($con,"INSERT INTO referral (sender,receiver_email) VALUES ('$member_email','$values')");
// echo "<i><h2><strong>" . count($_POST['c1']) . "</strong> Refer Send To </h2></i>";
echo "<br>";
$member_id_encode=base64_encode($member_id);

echo $refurl="http://giftscome.codechefs.com";

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
$message .= '<h1 style="color:#f40;">Thank You!</h1>';
$message .= '<p style="color:#080;font-size:18px;"><a href="'.$refurl.'"> Use This Link To Join Giftscome & Get Free Coins And Reedme Gifts. </a></p>';
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






