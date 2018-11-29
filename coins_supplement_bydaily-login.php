<?php
session_start();
//error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$sql12=  mysqli_query($con,"select * from coins_transfer_value where user_type='normal'")or die(mysqli_error());
$data123=mysqli_fetch_array($sql12,MYSQLI_ASSOC);
$daily_gift_coins = $data123['gift_coins'];
$id_user=$_POST['id_user'];
$user_type= $user_obj->user_type($id_user);
/*Count no of times daily login coins requested by user*/
$cur_date= date("Y-m-d");
$sql_98=  mysqli_query($con,"SELECT * FROM user_wallet  WHERE user_id='$id_user' AND reason_mode_of_coins='By Redeem Daily Login Giftcoins' AND date_of_coins_get='$cur_date' ");
$no_of_daily_login_req = mysqli_num_rows($sql_98);
if($user_type=='normal')
{
if($no_of_daily_login_req<=0)
{
$user_obj->coins_by_daily_login_request();
echo '<div class="alert alert-success">Congrats, you have received your daily log in rewards of '.$daily_gift_coins.' coins<button type="button" class="close" data-dismiss="alert">×</button></div>';
}
else
{
 echo '<div class="alert alert-danger">You have already requested daily login giftcoins.<button type="button" class="close" data-dismiss="alert">×</button></div>';
}
}
else
{
echo '<div class="alert alert-danger">VIP users automatically get their daily login rewards.<button type="button" class="close" data-dismiss="alert">×</button></div>';
}
?>
<script>
 $(document).ready(function(){
        setTimeout(function() {
         $('#msg_1').fadeOut('fast');
		 $('#successMessage').fadeOut('fast');
        }, 5000);
    });
</script>