<?php
require_once('app/config.php');
if(isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$error = "";
function getLocationInfoByIp(){
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = @$_SERVER['REMOTE_ADDR'];
    $result  = array('country'=>'', 'city'=>'');
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else{
        $ip = $remote;
    }
    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result['code'] = $ip_data->geoplugin_countryCode;
        $result['country'] = $ip_data->geoplugin_countryName;
        $result['city'] = $ip_data->geoplugin_city;
    }
    return $result;
}
/*$countryIP = getLocationInfoByIp();
$countrycode = $countryIP['code'];
$countryname = $countryIP['country'];*/

$countrycode = "IN";
$errors = array();

if(isset($_POST['signup']))
{
    function validStrLen($str, $min, $max,$con,$config){
        $len = strlen($str);
        if($len < $min){
            return "Username is too short, minimum is $min characters ($max max)";
        }
        elseif($len > $max){
            return "Username is too long, maximum is $max characters ($min min).";
        }
        elseif(!preg_match("/^[a-zA-Z0-9]+$/", $str))
        {
            return "Username with only numbers and letters";
        }
        else{
            //get the username
            $username = mysqli_real_escape_string($con, $_POST['username']);

            //mysql query to select field username if it's equal to the username that we check '
            $result = mysqli_query($con, "select username from `".$config['db']['pre']."userdata` where username = '". $username ."'");

            //if number of rows fields is bigger them 0 that means it's NOT available '
            if(mysqli_num_rows($result)>0){
                //and we send 0 to the ajax request
                return "Error: Username not available";
            }
        }
        return TRUE;
    }

    $errors['username'] = validStrLen($_POST['username'], 4, 10,$con,$config);




    if($errors['username'] == 1)
    {

            /*$time = date('Y-m-d H:i:s', time());*/
            $query = "insert into `".$config['db']['pre']."userdata` set name='" . $_POST['name'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', password='" . $_POST['password'] . "', joined = NOW(), country='$countrycode', last_active_timestamp = NOW() ";
            $query_result = $con->query($query);

            $user_id = $con->insert_id;
            $username = $_POST['username'];
            if (isset($user_id)) {
                $_SESSION['id'] = $user_id;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit;
            } else {
                $error = "Error: Username & Password do not match";
            }

    }

}
if(isset($_POST['login']))
{
    $query = "SELECT id,username,password,status FROM `".$config['db']['pre']."userdata` WHERE username='" . $_POST['username'] . "' AND password='" . md5($_POST['password']) . "' LIMIT 1";
    $query_result = mysqli_query($con,$query);
    $row_count = mysqli_num_rows($query_result);
    if($row_count>0){
        $info = mysqli_fetch_array($query_result);
        $user_id = $info['id'];
        $username = $info['username'];
        $status = $info['status'];
        if($status != 2)
        {
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $query2 = mysqli_query($con, "update `".$config['db']['pre']."userdata` set online = 1 where id = '".$_SESSION['id']."'");

            $res = mysqli_query($con, "UPDATE `".$config['db']['pre']."userdata` SET online=1, last_active_timestamp = NOW() WHERE id = {$_SESSION['id']};");

            echo '<script type="text/javascript"> window.location = "index.php" </script>';
            exit;
        }
        else
        {
            if($info['status'] == 2)
                $error = 'ACCOUNTBAN';
            else
                $error = 'USERNOTFOUND';
        }
    }
    else
    {
        $error = 'USERNOTFOUND';
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="assets/img/favicon.png" type="image/png" sizes="16x16">
    <meta name="keywords" content="php chat script, php ajax Chat,facebook similar chat, php mysql chat, chat script, facebook style chat script, gmail style chat script. fbchat, gmail chat, facebook style message inbox, facebook similar inbox, facebook like chat" />
    <meta name="description"  content="This jQuery chat module easily to integrate Gmail/Facebook style chat into your existing website." />
    <meta name="author" content="Zechat - Codentheme.com">
    <link rel="icon" href="assets/img/favicon.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="assets/css/loginstyle.css" type="text/css" />


</head>

<body class="login">
<!-- header starts here -->
<div id="facebook-Bar">
    <div id="facebook-Frame">
        <div id="logo">
            <img src="assets/img/logo.png" alt="[logo:ZeChat]" />
        </div>
        <div id="header-main-right">
            <div id="header-main-right-nav">
                <form method="post" action="#" id="login_form" name="login_form">
                    <table border="0" style="border:none">

                        <tr>
                            <td >
                                <input type="text" tabindex="2" id="username" value="" name="username" class="inputtext radius1" >
                            </td>
                            <td ><input type="password" tabindex="2" id="pass" value="1234" name="password" class="inputtext radius1" ></td>
                            <td ><input type="submit" class="fbbutton" name="login" value="Login" /></td>
                        </tr>
                        <tr>
                            <td colspan="3"><label><span style="color:#ccc;">Login for testing
                                        <span style="color:#df6c6e;">
                                            <?php
                                            if(!empty($error)){
                                                echo "( ".$error." )";
                                            }
                                            ?>
                                        </span></span></label>
                            </td>

                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- header ends here -->

<div class="loginbox radius">
    <h2 style="color:#141823; text-align:center;">Welcome to Zechat</h2>
    <div class="loginboxinner radius">
        <div class="loginheader">
            <h4 class="title">Connect with friends and the world around you.</h4>

        </div><!--Featuresheader-->
        <div class="social-signup">
            <div style="padding: 20px">
                <button class="loginBtn loginBtn--facebook" onclick="fblogin()">Login with Facebook</button>
                <button class="loginBtn loginBtn--google" onclick="gmlogin()">Login with Google</button>
            </div>
            <div class="clear"></div>
        </div>
        <div class="loginform">

            <form id="login" action="" method="post" enctype="multipart/form-data">
                <p>
                    <input type="text" id="name" name="name" placeholder="Full Name" value="" class="radius"  required/>
                </p>
                <p>
                    <input type="text" id="username" name="username" placeholder="Username" value="" class="radius" required/>
                </p>
                <p>
                    <input type="email" id="email" name="email" placeholder="Your Email" class="radius" required/>
                </p>
                <p>
                    <input type="password" id="password" name="password" placeholder="Set A Password" class="radius" required/>
                </p>
                <br>
                <p>
                    <button class="radius title" id="signup-button" type="submit" name="signup">Sign Up for Zechat</button>
                </p>
            </form>
        </div><!--loginform-->
        <h4 class="title" style="color: red"><?php
            if(!empty($errors)){
                echo $errors['username']; // <--
            }
            ?></h4>


    </div><!--Featuresboxinner-->
</div><!--Featuresbox-->

<br>
<br>
</center>
</div>
<script>
    function validate() {
        if (document.myForm.name.value == "") {
            alert("Enter a name");
            document.myForm.name.focus();
            return false;
        }
        if (!/^[a-zA-Z]*$/g.test(document.myForm.name.value)) {
            alert("Invalid characters");
            document.myForm.name.focus();
            return false;
        }
    }

</script>


<script type="text/javascript">
    var w=640;
    var h=500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    function fblogin()
    {
        var newWin = window.open("app/social_login/facebook/index.php", "fblogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,display=popup, width='+w+', height='+h+', top='+top+', left='+left);
    }

    function gmlogin()
    {
        var newWin = window.open("app/social_login/google/index.php", "gmlogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }

    $(document).ready(function() {

        $('#button').click(function(e) { // Button which will activate our modal

            $('.modal').reveal({ // The item which will be opened with reveal

                animation: 'fade',                   // fade, fadeAndPop, none

                animationspeed: 600,                       // how fast animtions are

                closeonbackgroundclick: true,              // if you click background will modal close?

                dismissmodalclass: 'close'    // the class of a button or element that will close an open modal

            });

            return false;

        });

    });

</script>

</body>

</html>