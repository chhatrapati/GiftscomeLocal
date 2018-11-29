<?php
ob_start();
session_start();
require_once 'includes/config.php'; 

//initalize user class
$user_obj = new Cl_User();

/*** Twitter****/
//require_once('twitteroauth/twitteroauth.php');
/*** Twitter****/

/*******Google ******/
require_once 'Google/src/config.php';
require_once 'Google/src/Google_Client.php';
require_once 'Google/src/contrib/Google_PlusService.php';
require_once 'Google/src/contrib/Google_Oauth2Service.php';
/*******Google ******/

/*********Facebook Login **********/
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php' );


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);
$helper = new FacebookRedirectLoginHelper(FB_REDIRECT_URI);
	
if(isset($_GET['type']) && $_GET['type'] == 'facebook' ){
	
	$fb_url = $helper->getLoginUrl(array('email'));
	header('Location: ' . $fb_url);
}

$session = $helper->getSessionFromRedirect();

if(isset($_SESSION['token'])){
	$session = new FacebookSession($_SESSION['token']);
	try{
		$session->validate(FB_APP_ID, FB_APP_SECRET);
	}catch(FacebookAuthorizationException $e){
		echo $e->getMessage();
	}
}

$data = array();

if(isset($session)){
	$_SESSION['token'] = $session->getToken();
	$request = new FacebookRequest($session, 'GET', '/me?fields=name,email');
	$response = $request->execute();
	$graph = $response->getGraphObject(GraphUser::className());

	$data = $graph->asArray();
	$id = $graph->getId();
	$image = "https://graph.facebook.com/".$id."/picture?width=100";
	$data['image'] = $image;
	if($user_obj->fb_login($data)) {  header('Location: my-account.php');}
	else{header('Location: login.php');}
}
/*********Facebook Login **********/

/*******Google ******/

$client = new Google_Client();
$client->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));
$client->setApprovalPrompt('auto');

if(isset($_GET['type']) && $_GET['type'] == 'google' ){
	$authUrl = $client->createAuthUrl();
	header('Location: ' . $authUrl);
}
$plus       = new Google_PlusService($client);
$oauth2     = new Google_Oauth2Service($client);
//unset($_SESSION['access_token']);

if(isset($_GET['code'])) {
	$client->authenticate(); // Authenticate
	$_SESSION['access_token'] = $client->getAccessToken(); // get the access token here 
	header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if(isset($_SESSION['access_token'])) {
	$client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) {
	$_SESSION['access_token'] = $client->getAccessToken();
	$user         = $oauth2->userinfo->get();
	try {
		if($user_obj->google_login( $user )) { header('Location: my-account.php');}
		else { header('Location: login.php');}
	}catch (Exception $e) {
		$error = $e->getMessage();
	}
}
/*******Google ******/