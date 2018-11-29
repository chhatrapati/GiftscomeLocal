<?php
session_start();
//error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
$uid = $_SESSION['id'];
$row = $user_obj->user_detail_byid($uid);
$id = $row['id'];
$user_type = $row['user_type'];
$gift_coins_balance =$row['gift_coins'];
/*Code of fetch how many time users have get coins in day*/
$result_data = $user_obj->times_of_coins_get($id);
$no_of_coins_get = $result_data['COUNT(1)'];

/*Code of fetch coins supplement details on request to admin by user id*/
$data123 = $user_obj->coins_supplement_details($user_type);
$minimum_gift_coins_value = $data123['minimum_gift_coins_value'];
$no_val = $data123['daily_click_button_limit'];
$gift_coins_value = $data123['gift_coins_value'];
/*Check user's login time*/
$ss=  mysqli_query($con,"SELECT logindate FROM userlog  WHERE user_id='$uid' order by loginTime desc limit 1");
$result_data = mysqli_fetch_assoc($ss);
$logindate = $result_data['logindate'];
$cur_date= date("Y-m-d");
if(($gift_coins_balance <= $minimum_gift_coins_value) AND $no_of_coins_get < $no_val)
{
$user_obj->coins_by_request_to_admin();

echo '<div class="alert alert-success">Congrats, you have received rewards of '.$gift_coins_value.' giftcoins.	<button type="button" class="close" data-dismiss="alert">×</button></div>';
}
else if($no_of_coins_get >= $no_val)
{
 echo '<div class="alert alert-danger">You have already requested coins.<button type="button" class="close" data-dismiss="alert">×</button></div>';
}
else if($gift_coins_balance > $minimum_gift_coins_value)
{
 echo '<div class="alert alert-danger">Your coins balance is not drop to '.$minimum_gift_coins_value.'.<button type="button" class="close" data-dismiss="alert">×</button></div>';
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