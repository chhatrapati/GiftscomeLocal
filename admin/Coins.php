<?php
//require_once('include/function.php');
require_once('DBclass.php');
require_once('include/config.php');
/**
 * This User will have functions that hadles user registeration,
 * login and forget password functionality
 * @author muni
 * @copyright www.smarttutorials.net
 */
class User_Coins
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
		$db = new DBclass();
		$this->_con = $db->con;
	}
	
	public function update_user_wallet( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data); //echo '<pre>'; print_r($trimmed_data); die();
			
			//$sql=mysqli_query($con, "update users set game_coins='$game_coins',gift_coins='$gift_coins' where id='$id'");
			//$_SESSION['msg']="Coins Value Updated !!";
			// escape variables for security
			$id = mysqli_real_escape_string($this->_con, $trimmed_data['id'] );
			//$game_coins = mysqli_real_escape_string( $this->_con, $trimmed_data['game_coins'] );
			$gift_coins = mysqli_real_escape_string( $this->_con, $trimmed_data['gift_coins'] ); //die();
			$reason_mode_of_coins = mysqli_real_escape_string( $this->_con, $trimmed_data['reason_mode_of_coins'] );
			$action_perform = mysqli_real_escape_string( $this->_con, $trimmed_data['action_perform'] );
			$previous_game_coins = mysqli_real_escape_string( $this->_con, $trimmed_data['previous_game_coins'] );
			$previous_gift_coins = mysqli_real_escape_string( $this->_con, $trimmed_data['previous_gift_coins'] );
			$remarks = 'By Admin';			
			if($action_perform =='add')
			{
				//echo $total_game_coins = $previous_game_coins + $game_coins;
				echo $total_gift_coins = $previous_gift_coins + $gift_coins; //die();
			}
			if($action_perform =='deduct')
			{
				//$total_game_coins = $previous_game_coins - $game_coins;
				$total_gift_coins = $previous_gift_coins - $gift_coins; //die();
			}
			
			if($reason_mode_of_coins =='by_admin')
			{
				/*if($game_coins !='')
				{
					$log=mysqli_query($this->_con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type) values('".$id."','$game_coins','$remarks','game_coins')");
					$sql="update users set game_coins='$total_game_coins'  where id='$id'";
					mysqli_query($this->_con, $sql);
				}*/
				if($gift_coins !='')
				{
					$log=mysqli_query($this->_con, "insert into user_wallet(user_id,user_coins,reason_mode_of_coins,coins_type) values('".$id."','$gift_coins','$remarks','gift_coins')");
					$sql="update users set  gift_coins='$total_gift_coins' where id='$id'";
					mysqli_query($this->_con, $sql);
				}
				
				$_SESSION['msg']="Coins Value Updated !!";
				return true;
			}
			
		
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
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
			$name = mysqli_real_escape_string( $con, $trimmed_data['name'] );
			$nick_name = mysqli_real_escape_string( $con, $trimmed_data['nick_name'] );
			if($nick_name=='')
			{
				$new_nick_name = 'lazygamer'.mt_rand(0,10000).''; //echo $new_nick_name; die();
			}
			else
			{
				$new_nick_name = $nick_name; //echo $nick_name; die();
			}
			$password = mysqli_real_escape_string( $con, $trimmed_data['password'] );
			$cpassword = mysqli_real_escape_string( $con, $trimmed_data['confirm_password'] );
			$gender = mysqli_real_escape_string( $con, $trimmed_data['gender'] );
			$address = mysqli_real_escape_string( $con, $trimmed_data['address'] );
			$contact_no = mysqli_real_escape_string( $con, $trimmed_data['contact_no'] );
			$file = $_FILES['file']['name'];	
			
			// Check for an email address:
			if (filter_var( $trimmed_data['email'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $con, $trimmed_data['email']);
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
			if(mysqli_query($con, $query))return true;
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
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
			$password = mysqli_real_escape_string( $con, $trimmed_data['password'] );
			$cpassword = $trimmed_data['confirm_password'];
			$user_id = mysqli_real_escape_string( $con, $trimmed_data['id'] );
			
			if((!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
			if(mysqli_query($con, $query))return true;
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
			$email = mysqli_real_escape_string( $con, trim( $data['email'] ) );
			
			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$password = $this->randomPassword();
			$password1 = md5( $password );
			$query = "UPDATE users SET password = '$password1' WHERE email = '$email'";
			if(mysqli_query($con, $query)){
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
	
	
	
	public function pr($data = ''){
		echo "<pre>"; print_r( $data ); echo "</pre>";
	}
}