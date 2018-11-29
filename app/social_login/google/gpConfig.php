<?php
require_once('../../config.php');

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */

$clientId = $config['google_app_id']; //Google client ID
$clientSecret = $config['google_app_secret']; //Google client secret
$redirectURL = $config['google_call_backurl']; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to Zechat');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>