<?php
$mysql_hostname = "giftscome.db.11878407.c13.hostedresource.net";
$mysql_user = "giftscome";
$mysql_password = "Gift#2018";
$mysql_database = "giftscome";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database)
or die("Oops some thing went wrong");

//require_once 'messages.php';

//site specific configuration declartion
define( 'BASE_PATH', 'http://giftscome.codechefs.com/login.php');
define( 'DB_HOST', 'giftscome.db.11878407.c13.hostedresource.net' );
define( 'DB_USERNAME', 'giftscome');
define( 'DB_PASSWORD', 'Gift#2018');
define( 'DB_NAME', 'giftscome');


//Facebook App Details
define('FB_APP_ID', '482841608779740');
define('FB_APP_SECRET', '350adeb8e038cb0f34ff76e59457f629');
define('FB_REDIRECT_URI', 'http://giftscome.codechefs.com/login-account.php');




//Google App Details
define('GOOGLE_APP_NAME', 'Login Google');
define('GOOGLE_OAUTH_CLIENT_ID', '72643637179-oehtb7lr2rtlicokcvejdshd4u4vc967.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', '3LDNYCHmWacBgtH27QUCVuhF');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://giftscome.codechefs.com/login-account.php');
define("GOOGLE_SITE_NAME", 'Social Login'); 


//Twitter login
//define('TWITTER_CONSUMER_KEY', 'YOUR_CONSUMER_KEY');
//define('TWITTER_CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET');
//define('TWITTER_OAUTH_CALLBACK', 'YOUR_OAUTH_CALLBACK');



function __autoload($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}

?>