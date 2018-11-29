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
			$file = $_FILES['file']['name'];	
			
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
			$query = "INSERT INTO users (id, name, nick_name, email, password, contactno, gender, shippingAddress, user_picture, regDate) VALUES (NULL, '$name', '$new_nick_name', '$email', '$password', '$contact_no', '$gender', '$address', '$file', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query)) 
			$last_id = mysqli_insert_id($this->_con);
		    $this->coins_by_register($last_id);
			$this->set_user_points($last_id,'50','By Register');
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
				
			if((!$email) || (!$password) ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			$password = md5( $password );
			$query = "SELECT id, name, email, regDate, user_type FROM users where email = '$email' and password = '$password' and is_active =1 ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result); //print_r($data); die();
			$uid = $data['id'];
			$count = mysqli_num_rows($result); //echo $count; die();
			if( $data >= 1){
			$_SESSION['UserEmail'] = $email;
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
				$_SESSION = $data; //print_r($_SESSION); die();
				$_SESSION['login'] = true; //print_r($_SESSION['login']); die();
				$this->coins_by_login();
				$this->set_user_points($uid,'50','By Login');
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
		$count = mysqli_num_rows($result);
		if( $data >= 1){
			$_SESSION['UserEmail'] = $email;
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
			$this->coins_by_social_login();
			$this->set_user_points($uid,'50','By Social Login');
			return true;
		}else{
			
			$password = $this->randomPassword();
			$password1 = md5( $password );			
			$query = "INSERT INTO users (id, password, name, email, social_id, user_picture, regDate) VALUES (NULL, '$password1', '$name', '$email', '$social_id', '$fb_image', CURRENT_TIMESTAMP)";
			
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
		if( $data >= 1){
			$_SESSION['UserEmail'] = $email;
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
			$this->coins_by_social_login();
			$this->set_user_points($uid,'50','By Social Login');
			return true;
		}else{
			$password = $this->randomPassword();
			$password1 = md5( $password );			
			$query = "INSERT INTO users (id, password, name, email, social_id, user_picture, regDate) VALUES (NULL, '$password1', '$name', '$email', '$social_id', '$picture', CURRENT_TIMESTAMP)";
			
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
						
				
					
				
				if($no_of_login <= 1)
				{
					/*Insert gift coins into user wallet*/
		            $insert_users_coins_in_wallet = $this->insert_gift_coins_in_wallet($id,$gift_coins_value,$remarks);
				    /*Update users final gift coins balance*/
					$update_users_coins =$this->update_gift_coins_final_balance($id,$final_gift_coins);
					
				}
				else
				{
				$_SESSION['msg'] ='You have not enough minimum gift coins balance';
				
				}
				
				
				
				
		
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
		
		            $sql_123="update users set game_coins='$final_game_coins', gift_coins='$final_gift_coins'  where id='$user_id'";
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
					$query_1421=mysqli_query($this->_con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type) values('".$id."','$game_coins','$remarks','game_coins')");
		
	}
	
	/*Code of insert gift  coins update on users table on coin supplement*/
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
				date_default_timezone_set('UTC');// change according timezone
			    $currentTime = date( 'Y-m-d H:i:s', time () );
				$query_new=mysqli_query($this->_con, "select * from tbl_game  WHERE game_start_time < '".$currentTime."'");
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
				$sql52 = mysqli_query($this->_con,"select user_id, SUM(bid_amount) as bid_amount, bid_no from tbl_userbids where game_id ='$game_id' AND bid_no ='$winno' AND bid_amount >0 GROUP BY user_id ");
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
		/*Code of fetch userbids on each number gamewise*/
	public function get_users_by_userbid($game_id){
				
				$query24=mysqli_query($this->_con, "select * from tbl_game_payout  WHERE game_id ='$game_id';");
		        return $query24;
		
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
				$sql52 = mysqli_query($this->_con,"select name from users where id ='$user_id' ");
				$result52=mysqli_fetch_array($sql52); //print_r($result99);
				$user_name =$result52['name'];
				return $user_name;
		
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
		        $sql788=mysqli_query($this->_con, "select * from tbl_winners group by user_id");
				return $sql788;
		
	}
	/*Get all users list*/
	public function get_all_user(){
    $query12333 = mysqli_query($this->_con,"select * FROM users order by name limit 12");
    return $query12333;
  
 }
	 /*Code of fetch user details by user id*/
		public function user_detail_byid($user_id){
					$sql76 = mysqli_query($this->_con,"select * from users where id ='$user_id' ");
					$result76=mysqli_fetch_array($sql76); //print_r($result99);
					return $result76;
			
		}
	 /*Get all users list by added new*/
	 public function get_new_user(){
		$query12333 = mysqli_query($this->_con,"select * FROM users order by regDate desc limit 12");
		return $query12333;
	  
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
}