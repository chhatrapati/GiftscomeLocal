<?php
error_reporting(1);
require_once('includes/config.php');
if (isset($_GET["id"])) {
  $id=$_GET['id'];
  $a="select receiver_email from referral where sender='".$id."'";
  $result = mysqli_query($con,$a) or die(mysqli_error($con));
  $row = mysqli_fetch_array($result, MYSQLI_BOTH); 
    $receiver_email=$row['receiver_email'];
	$abc = mysqli_query($con,"select COUNT(receiver_email) from referral where sender ='$id'");
  $count = mysqli_num_rows($abc);
  if($count >= 1){
 $msg = "Your have already Recieve Coins.";
  $msgType =  "info";
		}
     else {
        $sql = mysqli_query($con, "UPDATE `referral` SET  `status` =  'approved' WHERE `sender` = '$id'");
	    $qr = mysqli_query($con, "UPDATE `users` SET `gift_coins` = gift_coins + 10 WHERE `id` = '$id'");
       $msg = "Your account has been activated.";
       $msgType =  "success";
       
      }
    }
?>
<?php
 require_once('templates/header.php');
?>
<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<?php require_once('templates/common_css.php');?>
	<style>
	.box {
  position: relative;
  
  padding: 30px 10px 5px;
  width: 100%;
  min-height: 150px;
  border: 1px solid #08a6cc;
  border-radius: 3px;
  background: #fff;
}

.editable {
  border-color: #bd0f18;
  box-shadow: inset 0 0 10px #555;
  background: #f2f2f2;
}

.text {
  outline: none;
}

.edit, .save {
  width: 50px;
  display: block;
  position: absolute;
  top: 7px;
  right: 7px;
  padding: 4px 10px;
  border-top-right-radius: 2px;
  border-bottom-left-radius: 10px;
  text-align: center;
  cursor: pointer;
  box-shadow: -1px 1px 4px rgba(0,0,0,0.5);
}

.edit { 
  background: #557a11;
  color: #f0f0f0;
  opacity: 0;
  transition: opacity .2s ease-in-out;
  padding-right:3%;
}

.save {
  display: none;
  background: #bd0f18;
  color: #f0f0f0;
}

.box:hover .edit {
  opacity: 1;
}
.s-text13:hover{
	color:#08a6cc;
	
}
.s-text14{
	color:#08a6cc;
	
}
.m-text3 {
    font-family: Montserrat-Regular;
    font-size: 13px;
    color: white;
    text-transform: uppercase;
}
.size2 {
    width: 90%;
    height: 34px;
	margin-right:1px;
}
.bg1 {
    background-color: #08a6cc;
}
.bg1:hover{
	 background-color:#000;
}
.p-b-50 {
    padding-bottom: 135px;
}
.box:hover {
  box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
</style>
</head>
<body class="animsition">
<?php if ($msg <> "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>
<?php require_once('templates/footer.php');?>
<?php require_once('templates/common_js.php');?>
</body>
</html>