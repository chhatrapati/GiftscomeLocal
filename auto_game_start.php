<?php
session_start();
//error_reporting(0);
include('includes/config.php');
$user_obj = new Cl_User();
//$game_id=$_POST['game_id'];
$user_obj->auto_start_game();
//echo 'done';
?>