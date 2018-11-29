<?php
include('includes/function.php');
/**
 * This User will have functions that hadles user registeration,
 * login and forget password functionality
 * @author muni
 * @copyright www.smarttutorials.net
 */
class Cl_User
{
	/**
	 * @var will going contain database connection
	 */
	protected $_con;
	
	/**
	 * it will initalize DBclass
	 */
	public function __construct()
	{
		$db = new Cl_DBclass();
		$this->_con = $db->con;
	}
	
	/**
	 * this will handles user registration process
	 * @param array $data
	 * @return boolean true or false based success 
	 */
	public function registration( array $data )
	{
		if( !empty( $data ) ){
			
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data); //echo '<pre>'; print_r($trimmed_data);
			// escape variables for security
			$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			//$username = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			//$uname = preg_replace('/\s+/', '', $username);
			$nick_name = mysqli_real_escape_string( $this->_con, $trimmed_data['nick_name'] );
			if($nick_name=='')
			{
				$new_nick_name = 'lazygamer'.mt_rand(0,10000).''; //echo $new_nick_name; die();
			}
			else
			{
				$new_nick_name = $nick_name; //echo $nick_name; die();
			}
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = mysqli_real_escape_string( $this->_con, $trimmed_data['confirm_password'] );
			$gender = mysqli_real_escape_string( $this->_con, $trimmed_data['gender'] );
			$address = mysqli_real_escape_string( $this->_con, $trimmed_data['address'] );
			$contact_no = mysqli_real_escape_string( $this->_con, $trimmed_data['contact_no'] );
			/*refereal code of friend*/
			$ref_by_code = mysqli_real_escape_string($this->_con, $trimmed_data['ref_code']);
			if($ref_by_code !='')
			{
			$user_id_by_ref= $this->user_by_refcode($ref_by_code); /*User id of friend which referal code is used*/
			}
			else
			{
			$user_id_by_ref='';
			}
			$file = $_FILES['file']['name'];
			/*Generate referal code for user*/
			$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$res = "";
			for ($i = 0; $i < 4; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$result = substr($name, 0, 4);
			$rel_lo =strtoupper($result);
			$referal_code = $rel_lo . '_' . $res;
			/*End of Generate referal code for user*/
			// Check for an email address:
			if (filter_var( $trimmed_data['email'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email']);
			} else {
				throw new Exception( "Please enter a valid email address!" );
			}
			
			if((!$name) || (!$email) || (!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "INSERT INTO users (id, name, username, nick_name, email, password, contactno, gender, shippingAddress, user_picture,referal_code,refer_by, regDate) VALUES (NULL, '$name', '$new_nick_name', '$new_nick_name', '$email', '$password', '$contact_no', '$gender', '$address', '$file','$referal_code', '$user_id_by_ref', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query)) 
			$last_id = mysqli_insert_id($this->_con);
		    $this->coins_by_register($last_id);
			$result = $this->get_points_supplement();
			$points_by_register = $result['points_by_register'];
			$this->set_user_points($last_id,$points_by_register,'By Register');
			$this->set_points_users($last_id);
			/*Gift coins supplement to both users , one which is using referal code of other friend and one which refer their code to user */
			if($ref_by_code !='')
			{
				$this->coins_using_refercode_reg($last_id);
				$this->coins_by_refer_friend($user_id_by_ref);
			}
            return true;
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}
	/**
	 * This method will handle user login process
	 * @param array $data
	 * @return boolean true or false based on success or failure
	 */
	public function login( array $data )
	{
		$_SESSION['login'] = false;
		if( !empty( $data ) ){
			
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
			$password = mysqli_real_escape_string( $this->_con,  $trimmed_data['password'] );
			$url = mysqli_real_escape_string( $this->_con,  $trimmed_data['url'] );
				
			if((!$email) || (!$password) ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			$password = md5( $password );
			$query = "SELECT id, name, username,status, online, email, regDate, user_type FROM users where email = '$email' and password = '$password' and is_active =1 ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result); //print_r($data); die();
			$uid = $data['id'];
			$name = $data['username'];
			$status = $data['status'];
			$online = $data['online'];
			$count = mysqli_num_rows($result); //echo $count; die();
			if( $data >= 1){
			$_SESSION['UserEmail'] = $email;
			$_SESSION['url'] = $url;
			$_SESSION['username'] = $name;
			$uip=$_SERVER['REMOTE_ADDR'];
			$status=1;
			$log=mysqli_query($this->_con, "insert into userlog(user_id,userEmail,userip,status) values('$uid','".$_SESSION['UserEmail']."','$uip','$status')");
			$query2 = mysqli_query($this->_con, "update `users` set online = 1 where id = '".$uid."'");
            $res = mysqli_query($this->_con, "UPDATE `users` SET online=1, last_active_timestamp = NOW() WHERE id = {$uid};");
			}
			else
			{
			$uip=$_SERVER['REMOTE_ADDR'];
			$status=0;
			$log=mysqli_query($this->_con, "insert into userlog(userEmail,userip,status) values('".$email."','$uip','$status')");
			}
			if( $count >= 1){
				$_SESSION = $data; //print_r($_SESSION); die();
				$_SESSION['login'] = true; //print_r($_SESSION['login']); die();
				$_SESSION['url'] = $url;
				$_SESSION['username'] = $name;
				$this->coins_by_login();
				$result = $this->get_points_supplement();
			    $points_by_login = $result['points_by_login'];
				$this->set_user_points($uid,$points_by_login,'By Login');
				$this->set_points_users($uid);
				return true;
				
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		} else{
			throw new Exception( LOGIN_FIELDS_MISSING );
		}
	}
	
	/**
	 * This method will handle Facebook login
	 * @param array $data
	 * @throws Exception
	 * @return boolean true or false based on success or failure
	 */
	
	public function fb_login( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			//print_r($trimmed_data); die();
		}	
		
		// escape variables for security
		$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
		$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email'] );
		$social_id = mysqli_real_escape_string( $this->_con, $trimmed_data['id'] );
		$fb_image = mysqli_real_escape_string( $this->_con, $trimmed_data['image'] );
		
		
		$query = "SELECT id, name, email, user_picture regDate, user_type FROM users where email = '$email' and social_id = '$social_id' ";
		$result = mysqli_query($this->_con, $query);
		$data = mysqli_fetch_assoc($result);
		$uid = $data['id'];
		$username = $data['name'];
		$count = mysqli_num_rows($result);
		if( $data >= 1){
			$_SESSION['UserEmail'] = $email;
			$_SESSION['username'] = $username;
			$uip=$_SERVER['REMOTE_ADDR'];
			$status=1;
			$log=mysqli_query($this->_con, "insert into userlog(user_id,userEmail,userip,status) values('$uid','".$_SESSION['UserEmail']."','$uip','$status')");
			}
			else
			{
			$uip=$_SERVER['REMOTE_ADDR'];
			$status=0;
			$log=mysqli_query($this->_con, "insert into userlog(userEmail,userip,status) values('".$email."','$uip','$status')");
			}
		if( $count >= 1){
			$_SESSION = $data;
			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;
			$this->coins_by_social_login();
			$result = $this->get_points_supplement();
			$points_by_login = $result['points_by_login'];
			$this->set_user_points($uid,$points_by_login,'By Social Login');
			$this->set_points_users($uid);
			return true;
		}else{
			
			$password = $this->randomPassword();
			$password1 = md5( $password );
			/*Generate referal code for user*/
			$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$res = "";
			for ($i = 0; $i < 4; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$result = substr($name, 0, 4);
			$rel_lo =strtoupper($result);
			$referal_code = $rel_lo . '_' . $res;
			/*End of Generate referal code for user*/
			$query = "INSERT INTO users (id, password, name,username, email, social_id, user_picture,referal_code, regDate) VALUES (NULL, '$password1', '$name','$name', '$email', '$social_id', '$fb_image','$referal_code', CURRENT_TIMESTAMP)";
			$query2 = mysqli_query($this->_con, "update `users` set online = 1 where id = '".$uid."'");
            $res = mysqli_query($this->_con, "UPDATE `users` SET online=1, last_active_timestamp = NOW() WHERE id = {$uid};");
			if(mysqli_query($this->_con, $query)){
				$to = $email;
				$subject = "Account Create - SmartTutorials.net";
				$txt = "Your Email ".$email;
				$txt .= "<br/>Your New Password ".$password;
				$headers = "From: preetmtharu@gmail.com" . "\r\n" .
						"CC: preetmtharu@gmail.com";
					
				mail($to,$subject,$txt,$headers);
			}
			
			$query = "SELECT id, name, email, regDate, user_type FROM users where email = '$email' and social_id = '$social_id' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count >= 1){
				$_SESSION = $data;
				$_SESSION['login'] = true;
				//$this->coins_by_login();
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		}
			
		
	}
	
	/**
	 * This method will handle google login
	 * @param array $data
	 * @throws Exception
	 * @return boolean true or false based on success or failure
	 */
	
	public function google_login( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
		}
		
		// escape variables for security
		$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
		$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email'] );
		$social_id = mysqli_real_escape_string( $this->_con, $trimmed_data['id'] );
		$picture = mysqli_real_escape_string( $this->_con, $trimmed_data['picture'] );
		
		
		$query = "SELECT id, name, email, regDate, user_type FROM users where email = '$email' and social_id = '$social_id' ";
		$result = mysqli_query($this->_con, $query);
		$data = mysqli_fetch_assoc($result);
		$count = mysqli_num_rows($result);
		$uid = $data['id'];
		$username = $data['name'];
		if( $data >= 1){
			$_SESSION['UserEmail'] = $email;
			$_SESSION['username'] = $username;
			$uip=$_SERVER['REMOTE_ADDR'];
			$status=1;
			$log=mysqli_query($this->_con, "insert into userlog(user_id,userEmail,userip,status) values('$uid','".$_SESSION['UserEmail']."','$uip','$status')");
			}
			else
			{
			$uip=$_SERVER['REMOTE_ADDR'];
			$status=0;
			$log=mysqli_query($this->_con, "insert into userlog(userEmail,userip,status) values('".$email."','$uip','$status')");
			}
		if( $count == 1){
			$_SESSION = $data;
			$_SESSION['login'] = true;
			$_SESSION['username'] = $username;
			$this->coins_by_social_login();
			$result = $this->get_points_supplement();
			$points_by_login = $result['points_by_login'];
			$this->set_user_points($uid,$points_by_login,'By Social Login');
			$this->set_points_users($uid);
			return true;
		}else{
			$password = $this->randomPassword();
			$password1 = md5( $password );
			/*Generate referal code for user*/
			$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
			$res = "";
			for ($i = 0; $i < 4; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$result = substr($name, 0, 4);
			$rel_lo =strtoupper($result);
			$referal_code = $rel_lo . '_' . $res;
			/*End of Generate referal code for user*/
			$query = "INSERT INTO users (id, password, name,username, email, social_id, user_picture, referal_code, regDate) VALUES (NULL, '$password1', '$name', '$name', '$email', '$social_id', '$picture','$referal_code', CURRENT_TIMESTAMP)";
			$query2 = mysqli_query($this->_con, "update `users` set online = 1 where id = '".$uid."'");
            $res = mysqli_query($this->_con, "UPDATE `users` SET online=1, last_active_timestamp = NOW() WHERE id = {$uid};");
			if(mysqli_query($this->_con, $query)){
				$to = $email;
				$subject = "Account Create - SmartTutorials.net";
				$txt = "Your Email ".$email;
				$txt .= "<br/>Your New Password ".$password;
				$headers = "From: preetmtharu@gmail.com" . "\r\n" .
						"CC: preetmtharu@gmail.com";
					
				mail($to,$subject,$txt,$headers);
			}
			
			$query = "SELECT id, name, email, created FROM users where email = '$email' and social_id = '$social_id' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count >= 1){
				$_SESSION = $data;
				$_SESSION['login'] = true;
				//$this->coins_by_login();
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		}
	}
	

	
	/**
	 * This will shows account information and handles password change
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	
	public function account( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			// escape variables for security
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = $trimmed_data['confirm_password'];
			$user_id = mysqli_real_escape_string( $this->_con, $trimmed_data['id'] );
			
			if((!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
			if(mysqli_query($this->_con, $query))return true;
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * This handle sign out process
	 */
	public function logout()
	{
		session_unset();
		session_destroy();
		unset($_SESSION['oauth_token']);
		unset($_SESSION['oauth_token_secret']);
		header('Location: index.php');
	}
	
	/**
	 * This reset the current password and send new password to mail
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	public function forgetPassword( array $data )
	{
		if( !empty( $data ) ){
			
			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con, trim( $data['email'] ) );
			
			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$password = $this->randomPassword();
			$password1 = md5( $password );
			$query = "UPDATE users SET password = '$password1' WHERE email = '$email'";
			if(mysqli_query($this->_con, $query)){
				$to = $email;
				$subject = "New Password Request";
				$txt = "Your New Password ".$password;
				$headers = "From: preetmtharu@gmail.com" . "\r\n" .
						"CC: preetmtharu@gmail.com";
					
				mail($to,$subject,$txt,$headers);
				return true;
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * This will generate random password
	 * @return string
	 */
	
	private function randomPassword() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	/*Code of coins transfer to user on daily login*/
	public function coins_by_login() {
		
		@$id =$_SESSION['id'];
		@$user_type =$_SESSION['user_type'];
		/*Check user login more than once in 24 hours*/
		$ss=  mysqli_query($this->_con,"SELECT COUNT(1) FROM userlog  WHERE loginTime >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND user_id='$id'");
		$result_data = mysqli_fetch_assoc($ss);
		$no_of_login = $result_data['COUNT(1)'];
		//echo '<pre>';print_r($result_data); echo $no_of_login; if($no_of_login > 1) {echo 'greater';} else { echo 'no';}die();
				
				
				$all_data =$this->get_user_coins_balance($id); /*Get users default balance*/
				$game_coins = $all_data['game_coins'];
				$gift_coins = $all_data['gift_coins'];
				//print_r($all_data); echo $all_data['gift_coins']; die();
				//$final_gift_coins = $alldata['gift_coins'] + $gift_coins;
				//$final_game_coins = $alldata['game_coins'] + $game_coins;
				
				$remarks ='By Daily Login';
				
				$sql12=  mysqli_query($this->_con,"select * from coins_transfer_value where user_type='vip'")or die(mysqli_error());
				$data123=mysqli_fetch_array($sql12,MYSQLI_ASSOC); //echo '<pre>';print_r($data123); 
				$daily_gift_coins = $data123['gift_coins'];
				$final_gift_coins = $data123['gift_coins'] + $gift_coins;
				$daily_game_coins = $data123['game_coins'];
				$final_game_coins = $data123['game_coins'] + $game_coins;
						
				
					
				
				if($user_type=='vip' AND $no_of_login <= 1)
				{
					/*Insert coins into user wallet*/
		            $insert_users_coins_in_wallet = $this->inser_user_coins_in_wallet($id,$daily_gift_coins,$daily_game_coins,$remarks);
				    /*Update users default balance*/
					$update_users_coins =$this->update_user_coins_final_balance($id,$final_gift_coins,$final_game_coins);
					
				}
				
				
				
				
		
	}
	
	public function coins_by_social_login() {
		
		@$id =$_SESSION['id'];
		@$user_type =$_SESSION['user_type'];
		/*Check user login more than once in 24 hours*/
		$ss=  mysqli_query($this->_con,"SELECT COUNT(1) FROM userlog  WHERE loginTime >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND user_id='$id'");
		$result_data = mysqli_fetch_assoc($ss);
		$no_of_login = $result_data['COUNT(1)'];
		//echo '<pre>';print_r($result_data); echo $no_of_login; if($no_of_login > 1) {echo 'greater';} else { echo 'no';}die();
				
				
				$all_data =$this->get_user_coins_balance($id); /*Get users default balance*/
				$game_coins = $all_data['game_coins'];
				$gift_coins = $all_data['gift_coins'];
				//print_r($all_data); echo $all_data['gift_coins']; die();
				//$final_gift_coins = $alldata['gift_coins'] + $gift_coins;
				//$final_game_coins = $alldata['game_coins'] + $game_coins;
				
				$remarks ='By Social Login';
				
				$sql12=  mysqli_query($this->_con,"select * from coins_transfer_value where user_type='vip'")or die(mysqli_error());
				$data123=mysqli_fetch_array($sql12,MYSQLI_ASSOC); //echo '<pre>';print_r($data123); 
				$daily_gift_coins = $data123['gift_coins'];
				$final_gift_coins = $data123['gift_coins'] + $gift_coins;
				$daily_game_coins = $data123['game_coins'];
				$final_game_coins = $data123['game_coins'] + $game_coins;
						
				
					
				
				if($no_of_login <= 1)
				{
					/*Insert coins into user wallet*/
		            $insert_users_coins_in_wallet = $this->inser_user_coins_in_wallet($id,$daily_gift_coins,$daily_game_coins,$remarks);
				    /*Update users default balance*/
					$update_users_coins =$this->update_user_coins_final_balance($id,$final_gift_coins,$final_game_coins);
					
				}
				
				
				
				
		
	}
	
	/*Code of coins transfer to normal user on request to admin after login*/
	public function coins_by_request_to_admin() {
		//print_r($_SESSION); die();
		
		@$id =$_SESSION['id'];
		@$user_type =$_SESSION['user_type'];
		/*Check user login more than once in 24 hours*/
		$ss=  mysqli_query($this->_con,"SELECT COUNT(1) FROM userlog  WHERE loginTime >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND user_id='$id'");
		$result_data = mysqli_fetch_assoc($ss);
		$no_of_login = $result_data['COUNT(1)'];
		//echo '<pre>';print_r($result_data); echo $no_of_login; if($no_of_login > 1) {echo 'greater';} else { echo 'no';}die();
				
				
				$all_data =$this->get_user_coins_balance($id); /*Get users default balance*/
				$game_coins = $all_data['game_coins'];
				$gift_coins = $all_data['gift_coins'];
				//print_r($all_data);
				//$final_gift_coins = $alldata['gift_coins'] + $gift_coins;
				//$final_game_coins = $alldata['game_coins'] + $game_coins; //die();
				
				$remarks ='Coins Supplement On Request To Admin';
				
				$sql12=  mysqli_query($this->_con,"select * from coins_supplement where user_type='$user_type'")or die(mysqli_error());
				$data123=mysqli_fetch_array($sql12,MYSQLI_ASSOC); //echo '<pre>';print_r($data123); 
				//$minimum_gift_coins_value = $data123['minimum_gift_coins_value'];
				$gift_coins_value = $data123['gift_coins_value'];
				$final_gift_coins = $gift_coins_value + $gift_coins;
				//$daily_game_coins = $data123['game_coins'];
				//$final_game_coins = $data123['game_coins'] + $game_coins;
			
				//if($no_of_login <= 1)
				//{
					/*Insert gift coins into user wallet*/
		            $insert_users_coins_in_wallet = $this->insert_gift_coins_in_wallet($id,$gift_coins_value,$remarks);
				    /*Update users final gift coins balance*/
					$update_users_coins =$this->update_gift_coins_final_balance($id,$final_gift_coins);
					
				//}
				/*else
				{
				$_SESSION['msg'] ='You have not enough minimum gift coins balance';
				
				}*/
				
		
	}
	
	
	/*Code of coins transfer to user on register*/
	public function coins_by_register($last_id) {
		
		@$id =$last_id;
		$sel=  mysqli_query($this->_con,"select gift_coins_on_register, game_coins_on_register from general_settings")or die(mysqli_error());
				$res=mysqli_fetch_array($sel,MYSQLI_ASSOC); //echo '<pre>';print_r($data1); die();
				$game_coins = $res['game_coins_on_register'];
				$gift_coins = $res['gift_coins_on_register'];
				$remarks ='By Register';
				/*Insert coins into user wallet*/
		        $insert_users_coins_in_wallet = $this->inser_user_coins_in_wallet($id,$gift_coins,$game_coins,$remarks);
				/*Update users default balance*/
				$update_users_coins = $this->update_user_coins_final_balance($id,$gift_coins,$game_coins);
				
					
				
				
		
	}
	/*Code of coins transfer to user on register user by using referal code of friend*/
	public function coins_using_refercode_reg($last_id) {
		        @$id =$last_id;
				$gift_coins ='50';
				$game_coins ='0';
				$remarks ='By Register Using Referal Code';
				/*Insert coins into user wallet*/
		        $insert_users_coins_in_wallet = $this->inser_user_coins_in_wallet($id,$gift_coins,$game_coins,$remarks);
				/*Update users default balance*/
				$update_users_coins = $this->update_user_coins_final_balance($id,$gift_coins,$game_coins);
	}
	
   /*Code of coins transfer to user by referal code share to friend*/
	public function coins_by_refer_friend($last_id) {
		        @$id =$last_id;
				$gift_coins ='100';
				$game_coins ='0';
				$remarks ='By Refer To Friend';
				/*Insert coins into user wallet*/
		        $insert_users_coins_in_wallet = $this->inser_user_coins_in_wallet($id,$gift_coins,$game_coins,$remarks);
				/*Update users default balance*/
				$update_users_coins = $this->update_user_coins_final_balance($id,$gift_coins,$game_coins);
	}
	
	/*Code of fetch gift and game coins balance from users table*/
	public function get_user_coins_balance($user_id){
		
		        $query_new=  mysqli_query($this->_con,"select * from users where id='$user_id'")or die(mysqli_error());
				$data_new=mysqli_fetch_array($query_new,MYSQLI_ASSOC); //echo '<pre>';print_r($data_new); die();
				//$game_coins = $data_new['game_coins'];
				//$gift_coins = $data_new['gift_coins'];
				return $data_new;
		
	}
	/*Code of gift and game coins update on users table*/
	public function update_user_coins_final_balance($user_id,$final_gift_coins,$final_game_coins){
		
		            $sql_123="update users set game_coins=game_coins+'$final_game_coins', gift_coins=gift_coins+'$final_gift_coins'  where id='$user_id'";
					mysqli_query($this->_con, $sql_123);
					
		
	}
	
	/*Code of gift coins update on users table*/
	public function update_gift_coins_final_balance($user_id,$final_gift_coins){
		
		            $sql_123="update users set  gift_coins='$final_gift_coins'  where id='$user_id'";
					mysqli_query($this->_con, $sql_123);
					
		
	}
	
	/*Code of gift and game coins update on users table*/
	public function inser_user_coins_in_wallet($id,$gift_coins,$game_coins,$remarks){
		
					$query_142=mysqli_query($this->_con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type) values('".$id."','$gift_coins','$remarks','gift_coins')");
					if($game_coins!=0)
					{
					$query_1421=mysqli_query($this->_con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type) values('".$id."','$game_coins','$remarks','game_coins')");
					}
		
	}
	
	/*Code of gift  coins update on users table on coin supplement*/
	public function insert_gift_coins_in_wallet($id,$gift_coins,$remarks){
		
					$query_142=mysqli_query($this->_con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type) values('".$id."','$gift_coins','$remarks','gift_coins')");
					
		
	}
	
	public function pr($data = ''){
		echo "<pre>"; print_r( $data ); echo "</pre>";
	}
	/*Code of fetch highies and lowest 5 numbers of user bids and update game payout*/
	public function update_game_payout($game_id,$user_id){
		
		        $query=  mysqli_query($this->_con,"SELECT bid_no, SUM(bid_amount) as ba FROM tbl_userbids where game_id='$game_id' group by bid_no order  by ba asc LIMIT 5");
				//$data=mysqli_fetch_array($query,MYSQLI_BOTH);
				while($data=mysqli_fetch_array($query)) {
					print_r($data);
					echo $data['bid_no'];
					//echo $data[SUM(bid_amount)];
				}
				$row_cnt = $query->num_rows; 
				//$game_coins = $data_new['game_coins'];
				//$gift_coins = $data_new['gift_coins'];
				return $data;
		
	}
	/*Code of fetch game history reocrds - winning no's, total bids, total wons*/
	public function get_game_history(){
				$query_new=mysqli_query($this->_con, "select * from tbl_game  WHERE game_status ='3' order by id desc limit 500");
		        return $query_new;
		
	}
	
	public function get_game_history_bck(){
				date_default_timezone_set('UTC');// change according timezone
			    $currentTime = date( 'Y-m-d H:i:s', time () );
				$query_new=mysqli_query($this->_con, "select * from tbl_game  WHERE game_start_time < '".$currentTime."' order by id desc");
		        return $query_new;
		
	}
	/*Code of fetch game history reocrds - total no of bids on game*/
	public function get_total_noof_bids($game_id){
				$sql22 = mysqli_query($this->_con,"select SUM(bid_amount) FROM tbl_userbids WHERE game_id ='$game_id';");
				$result=mysqli_fetch_array($sql22);
				$total_bids =$result['SUM(bid_amount)'];
				return $total_bids;
		
	}
	/*Code of fetch payout amount  of game on winning no from tbl_game_payout*/
	public function get_payout_amount_OnWin_no($game_id,$winn_no){
		//echo $winn_no;
				$sql34 = mysqli_query($this->_con,"select payout_amount FROM tbl_game_payout WHERE game_id ='$game_id' AND payout_digit = '$winn_no';");
				$result34=mysqli_fetch_array($sql34);//print_r($result34);
				$payout_amount =$result34['payout_amount'];
				return $payout_amount;
		
	}
	/*Code of fetch bid amount from tbl_userbids of game on winning no*/
	public function get_bid_amount_OnWin_no($game_id,$winn_no){
				$sql44 = mysqli_query($this->_con,"select bid_amount FROM tbl_userbids WHERE game_id ='$game_id' AND bid_no = '$winn_no';");
				$result44=mysqli_fetch_array($sql44);//print_r($result44);
				$bid_amount =$result44['bid_amount'];
				return $bid_amount;
		
	}
	/*Select winning users and their total no of bids on winning no and tottal won coins*/
	public function get_winner_totalwon_totalbid($game_id,$winn_no){
				$sql52 = mysqli_query($this->_con,"select user_id, SUM(bid_amount) as bid_amount, bid_no from tbl_userbids where game_id ='$game_id' AND bid_no ='$winn_no' AND bid_amount >0 GROUP BY user_id ");
				return $sql52;
		
	}
	/*insert winning users into tbl_winners*/
	public function insert_winners($game_id,$user_id,$bid_amount,$total_won){
		        $query_142=mysqli_query($this->_con, "insert into tbl_winners(game_id,user_id,total_bid_amount,total_won_coins) values('".$game_id."','$user_id','$bid_amount','$total_won')");
				//return $query_142;
		
	}
	/*Code of fetch winning no by game id*/
	public function get_winno_by_gameid($game_id){
				$sql78 = mysqli_query($this->_con,"select * from tbl_game WHERE id ='".$game_id."'");
				$result78=mysqli_fetch_array($sql78);//print_r($result44);
				//$winning_no =$result78['winning_no'];
				//print_r($result78);
				return $result78;
		
	}
	/*Code of fetch users list of game on winning no*/
	public function get_users_by_winno($game_id,$winn_no){
				
				$query23=mysqli_query($this->_con, "select * from tbl_userbids  WHERE game_id ='$game_id' AND bid_no = '$winn_no' group by user_id;");
		        return $query23;
		
	}
	/*Code of fetch total bids by user on winnig no of game*/
	public function total_bids_byuser_onwinno($game_id,$winn_no,$user_id){
				$sql99 = mysqli_query($this->_con,"select SUM(bid_amount) FROM tbl_userbids WHERE game_id ='$game_id' AND bid_no ='$winn_no' AND user_id ='$user_id' ");
				$result99=mysqli_fetch_array($sql99); //print_r($result99);
				$total_bids =$result99['SUM(bid_amount)'];
				return $total_bids;
		
	}
	/*Code of fetch user name by user id*/
	public function user_name_byid($user_id){
				$sql52 = mysqli_query($this->_con,"select nick_name, name from users where id ='$user_id' ");
				return $sql52;
				
		
	}
	/*Code of fetch total bids by user on winnig no of game*/
	public function total_bids_byuser_byallgames($user_id){
				$sql36 = mysqli_query($this->_con,"select SUM(bid_amount) FROM tbl_userbids WHERE user_id ='$user_id' ");
				$result36=mysqli_fetch_array($sql36); //print_r($result99);
				$user_total_bids =$result36['SUM(bid_amount)'];
				return $user_total_bids;
		
	}
	/*Code of fetch total Wons by user on winnig no of All game*/
	public function total_coins_won($user_id){ //echo $user_id;
				$sql555 = mysqli_query($this->_con,"select SUM(total_won_coins) FROM tbl_winners WHERE user_id ='$user_id' ");
				$result36=mysqli_fetch_array($sql555); //print_r($result36);
				$total_won_coins =$result36['SUM(total_won_coins)'];
				return $total_won_coins;
		
	}
	/*Get Winners List from tbl_winners*/
	public function get_winners(){
		        $sql788=mysqli_query($this->_con, "select user_id,SUM(total_bid_amount) as total_bid_amount,game_id,create_date,SUM(total_won_coins) as total_won from tbl_winners group by user_id");
				return $sql788;
		
	}
	/*Get all users list*/
	public function get_all_user(){
    $query12333 = mysqli_query($this->_con,"select * FROM users order by gift_coins desc limit 12");
    return $query12333;
  
 }
	 /*Code of fetch user details by user id*/
		public function user_detail_byid($user_id){
					$sql76 = mysqli_query($this->_con,"select * from users where id ='$user_id' ");
					$result76=mysqli_fetch_array($sql76); //print_r($result99);
					return $result76;
			
		}
		/*Code of fetch coins supplement details on request to admin by user id*/
		public function coins_supplement_details($user_type){
					$sql = mysqli_query($this->_con,"select * from coins_supplement where user_type='$user_type'");
					$result=mysqli_fetch_array($sql); //print_r($result);
					return $result;
			
		}
		/*Code of fetch how many time users have get coins in day*/
		public function times_of_coins_get($id){
					$sql = mysqli_query($this->_con,"SELECT COUNT(1) FROM user_wallet  WHERE create_date >= DATE_SUB(NOW(), INTERVAL 1 DAY) AND user_id='$id'");
					$result=mysqli_fetch_array($sql); //print_r($result);
					return $result;
			
		}
	 /*Get all users list by added new*/
	 public function get_new_user(){
		$query12333 = mysqli_query($this->_con,"select * FROM users order by regDate desc limit 12");
		return $query12333;
	  
	 }
	  /*Fetch  Points supplement to users by different events*/
	public function get_points_supplement(){
		        $sql = mysqli_query($this->_con,"select * from user_points_supplement");
				$result=mysqli_fetch_array($sql); //print_r($result);
				return $result;
		
	}
	 /*insert Points to users by different events*/
	public function set_user_points($user_id,$points,$points_by){
		        $query_11=mysqli_query($this->_con, "insert into tbl_users_points(user_id,user_points,points_by) values('$user_id','$points','$points_by')");
				//return $query_142;
		
	}
	/*Code of fetch total points by user*/
	public function get_user_points($user_id){
		
				$sql_78 = mysqli_query($this->_con,"select SUM(user_points) FROM tbl_users_points WHERE user_id ='$user_id' group by user_id ");
				$result_78=mysqli_fetch_array($sql_78); //print_r($result99);
				$user_points =$result_78['SUM(user_points)'];
				return $user_points;
		
	}
	/*public function all_games(){
		$qur ="select tbl_game.id,tbl_game.game_name,tbl_game.game_start_time,tbl_game.game_wining_number1,tbl_game.game_wining_number2,tbl_game.game_wining_number3,
		tbl_game.game_wining_number2,tbl_game.winning_no,tbl_game.game_status,tbl_game.is_active,
		(select sum(bid_amount) from tbl_userbids where tbl_userbids.game_id=tbl_game.id) as bid_amount,(select sum(total_won_coins) from tbl_winners where tbl_winners.game_id=tbl_game.id) as total_won_coins
		from tbl_game WHERE tbl_game.is_active=1 order by tbl_game.id desc";
				$query=mysqli_query($this->_con, $qur);
		        return $query;
		
	}*/
	public function all_games(){
				$query=mysqli_query($this->_con, "select * from tbl_game  WHERE is_active=1 order by id asc");
		        return $query;
		
	}
	/*Code of fetch total bids on given  no of game*/
	public function users_total_bids_on_no($game_id,$digit,$user_id){
				$sql = mysqli_query($this->_con,"select bid_amount FROM tbl_userbids WHERE game_id ='$game_id' AND bid_no ='$digit' AND user_id ='$user_id' ");
				$result=mysqli_fetch_array($sql); //print_r($result99);
				$total_bids =$result['bid_amount'];
				return $total_bids;
		
	}
	/*Code of fetch total bids on given  no of game*/
	public function users_total_bids_And_nos($game_id,$user_id){
				$sql = mysqli_query($this->_con,"select bid_no, SUM(bid_amount) FROM tbl_userbids WHERE game_id ='$game_id' AND user_id ='$user_id' group by bid_no ");
				return $sql;
		
	}
	/*Code of fetch total bid amount from tbl_userbids of game on given no*/
	public function total_bids_On_no($game_id,$digit){
				$sql = mysqli_query($this->_con,"select SUM(bid_amount) as bid_amount FROM tbl_userbids WHERE game_id ='$game_id' AND bid_no = '$digit';");
				$result=mysqli_fetch_array($sql);//print_r($result44);
				$bid_amount =$result['bid_amount'];
				return $bid_amount;
		
	}
	/*Code of fetch Game Statics*/
	public function get_game_statics($game_id){
		
				$sql = mysqli_query($this->_con,"select * FROM tbl_game_payout WHERE game_id ='$game_id'");
				return $sql;
			
	}
	/*Code of fetch Game Statics*/
	public function last_bet_by_user($game_id,$user_id){
		        //echo $game_id;
				//echo $user_id;
				$sql = mysqli_query($this->_con,"select bid_no,bid_amount FROM tbl_userbids WHERE game_id ='$game_id' AND user_id='$user_id'");
				return $sql;
			
	}
	  /*Get Most_popular users list by added new*/
	 public function get_Popular_user(){
		$query12334 = mysqli_query($this->_con,"select * FROM users order by gift_coins desc limit 12");		
		return $query12334;
	  
	 }
	  /*Get player of month*/
	 public function player_of_month(){
		$sql = mysqli_query($this->_con,"SELECT user_id,sum(total_bid_amount) as total_bid_amount,sum(total_won_coins) as total_won FROM tbl_winners WHERE (select MONTH(create_date))=(select MONTH(CURRENT_DATE)) AND (select YEAR(create_date)=(SELECT YEAR(CURRENT_DATE))) GROUP BY user_id ORDER BY total_won DESC LIMIT 1");		
		return $sql;
	  
	 }
	 /*Code of fetch bids of user by user id and game*/
	public function bids_ongame_byuser($game_id,$user_id){
				$sql = mysqli_query($this->_con,"SELECT * FROM tbl_userbids where game_id ='$game_id' AND user_id ='$user_id'");
				return $sql;
		
	}
	 /*Code of fetch bids of user by user id and game*/
	public function bids_on_no_byuser($game_id,$user_id,$digit){
				$sql = mysqli_query($this->_con,"SELECT bid_amount FROM tbl_userbids where game_id ='$game_id' AND user_id ='$user_id' AND bid_no ='$digit'");
				$result=mysqli_fetch_array($sql);//print_r($result44);
				$bid_amount_on_digit =$result['bid_amount'];
				return $bid_amount_on_digit;
		
	}
	 /*Auto start game on exit current game*/
	public function auto_start_game(){
				$game_name = "Game#00";
				/**Last game id */
				$query12=mysqli_query($this->_con,"select id FROM tbl_game ORDER BY id DESC LIMIT 1");
				$result12=mysqli_fetch_array($query12);
				$last_game_id = $result12['id'];
				$new_game_id=$last_game_id+1;
				/*Fetch game start and end time of last game id*/
				$query1245=mysqli_query($this->_con,"select * FROM tbl_game where id ='$last_game_id'");
				$result12345=mysqli_fetch_array($query1245);//print_r($result12);
				$game_start_time=$result12345['game_start_time'];
				$game_duration = $result12345['game_duration'];
				$end_time = date('Y-m-d H:i:s',strtotime('+'.$game_duration.' minutes',strtotime($game_start_time)));
				$new_game_name =$game_name.@$new_game_id;
				date_default_timezone_set('UTC');// change according timezone
				//$currentTime = date( 'Y-m-d H:i:s', time () );
				$time_extend = date('Y-m-d H:i:s',strtotime('+20 seconds',strtotime($end_time)));
				$game_name=$new_game_name;
				$new_game_start_time=$time_extend;
				$game_duration='3';
				$sql=mysqli_query($this->_con, "insert into tbl_game(game_name,game_start_time,game_duration) values('$game_name','$new_game_start_time','$game_duration')");
				$lastid = mysqli_insert_id($this->_con);
				/*Set payout rate of new create game in table tbl_game_payout*/
				$sql23=mysqli_query($this->_con, "select * from tbl_default_payout");
				while($result=mysqli_fetch_array($sql23)) {
					$payout_digit = $result['payout_digit'];
					$payout_amount = $result['payout_amount'];
					$sql56=mysqli_query($this->_con,"insert into tbl_game_payout(game_id,payout_digit,payout_amount) values('$lastid','$payout_digit','$payout_amount')");
				}
				//}
					
	}
	public function get_level_point($id){
		$sql = mysqli_query($this->_con,"select @temp_total := user_points as total_points,
			(case
				when @temp_total >= 0 and @temp_total <= 20 then 'Level 1'
				when @temp_total > 20 and @temp_total <= 50 then 'Level 2'
				when @temp_total > 50 and @temp_total <= 100 then 'Level 3'
				when @temp_total > 100 and @temp_total <= 200 then 'Level 4'
				when @temp_total > 200 then 'Level 5'
				else 'NO Points' 
					END) as 'user_level',
				(case
					when @temp_total >= 0 and @temp_total <= 20 then 21 - @temp_total 
					when @temp_total > 20 and @temp_total <= 50 then 51 - @temp_total 
					when @temp_total > 50 and @temp_total <= 100 then 101 - @temp_total 
					when @temp_total > 100 and @temp_total <= 200 then 201 - @temp_total 
					when @temp_total > 200 and @temp_total <= 500 then 501 - @temp_total 
					when @temp_total > 500 then 0
					else 'NO Points' 
						END) as 'next_level'
					from users where id ='$id';");
		$result=mysqli_fetch_array($sql);
		return $result;

	}	
// By share on facebook
	public function set_points_fb($user_id,$points){
		$query_11=mysqli_query($this->_con, "SELECT * FROM tbl_users_points WHERE user_id = '$user_id' AND points_by = 'By Facebook Share'");
		$result = mysqli_fetch_array($query_11);
		if($result!='')
		{
			$sql=mysqli_query($this->_con, "UPDATE tbl_users_points SET user_points = user_points + '$points'");
		}
		else
		{
			$sql=mysqli_query($this->_con, "insert into tbl_users_points(user_id,user_points,points_by) values('$user_id','$points','By Facebook Share')");

		}
	}
	public function set_points_users($user_id){
		$sql1=mysqli_query($this->_con, "update users set user_points= (select sum(user_points) from tbl_users_points where user_id='$user_id') where id='$user_id'");
	}	 /*Code of fetch pre fixed bids for all games by user*/	
	public function user_robot_bids(){
		$sql = mysqli_query($this->_con,"SELECT * FROM tbl_user_robot where status=1");	
	return $sql;
	}	
	/*Code of fetch pre fixed bids for all games by user*/	
	public function user_robot_bids_byuser($user_id)
	{
		$sql = mysqli_query($this->_con,"SELECT * FROM tbl_user_robot where user_id ='$user_id' AND status=1");
		return $sql;
	}
	public function total_games_byuser($user_id)
	 {
	  $sql = mysqli_query($this->_con,"SELECT * FROM tbl_userbids where user_id ='$user_id' GROUP BY game_id");
	  $total_games = mysqli_num_rows($sql);
	  return $total_games;
	 }
	 public function total_coins_won_byuser($user_id)
	 {
	  $sql = mysqli_query($this->_con, "SELECT sum(total_won_coins) as total_wons FROM tbl_winners WHERE user_id='$user_id'");
	  $result=mysqli_fetch_array($sql);
	  $total_wons=$result['total_wons'];
	  return $total_wons;
	 }
	 /*12-06-18 changes*/
	 // game status update
	public function game_status_update($game_id,$status){
		$sql=mysqli_query($this->_con, "UPDATE tbl_game SET game_status = '$status' WHERE id='$game_id'");
		$result=mysqli_fetch_array($sql);
		return $result;
		
	}
	/*Check game status by game id*/
	public function game_status($game_id){
		
				$sql = mysqli_query($this->_con,"select game_status FROM tbl_game WHERE id ='$game_id'");
				$result=mysqli_fetch_array($sql);
				$game_status =$result['game_status'];
				return $game_status;
		
	}
	/*List of games of game zone page*/
	public function latest_games(){
		       $query=mysqli_query($this->_con, "select * from tbl_game WHERE is_active=1 and game_start_time BETWEEN  (UTC_TIMESTAMP - INTERVAL 135 HOUR_MINUTE) AND (UTC_TIMESTAMP + INTERVAL 15 HOUR_MINUTE) order by id desc");
		        return $query;
		
	}
	/*Manually update status of games those are not played*/
	public function manually_status_change(){
		        date_default_timezone_set('UTC');// change according timezone
			    $currentTime = date( 'Y-m-d H:i:s', time () );
				$currentTime_new = date('Y-m-d H:i:s',strtotime('-3 minutes',strtotime($currentTime)));
				$sql = mysqli_query($this->_con,"SELECT * FROM tbl_game WHERE game_start_time <= '$currentTime_new' AND game_status='0'");
				return $sql;		
		
	}
	/*Code of fetch game history reocrds - total no of bids on game by user*/
	public function total_bids_ongame_byuser($game_id,$user_id){
				$sql = mysqli_query($this->_con,"select SUM(bid_amount) FROM tbl_userbids WHERE game_id ='$game_id' AND user_id ='$user_id'");
				$result=mysqli_fetch_array($sql);
				$total_bids =$result['SUM(bid_amount)'];
				return $total_bids;
		
	}
	/*22 june 2018*/
	/*Code of fetch default bids for all no's*/	
	public function default_bids_by_no($digit)
	{
		$sql = mysqli_query($this->_con,"select bid_amt FROM tbl_default_bids WHERE bid_digit ='$digit'");
				$result=mysqli_fetch_array($sql); //print_r($result99);
				$bid_amt =$result['bid_amt'];
				return $bid_amt;
				
	}
	/*Code of fetch last game id that user bids*/
	public function last_game_bet_by_user($user_id){
				$sql = mysqli_query($this->_con,"select game_id FROM tbl_userbids WHERE user_id='$user_id' order by create_date DESC limit 1");
				$result=mysqli_fetch_array($sql);
				$game_id_last_bet =$result['game_id'];
				return $game_id_last_bet;
			
	}
	/*14-7-18*/
	/*List of past games*/
	public function past_games(){
		       $query=mysqli_query($this->_con, "select * from tbl_game WHERE is_active=1 and game_status='3' order by id desc limit 50");
		        return $query;
		
	}
	/*28-7-18*/
	/*Code of fetch last game id that user bids*/
	public function get_referal_code($user_id){
				$sql = mysqli_query($this->_con,"select referal_code FROM users WHERE id='$user_id'");
				$result=mysqli_fetch_array($sql);
				$referal_code =$result['referal_code'];
				return $referal_code;
			
	}
	/*get user id by referal code of user*/
	public function user_by_refcode($ref_code){
				$sql = mysqli_query($this->_con,"select id FROM users WHERE referal_code='$ref_code'");
				$result=mysqli_fetch_array($sql);
				$user_id =$result['id'];
				return $user_id;
			
	}
	/*get user user type by user id*/
	public function user_type($id){
				$sql = mysqli_query($this->_con,"select user_type FROM users WHERE id='$id'");
				$result=mysqli_fetch_array($sql);
				$user_type =$result['user_type'];
				return $user_type;
			
	}
	/*get discount to vip users on products*/
	public function vip_discount(){
				$sql = mysqli_query($this->_con,"select discount_vip FROM general_settings");
				$result=mysqli_fetch_array($sql);
				$discount_vip =$result['discount_vip'];
				return $discount_vip;
			
	}

}