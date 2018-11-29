<?php
$config['db']['host'] = 'localhost';
$config['db']['name'] = 'giftscome_live';
$config['db']['user'] = 'root';
$config['db']['pass'] = '';
$config['db']['pre'] = '';

$config['facebook_app_id']      = '';
$config['facebook_app_secret']  = '';
$config['facebook_call_backurl']  = '';
$config['google_app_id']        = '';
$config['google_app_secret']    = '';
$config['google_call_backurl']  = '';

$config['site_url'] = 'http://localhost/gclive/';

session_start();

// Create connection in MYsqli
$con = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
// Check connection in MYsqli
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


?>