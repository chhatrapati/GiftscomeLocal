<?php

// Copyright (C) 2015-17 bylancer. All rights reserved.


// ***** Chat Setting ****************************************************************


/**
 * Session Variable
 * You can change $_SESSION['user'] and $_SESSION['id']
 * with your session variable.
 * Example : $sesUsername   = $_SESSION['user']['username'];
 * Example : $sesId         = $_SESSION['user']['id'];
 */
if(isset($_SESSION['id'])){
    $sesUsername    = $_SESSION['username'];
    $sesId          = $_SESSION['id'];
}

/**
 * You Can set your own timezone here.
 * Example : Asia/Kolkata
 */
date_default_timezone_set('Asia/Kolkata');
$date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
$timenow = date('Y-m-d H:i:s');

/**
 * Change Mysqli variable if you want to use
 * your own site userdata table
 * Example : $MySQLi_user_table_name = 'my_website_user_table_name';
 */


// Enter MySQLi user table information
$MySQLi_user_table_name = 'userdata';


/**
 * Enter the field name of user data in MySQLi database
 * Note : Edit only if you want to use your own website user table
 * Example : $MySQLi_userid_field    = 'your_table_userid_field_name';
 */
$MySQLi_userid_field    = 'id';         // This Field for unique user id must be unique
$MySQLi_status_field    = 'status';     // This field must be enum('0', '1', '2') because we are using this field for block/active user
$MySQLi_username_field  = 'username';   // This Field for unique username must be unique
$MySQLi_password_field  = 'password';   // For User password using for login and register
$MySQLi_email_field     = 'email';      // For User email
$MySQLi_fullname_field  = 'name';       // For User fullname
$MySQLi_joined_field    = 'joined';     // This field for when user is register in your website
$MySQLi_country_field   = 'country';    // For User Country Name
$MySQLi_about_field     = 'about';      // For User status or about user. using as whatsapp like user status
$MySQLi_sex_field       = 'sex';        // For User Gender
$MySQLi_dob_field       = 'dob';        // For User Date of birth
$MySQLi_photo_field     = 'picname';    // For User Date of birth
$MySQLi_online_field    = 'online';     // for user online/offline  1,0  last_active_timestamp
$MySQLi_last_active_field    = 'last_active_timestamp';     // for last_active_timestamp


function get_userdata($con,$config,$username){
    $TNMuser       = $GLOBALS['MySQLi_user_table_name'];
    $TFusername    = $GLOBALS['MySQLi_username_field'];

    $query1 = "SELECT * FROM `".$config['db']['pre'].$TNMuser."` WHERE $TFusername='" .mysqli_real_escape_string($con,$username). "' LIMIT 1";
    $query_result = mysqli_query ($con, $query1) OR error(mysqli_error($con));
    $info = mysqli_fetch_array($query_result);

    return $info;
}

function update_lastactive($con,$config){
    $TNMuser       = $GLOBALS['MySQLi_user_table_name'];
    $TFuserid      = $GLOBALS['MySQLi_userid_field'];
    $TFonline       = $GLOBALS['MySQLi_online_field'];
    $TFlastactive    = $GLOBALS['MySQLi_last_active_field'];

    mysqli_query($con, "UPDATE `".$config['db']['pre'].$TNMuser."` SET $TFonline='1', $TFlastactive = '".$GLOBALS['timenow']."' WHERE $TFuserid = '".$GLOBALS['sesId']."' ");
}

function getlastActiveTime($con,$config,$username){

    $TNMuser       = $GLOBALS['MySQLi_user_table_name'];
    $TFusername    = $GLOBALS['MySQLi_username_field'];
    $TFlastactive    = $GLOBALS['MySQLi_last_active_field'];

    $res = mysqli_query($con, "SELECT * FROM `".$config['db']['pre'].$TNMuser."` WHERE $TFusername='$username' AND TIMESTAMPDIFF(MINUTE, $TFlastactive, NOW()) > 1;");
    if($res === FALSE) {
        die(mysqli_error($con)); // TODO: better error handling
    }
    $num = mysqli_num_rows($res);
    if($num == "0")
        $onofst = "Online";
    else
        $onofst = "Offline";

    return $onofst;
}
?>